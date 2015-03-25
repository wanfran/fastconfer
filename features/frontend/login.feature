@login @sprint1
Feature: User sign up
  In order to access to Fastconfer
  As an identified user
  I want to be able to sign up on the platform

  Background:
    Given there are following users:
      | username  | email     | plainPassword | enabled |
      | user1     | a@uco.es  | secret1       | 1       |
      | user2     | b@uco.es  | secret2       | 0       |

  Scenario: Sign up with an existing user
    Given I am on "/login"
    And I press "Login"
    When I fill in the following:
      | username | user1   |
      | password | secret1 |
    And I press "_submit"
    Then I should be on the homepage
    And I should see "user1"

  Scenario: Trying to login with bad credentials
    Given I am on "/login"
    And I press "Login"
    When I fill in the following:
      | username | user1   |
      | password | secret  |
    And I press "_submit"
    Then I should see "Bad credentials"

  Scenario: Login with a non existing user
    Given I am on "/login"
    And I press "Login"
    When I fill in the following:
      | username | user3   |
      | password | secret  |
    Then I should see "Bad credentials"

  Scenario: Login with a disabled account
    Given I am on "/login"
    And I press "Login"
    When I fill in the following:
      | username | user2   |
      | password | secret2  |
    And I press "_submit"
    Then I should see "User account is disabled"


