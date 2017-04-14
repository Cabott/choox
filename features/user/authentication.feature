Feature: Authentication
  In order to view and interact with the website
  As a soccer fan
  I need to be able to register, login and logout

  Scenario: Register as a new user
    Given I am on "/register/"
    And I fill in "fos_user_registration_form_username" with "test11"
    And I fill in "fos_user_registration_form_plainPassword_first" with "password"
    And I fill in "fos_user_registration_form_plainPassword_second" with "password"
    And I fill in "fos_user_registration_form_email" with "mail11@me.com"
    And I fill in "fos_user_registration_form_favouriteTeam" with "werder"
    And I press "fos_user_registration_form_submit"
    Then I should see "registration.confirmed"

  Scenario: Login as a user
    Given there is a user "testUser" with the email address "testuser@test.de" and the password "test"
    And I am on "/"
    When I follow "layout.login"
    And I fill in "username" with "testuser"
    And I fill in "password" with "test"
    And I press "submit"
    Then I should see "layout.logout"

  Scenario: Login with invalid credentials
    Given I am on "/"
    When I follow "layout.login"
    And I fill in "username" with "testuser"
    And I fill in "password" with "wrongPassword"
    And I press "submit"
    Then I should not see "layout.logout"