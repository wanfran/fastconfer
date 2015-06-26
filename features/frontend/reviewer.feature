@reviewer @sprint4234

Feature: review an article
  In order to comment some articles
  As a reviewer
  I want to be able to comment some articles

  Background:
    Given there are following users:
      | username    | email             | plainPassword | enabled  |
      | user1       | user1@uco.es      | secret1       | 1        |
      | user3       | c@uco.es          | secret3       | 1        |
    And I am authenticated as "user1" with "secret1"
    And there are following topics:
      | name    |
      | topicA  |
      | topicB  |
    And there are following conferences:
      | name                   | city    | description                               | code  | url       |dateStart  | dateEnd    | topics |deadTime   |dateNews   |chairmans|
      | I Example Conference   | London2 | Description of the II Example Conference  | code2 | www.b.com |now -3 days| now +3 days| topicB |now +3 days|now +3 days|user3    |
    And there are following inscriptions:
      |username| name                 |
      |user1   | I Example Conference |
    And there are following articles:
      |title  | keyword  | abstract              |  stateEnd  |
      |first  | example1 | 1tex example abstract |  sent      |

    And there are following reviewer:
      |username|title|
      |user1   |first|
      |user1   |first2|

    Scenario: can see button as reviewer
      Given I am on the homepage
      And I should see "Assigned Reviews"

    Scenario: list articles
      Given I am on the homepage
      When I follow "Assigned Reviews"
      Then I should be on page articles reviewer
      And I should see 2 reviewer

    Scenario: edit article
      Given I am on page articles reviewer
      When I follow "2"
      Then I should see on page edit "first"
      And I should see "1tex example abstract"

    Scenario: send empty comment
      Given I am on the edit page "first"
      When I press "Create"
      Then I should see "This value should not be blank."

    Scenario: send comment too short Comment
      Given I am on the edit page "first"
      When I fill in the following:
        |Comment   |this |
      Then I press "Create"
      Then I should see "too short"

    Scenario: send comment
      Given I am on the edit page "first"
      When I fill in the following:
        |Comment   |this article is very good |
        |Comment private|this article has a seven point|
      And I press "Create"
      Then I should be on page articles reviewer
      And I should see " Your article has been successfully edited"

#
#
