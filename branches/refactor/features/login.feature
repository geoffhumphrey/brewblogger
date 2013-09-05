Feature:
  As a brewer
  I want to log in
  So that I can update the site

Scenario:
  Given I am on the page "login"
  When I fill in "loginUsername" with "nonpriv"
  And I fill in "loginPassword" with "user"
  And I press "submit"
  Then I should be on "/admin/index.php"