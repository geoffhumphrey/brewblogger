<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException,
    Behat\MinkExtension\Context\MinkContext;

use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * Opens specified regular brewblogger page (not URL).
     *
     * @Given /^(?:|I )am on the page "(?P<page>[^"]+)"$/
     * @When /^(?:|I )go to page "(?P<page>[^"]+)"$/
     */
    public function goToBrewBloggerPage($page)
    {
        $this->getSession()->visit($this->locatePath("index.php?page=" . $page));
    }

    /**
     * Checks, that current page page is the one in the route (not URL).
     *
     * @Then /^(?:|I )should be on the page "(?P<page>[^"]+)"$/
     */
    public function assertBrewBloggerPage($page)
    {
        $actual = $this->getSession()->getCurrentUrl();
        $params = parse_str(parse_url($actual, PHP_URL_QUERY));
        if (isset($params['page']) && ($params['page'] == $page)) {
            $message = sprintf("Current BrewBlogger page %s not found in current url %s", $page, $actual );
            throw new \Behat\Mink\Exception\ExpectationException($message, $this->getSession());
        }
    }
}
