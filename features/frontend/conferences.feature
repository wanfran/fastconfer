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
    And there are following users:
      | username  | email     | plainPassword | enabled |
      | user1     | a@uco.es  | secret1       | 1       |
      | user2     | b@uco.es  | secret2       | 1       |
      | user3     | c@uco.es  | secret3       | 1       |
      | user4     | d@uco.es  | secret4       | 1       |

    And there are following conferences:
      | name                    | city    | description                               | code   | url       |dateStart   | dateEnd     | topics |deadTime    |dateNews    |chairmans|
      | I Example Conference    | London1 | Description of the I Example Conference   | code1  | www.a.com |now -3 days | now +3 days | topicA |now +3 days |now +3 days |user1    |
      | II Example Conference   | London2 | Description of the II Example Conference  | code2  | www.b.com |now -3 days | now +3 days | topicB |now +3 days |now +3 days |user2    |
      | III Example Conference  | London3 | Description of the III Example Conference | code3  | www.c.com |now -3 days | now +3 days | topicB |now +3 days |now +3 days |user3    |
      | I Computing Conference  | London4 | Description of the I Computing Conference | code4  | www.d.com |now -3 days | now +3 days | topicD |now +3 days |now +3 days |user4    |


  Scenario: List conferences
    Given I am on the homepage
    Then I should see 4 conferences

  Scenario Outline: Search conferences
    Given I am on the homepage
    When I fill in "search" with "<word>"
    And I press "search-btn"
    Then I should be on "find"
    And I should see <number> conferences

    Examples:
      | word      | number  |
      | Example   | 3       |
      | Computing | 1       |
      | nothing   | 0       |

  Scenario: See conference
    Given I am on the homepage
    When I follow "I Example Conference"
    Then I should be on the conference page for "I Example Conference"
