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
      | authors | keyword  | abstract             |
      | userA   | example1 | 1tex example abstract|
      | userB   | example2 | 2tex example abstract|
      | userC   | example3 | 3tex example abstract|


    Scenario: go page of upload
      Given I am on the inscription page for "I Example Conference"
      When I press "Send new article"
      Then I should be on the upload page for "I Example Conference"

    Scenario: send empty form
      Given I am on the upload page for "I Example Conference"
      When I press "Submit"
      Then I should be on the conference page for "I Example Conference"
      And I should see "Error send article"

     Scenario: send form
       Given I am on the upload page for "I Example Conference"
       When I fill in the following:
       |authors |userA   |
       |keyword |example1|
       |abstract|1tex example abstract|
       And |I select "topicaA" from "topic"
       And |I select "topicaB" from "topic"
       Then I press "Submit"
       And I should be on the conference page for "I Example Conference"
       And I should see "Congratulations send article"

