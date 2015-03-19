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
      | name                    | slug                  | description                                | registration_starts_at | registration_ends_at |dead_time   |topics |
      | I Example Conference    | i-example-conference  | Description of the I Example Conference    | now -3 days            | now +3 days          |now +2 days |topicA |
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
      | sent                      |example1.pdf |  first  |
      | accepted with suggestions |example2.pdf |  second |
      | accepted                  |example3.pdf |  second |
      | rejected                  |example4.pdf |  third  |
    And there are following reviewComments:
      |state                      |comments                 |articleReviews |
      |accepted with suggestions  |comments of the article1 |example2.pdf   |
      |accepted                   |comments of the article2 |example3.pdf   |
      |rejected                   |comments of the article3 |example4.pdf   |


  Scenario: see article sent
    Given I am on the inscription page for "I Example Conference"
    Then I should see "first"
    And I should see "sent"

  Scenario: see article accepted
    Given I am on the inscription page for "I Example Conference"
    Then I should see "second"
    And I should see "view comments"
    When I follow "view comments"
    Then I should be on page comments "example2.pdf"

  Scenario: see article accepted with suggestions
    Given I am on the inscription page for "I Example Conference"
    Then I should see "second"
    And I should see "accepted with suggestions"
    And I should see "view comments"
    When I follow "Send"
    Then I should be on the new page for "second"






