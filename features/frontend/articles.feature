@articles @sprint55

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
    And there are following users:
      | username  | email     | plainPassword | enabled |
      | user3     | c@uco.es  | secret3       | 1       |
    And there are following conferences:
      | name                   | city    | description                               | code  | url       |dateStart  | dateEnd    | topics |deadTime   |dateNews   |chairmans|
      | I Example Conference   | London2 | Description of the II Example Conference  | code2 | www.b.com |now -3 days| now +3 days| topicB |now +3 days|now +3 days|user3    |
    And there are following articles:
      |title  | keyword  | abstract             |  stateEnd |inscription|
      |first  | example1 | 1tex example abstract|  sent     | user1     |
#      |second | example2 | 2tex example abstract|  sent    |
#      |third  | example3 | 3tex example abstract|  sent    |
    And there are following inscriptions:
      |username| name                 |articles|
      |user1   | I Example Conference |first   |

  Scenario: see article sent
    Given I am on the list article page for "I Example Conference"
    Then I should see "first"
    And I should see "See Comment"
#
#  Scenario: see article accepted
#    Given should be on list article page for "I Example Conference"
#    Then I should see "second"
#    And I should see "comments"
#    When I follow "comments"
#    Then I should be on page comments "second"

#  Scenario: read comment article
#    Given I am on the comments page "second"
#    Then I should see "There is some comments"
#
#  Scenario: see article accepted with suggestions
#    Given I am on the inscription page for "I Example Conference"
#    Then I should see "second"
#    And I should see "accepted with suggestions"
#    And I should see "New Article"
#    When I follow "New Article"
#    Then I should be on the new page for "second"
#
#  Scenario: forward form
#    Given I am on the new page for "second"
#    Then I should see "Complete the form"
#
#

