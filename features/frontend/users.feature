@users

Feature: User identification
  In order to access to fastconfer as authenticated user
  As a fastconfer user
  I want to get identification with a login form

  Background:
    Given that existing users:
      | username |  email   | plainPassword |enabled|
      |   pepe   | a@uco.es |      hola     |  1    |
      |   juan   | b@uco.e  |      jola     |  1    |


  Scenario: go to the form login
    Given I am on the homepage
    And I should see "Login"
    When I follow "Login"
    Then I should be on "/login"

  Scenario: login with an existing user
    Given I am on "/login"
    When I fill in "username" with "pepe"
    And I fill in "password" with "hola"
    And I press "_submit"
    Then I should see "Logout"

  Scenario: login with a non existing user
    Given I am on "login"
    When I fill in "username" with "sergio"
    And I fill in "password" with "sergio"
    And I press "_submit"
    Then I should see "Bad credentials"

