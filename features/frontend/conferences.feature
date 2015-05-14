@conference @sprint11
Feature: See a conference
  In order to know the available conferences
  As a researcher
  I want to be able to browse conferences

  Background:
    Given there are following topics:
      | name    |
      | topicA  |
      | topicB  |
      | topicC  |
      | topicD  |
    And there are following conferences:
      | name                    | slug                    | description                                | registration_starts_at | registration_ends_at | topics         |dead_time   |
      | I Example Conference    | i-example-conference    | Description of the I Example Conference    | now -3 days            | now +3 days          | topicA         |2015/02/30  |
      | II Example Conference   | ii-example-conference   | Description of the II Example Conference   | now -3 days            | now +3 days          | topicB         |2015/02/30  |
      | III Example Conference  | iii-example-conference  | Description of the III Example Conference  | now -3 days            | now +3 days          | topicB         |2015/02/30  |
      | I Computing Conference  | i-computing-conference  | Description of the I Computing Conference  | now -3 days            | now +3 days          | topicD         |2015/02/30  |


  Scenario: List conferences
    Given I am on the homepage
    Then I should see 4 conferences

  Scenario Outline: Search conferences
    Given I am on the homepage
    When I fill in "search" with "<word>"
    And I press "search-button"
    Then I should be on "find"
    And I should see <number> conferences

    Examples:
      | word      | number  |
      | Example   | 3       |
      | Computing | 1       |
      | nothing   | 0       |

  Scenario: See conference
    Given I am on the homepage
    When I follow "View details" near "I Example Conference"
    Then I should be on the conference page for "I Example Conference"
