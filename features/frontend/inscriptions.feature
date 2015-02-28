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
      | I Example Conference    | i-example-conference  | Description of the I Example Conference    | 2015/01/01             | 2015/04/30           |
    And there are following articles:
      | authors | keyword  | abstract             | path        | state |
      | userA   | example1 | 1tex example abstract| example.pdf | sent  |
      | userB   | example2 | 2tex example abstract| example.pdf | sent  |
      | userC   | example3 | 3tex example abstract| example.pdf | sent  |
    And there are following inscriptions:
      |username| name                 |
      |user1   | I Example Conference |



  Scenario: go page of upload
      Given I am on the inscription page for "I Example Conference"
      Then I should see "Send new article"
      When I follow "Send new article"
      Then I should be on the upload page for "I Example Conference"

    Scenario: send empty form
      Given I am on the upload page for "I Example Conference"
      When I follow "Create"
      Then I should see "Completa este campo"

     Scenario: send form
       Given I am on the upload page for "I Example Conference"
       When I fill in the following:
       |authors |userA   |
       |keyword |example1|
       |abstract|1tex example abstract|
       And |I select "topicaA" from "topic"
       Then I press "Create"
       And I should be on the conference page for "I Example Conference"
       And I should see "Congratulations send article"

