Feature:
  As a visitor
  I want to see brewblogs
  So that I can see the recipes for beers

Scenario: Visit Brewblog list page
  When I am on page "brewBlogList"
  Then I should see "Sample Log #3"
  And I should see "Sample Log #1"
  And I should see "Sample Log #2"

Scenario: Click through to Brewblog
  Given I am on page "brewBlogList"
  When I follow "Sample Log #3"
  Then I should see "Sample Log #3"
  And I should be on page "brewBlogDetail"