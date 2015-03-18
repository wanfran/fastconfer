@articles @sprint3

Feature: status of article
  In order to see my article
  As a researcher
  I want to be able to see article

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
      | name                    | slug                  | description                                | registration_starts_at | registration_ends_at |dead_time  |topics |
      | I Example Conference    | i-example-conference  | Description of the I Example Conference    | 2015/01/01             | 2015/04/30           |2015/04/25 |topicA |
    And there are following inscriptions:
       |username| name                 |
       |user1   | I Example Conference |
    And I submitted the following articles to "I Example Conference":
      |title | authors | keyword  | abstract             |  stateEnd |
      |first | userA   | example1 | 1tex example abstract|  sent     |
      |second| userB   | example2 | 2tex example abstract|  sent     |
      |third | userC   | example3 | 3tex example abstract|  sent     |
    And there are following articleReviews:
      | state                     |path        |articles |
      | sent                      |example.pdf |  first  |
      | accepted with suggestions |example.pdf |  second |
      | accepted                  |example.pdf |  second |
      | rejected                  |example.pdf |  third  |


  Scenario: see article sent
    Given I am on the inscription page for "I Example Conference"
    Then I should see "first"



