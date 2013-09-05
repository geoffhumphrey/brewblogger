Feature:
  As a visitor
  I want to see a list of awards
  So that I can learn what beers are successful

Scenario: Empty List
  Given there are no awards
  When I go to the page "awardsList"
  Then I should see "Awards-Competitions"
  And I should see "There are currently no awards/competition entries in the database."