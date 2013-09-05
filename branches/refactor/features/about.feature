Feature:
  As a visitor
  I want to see the about page
  So that I can learn about the brewer

  Scenario: Visit About page
    When I am on the page "about"
    Then I should see "Dr. Joe B. Brewer II"
    And I should see "Anytown, Colorado USA"
    And I should see "All Grain"
