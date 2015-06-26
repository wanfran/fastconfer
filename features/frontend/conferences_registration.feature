@conference @sprint2
Feature: Join a conference
  In order to send my articles
  As a researcher
  I want to be able to join to a conference

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
      | user2     | b@uco.es  | secret2       | 1       |
      | user3     | c@uco.es  | secret3       | 1       |

    And there are following conferences:
      | name                    | city    | description                               | code  | url       |dateStart  | dateEnd    | topics |deadTime   |dateNews   |chairmans|
      | I Example Conference    | London1 | Description of the I Example Conference   | code1 | www.a.com |2014/01/01 | 2014/01/01 | topicA |2014/01/01 |2014/01/01 |user2    |
      | II Example Conference   | London2 | Description of the II Example Conference  | code2 | www.b.com |now -3 days| now +3 days| topicB |now +3 days|now +3 days|user3    |

  Scenario: closed conference details
    Given I am on the conference page for "I Example Conference"
    Then I should see "I Example Conference"
    Then I should see "London1"
    Then I should see "Description of the I Example Conference"
    Then I should see "www.a.com"
    Then I should see "topicA"

  Scenario: open conference details
    Given I am on the conference page for "II Example Conference"
    Then I should see "II Example Conference"
    Then I should see "London2"
    Then I should see "Description of the II Example Conference"
    Then I should see "www.b.com"
    Then I should see "topicB"

  Scenario: Open the page of a closed conference
    Given I am on the conference page for "I Example Conference"
    Then I should see "Register now!"
    When I press "Register now!"
    When I press "Yes"
    Then I should see "You can not register for this conference"

  Scenario: Join to an open conference
    Given I am on the conference page for "II Example Conference"
    Then I should see "Register now!"
    When I press "Register now!"
    When I press "Yes"
    Then I should see "Congratulations you are already registered"

