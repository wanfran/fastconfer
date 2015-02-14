@conference
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
      | name                    | slug                    | description                                | registration_starts_at | registration_ends_at | topics         |
      | I Example Conference    | i-example-conference    | Description of the I Example Conference    | 2015/01/01             | 2015/01/31           | topicA, topicC |
      | II Example Conference   | ii-example-conference   | Description of the II Example Conference   | 2015/01/01             | 2015/01/31           | topicB         |
      | III Example Conference  | iii-example-conference  | Description of the III Example Conference  | 2015/01/01             | 2015/01/31           | topicB         |
      | I Computing Conference  | i-computing-conference  | Description of the I Computing Conference  | 2015/01/01             | 2015/01/31           | topicD         |

  @sprint1
  Scenario: List conferences
    Given I am on the homepage
    Then I should see 4 conferences

  @sprint1
  Scenario: Search conferences
    Given I am on the homepage
    When I fill in "search" with "<word>"
    And I press "search-button"
    Then I should be on "/find/"
    And I should see <number> conferences

    Scenario Outline:
      | word      | number  |
      | Example   | 3       |
      | Computing | 1       |
      | Nothing   | 0       |

  @sprint1
  Scenario: See conference
    Given I am on the homepage
    When I follow "See details" near "I Example Conference"
    Then I should be on the conference page for "I Example Conference"
    And I should see 2 topics