@inscription @sprint2

Feature: fill form
  In order to send my article
  As a researcher
  I want to be able to fill form

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
      | name                   | city    | description                               | code  | url       |dateStart  | dateEnd    | topics |deadTime   |dateNews   |chairmans|
      | I Example Conference   | London2 | Description of the II Example Conference  | code2 | www.b.com |now -3 days| now +3 days| topicB |now +3 days|now +3 days|user3    |
    And there are following inscriptions:
      |username| name                 |
      |user1   | I Example Conference |
#    And there are following articles:
#      |title | authors | keyword  | abstract             |  stateEnd |
#      |first | userA   | example1 | 1tex example abstract|  sent     |
#      |second| userB   | example2 | 2tex example abstract|  sent     |
#      |third | userC   | example3 | 3tex example abstract|  sent     |

    Scenario: go page of new article
      Given I am on the conference page for "I Example Conference"
      Then I should see "Send article"
      When I follow "Send article"
      Then I should be on new article page for "I Example Conference"
      Then I should see "New submission"

    Scenario: send empty form
      Given I am on the new article page for "I Example Conference"
      Then I should see "Submit"
      When I press "Submit"
      Then I should see "This value should not be blank."

#    Scenario: send form too short Abstract
#      Given I am on the upload page for "I Example Conference"
#      When I fill in the following:
#        |Title   |first   |
#        |Author  |userA   |
#        |Keyword |example1|
#        |Abstract|1tex|
#      Then I check "topicA"
#      And the "topicA" checkbox should be checked
#      And I attach the file "Perrito.jpg" to "article_path"
#      When I press "Create"
#      Then I should see "too short"
#
#    Scenario: send form
#       Given I am on the upload page for "I Example Conference"
#       When I fill in the following:
#       |Title   |first   |
#       |Author  |userA   |
#       |Keyword |example1|
#       |Abstract|1tex example abstract|
#       Then I check "topicA"
#       And the "topicA" checkbox should be checked
#       And I attach the file "Perrito.jpg" to "article_path"
#       When I press "Create"
#       Then I should be on the conference page for "I Example Conference"
#       And I should see "Your article has been successfully uploaded"
#
#
