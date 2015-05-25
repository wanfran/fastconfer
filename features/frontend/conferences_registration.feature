@conference @sprint1
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

#  Scenario: Join to an open conference
#    Given I am on the conference page for "I Example Conference"
#    When I press "Sign up"
#    Then I should still be on the conference page for "I Example Conference"
#    And I should see "Registered"

  @javascript
  Scenario: Open the page of a closed conference
    Given I am on the conference page for "II Example Conference"
    Then I should see "Register now!"
    Then I should see "Send article"

#    Then I should see "You can not register for this conference"

#  Scenario: Join to a closed conference
#    Given I am on "/conference/ii-example-conference/inscription"
#    Then I should be on the conference page for "I Example Conference"
#    And I should see "You can not register for this conference"

#  Scenario: Try to register to the same conference
#    Given I am on the conference page for "I Example Conference"
#    When I should not see "Sign up"
#    And I am on "/conference/i-example-conference/inscription"
#    Then I should be on the conference page for "I Example Conference"
#    And I should see "You can not register again in this conference"
