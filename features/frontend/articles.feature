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
    And there are following conferences:
      | name                    | slug                  | description                                | registration_starts_at | registration_ends_at |dead_time  |
      | I Example Conference    | i-example-conference  | Description of the I Example Conference    | 2015/01/01             | 2015/04/30           |2015/04/25 |
    And there are following articles:
      |title | authors | keyword  | abstract             |  state |
      |first | userA   | example1 | 1tex example abstract|  sent  |
      |second| userB   | example2 | 2tex example abstract|  sent  |
      |third | userC   | example3 | 3tex example abstract|  sent  |
    And there are following articlesReview:
      | state                     |path        |
      | sent                      |example.pdf |
      | accepted with suggestions |example.pdf |
      | accepted                  |example.pdf |
      | rejected                  |example.pdf |

    And there are following inscriptions:
      |username| name                 |
      |user1   | I Example Conference |
