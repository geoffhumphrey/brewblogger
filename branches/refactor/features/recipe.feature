Feature:
  As a visitor
  I want to see beer recipes
  So that I can see use them in my own homebrewing

  Scenario: Visit recipe list page
    When I am on the page "recipeList"
    Then I should see "60-Minute Ticker"
    And I should see "Lupulus Imperialus Premiumus"
    And I should see "Steamer"

  Scenario: Click through to Brewblog
    Given I am on the page "recipeList"
    When I follow "Steamer"
    Then I should see "Northern Brewer"
    And I should be on the page "recipeDetail"