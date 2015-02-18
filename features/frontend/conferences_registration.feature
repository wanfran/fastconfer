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
    And there are following conferences:
      | name                    | slug                  | description                                | registration_starts_at | registration_ends_at |
      | I Example Conference    | i-example-conference  | Description of the I Example Conference    | 2015/01/01             | 2015/01/31           |
      | II Example Conference   | ii-example-conference | Description of the II Example Conference   | 2014/01/01             | 2014/01/31           |

#  Scenario: Join to an open conference
#    Given I am on the conference page for "I Example Conference"
#    When I press "Sign up"
#    Then I should still be on the conference page for "I Example Conference"
#    And I should see "Registered"

  Scenario: Open the page of a closed conference
    Given I am on the conference page for "II Example Conference"
    Then I should see "Registration is closed"

  Scenario: Join to a closed conference
    Given I am on "/conference/ii-example-conference/inscription"
    Then I should be on the conference page for "II Example Conference"
    And I should see "You can not register for this conference"

#  Scenario: Try to register to the same conference
#    Given I am on the conference page for "I Example Conference"
#    When I should not see "Sign up"
#    And I am on "/conference/i-example-conference/inscription"
#    Then I should be on the conference page for "I Example Conference"
#    And I should see "You can not register again in this conference"
