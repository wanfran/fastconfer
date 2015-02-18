@inscription @sprint2

Feature: fill form
  In order to send my article
  As a researcher
  I want to be able to fill form

  Background:
    Given there are following users:
      | username    | email             | plainPassword | enabled  |
      | user1       | user1@uco.es      | secret1       | 1        |
    And I am authenticated as "user1" with "secret1"
    And there are following topics:
      | name    |
      | topicA  |
      | topicB  |
      | topicC  |
      | topicD  |
    And there are following conferences:
      | name                    | slug                  | description                                | registration_starts_at | registration_ends_at |
      | I Example Conference    | i-example-conference  | Description of the I Example Conference    | 2015/01/01             | 2015/01/31           |
    And there are following articles:
      | authors | keywords | abstract             |
      | userA   | example1 | 1tex example abstract|
      | userB   | example2 | 2tex example abstract|
      | userC   | example3 | 3tex example abstract |


    Scenario: go page of form
      Given I am on the inscription page for "I Example Conference"
      Then I should see "submit"

    Scenario: send empty form
      Given I am on the inscription page for "I Example Conference"
      When I press "submit"
      Then I should be "Error in form"

     Scenario: send form
       Given I am on the inscription page for "I Example Conference"
       When I press "submit"
       Then I should be "Error in form"