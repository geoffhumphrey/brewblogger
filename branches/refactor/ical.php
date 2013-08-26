<?php
/**
 * Outputs the Calendar as an iCalendar/ICS file
 */

/**
 * Extends DateTime with some functions we need for managing the calendar 
 */
class BrewDate extends DateTime
{
   /**
    * Makes an array sutible for vevent dtstart or dtend
    * 
    * @return array
    */
    protected function makeDateArray()
    {
        return array($this->format('Y'), $this->format('m'), $this->format('d'));
    }
    
    /**
     * Creates an event in an iCalendar 
     * 
     * @param vcalendar $cal
     * @return vevent
     */
    public function createVevent($cal)
    {
        $event = $cal->newComponent('vevent');
        $event->setProperty('dtstart', $this->makeDateArray());
        
        // End date must be the day after to make it an all-day event
        $endDate = clone $this;
        $endDate->addDays(1);
        $event->setProperty('dtend', $endDate->makeDateArray() );
        return $event;
    }
    
    /**
     * Adds the number of days to the current date
     * 
     * @param numeric $numOfDays
     */
    public function addDays($numOfDays)
    {
        $this->add(new DateInterval('P' . $numOfDays .'D'));
    }
}

/**
 * Creates a URL to a brewBlog
 * 
 * @param int $id
 * @param string $brewer
 * @param string $page
 * @return string
 */
function urlForBrew($id, $brewer, $page = 'brewBlogDetail')
{
    return 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 
            'index.php?page=' . urlencode($page) . '&filter=' . urlencode($brewer) . 
            '&id=' . urlencode($id);
}

require_once('paths.php');
//set up brewers, themes, etc.
include(INCLUDES.'db_connect_universal.inc.php');
include(INCLUDES.'url_variables.inc.php');
require_once(VENDORS_DIR . 'icalcreator' . DIRECTORY_SEPARATOR . 'iCalcreator.class.php');

// Set up the Calendar
$cal = new vcalendar();
$cal->setMethod('PUBLISH');

mysql_select_db($database_brewing, $brewing);
// This is a fun one, we add all the dates together to find out if the beer is going to have any upcoming dates in the future:
$query_brewLogs =<<<EOSQL
SELECT id, brewBrewerId, brewName, brewDate, brewPrimary, brewSecondary, brewTertiary, brewLager, brewAge
  FROM brewing
      -- This bit is where the magic happens: it adds everything up to see if anything happens to a beer in the future
 WHERE ( DATE_ADD(DATE_ADD(DATE_ADD(DATE_ADD(DATE_ADD(brewDate, INTERVAL IFNULL(brewPrimary, 0) DAY), INTERVAL IFNULL(brewSecondary, 0) DAY), INTERVAL IFNULL(brewTertiary, 0) DAY), INTERVAL IFNULL(brewLager, 0) DAY), INTERVAL IFNULL(brewAge, 0) DAY) >= CURRENT_DATE()
    OR brewTapDate >= CURRENT_DATE() )
EOSQL;

$query_upcoming =<<<EOSQL
SELECT id, upcoming, upcomingDate, upcomingRecipeID, brewBrewerID
  FROM upcoming
 WHERE upcomingDate >= CURRENT_DATE()
EOSQL;

$title = 'BrewBlogger ' . $row_pref['menuCalendar'];
// Optionally filter down to specific brewer
if (isset($filter) && !empty($filter) && 'all' != $filter) {
    $query_brewLogs .= sprintf(' AND brewBrewerID = \'%s\'', $filter);
    $query_upcoming .= sprintf(' AND brewBrewerID = \'%s\'', $filter);
    
    // Update the title
    $user_query = 'SELECT realFirstName, realLastName 
                     FROM users
                    WHERE user_name = \'%s\'';
    $user_result = mysql_query(sprintf($user_query, $filter));
    if (!$user_result) {
        throw new Exception(mysql_error());
    }
    $user = mysql_fetch_assoc($user_result);
    $title = $user['realFirstName'] . ' ' . $user['realLastName']."'s ".$row_pref['menuCalendar'];
}

$cal->setProperty('x-wr-calname', $title);


// BrewBlogs with upcoming dates
$brews = mysql_query($query_brewLogs);
if (!$brews) {
    throw new Exception(mysql_error());
}

while ($row = mysql_fetch_assoc($brews)) {
    $brewDate = new BrewDate($row['brewDate']);
    $event = $brewDate->createVevent($cal);
    $event->setProperty('summary', 'Brew ' . $row['brewName']);
    $event->setProperty('description', urlForBrew($row['id'], $row['brewBrewerId']));
    
    // See what other steps we have
    $steps = array();
    foreach (array('brewPrimary', 'brewSecondary', 'brewTertiary', 'brewLager', 'brewAge') as $key) {
        if (!empty($row[$key])) {
            $steps[] = $key;
        }
    }
        
    $numOfSteps = count($steps);
    for ($i=0; $i < ($numOfSteps - 1); $i++) {
        $period = $row[$steps[$i]];
        $nextStepName = substr($steps[$i + 1], 4);
        $brewDate->addDays($period);
        $event = $brewDate->createVevent($cal);
        $event->setProperty('summary', $nextStepName.  ': ' . $row['brewName']);
        $event->setProperty('description', urlForBrew($row['id'], $row['brewBrewerId']));
    }
    
    $brewDate->addDays($row[$steps[$i]]);
    $brewDate->createVevent($cal, 'Tap: ' . $row['brewName']);
}

// Upcoming recipes
$upcoming = mysql_query($query_upcoming);
if (!$upcoming) {
    throw new Exception(mysql_error());
}

while ($row = mysql_fetch_assoc($upcoming)) {
    $upcomingDate = new BrewDate($row['upcomingDate']);
    $event = $upcomingDate->createVevent($cal);
    $event->setProperty('summary', 'Upcoming: ' . $row['upcoming']);
    echo urlForBrew($row['upcomingRecipeID'], $row['brewBrewerID'], 'recipeDetail');
    $event->setProperty('description', urlForBrew($row['upcomingRecipeID'], $row['brewBrewerID'], 'recipeDetail'));
}

$cal->returnCalendar();