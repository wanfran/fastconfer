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
    And there are following conferences:
      | name                    | slug                  | description                                | registration_starts_at | registration_ends_at |dead_time  |topics |
      | I Example Conference    | i-example-conference  | Description of the I Example Conference    | 2015/01/01             | 2015/04/30           |2015/04/25 |topicA |
    And there are following articles:
      |title | authors | keyword  | abstract             |  state |
      |first | userA   | example1 | 1tex example abstract|  sent  |
      |second| userB   | example2 | 2tex example abstract|  sent  |
      |third | userC   | example3 | 3tex example abstract|  sent  |
    And there are following inscriptions:
      |username| name                 |
      |user1   | I Example Conference |


  Scenario: go page of upload
      Given I am on the inscription page for "I Example Conference"
      Then I should see "Send new article"
      When I follow "Send new article"
      Then I should be on the upload page for "I Example Conference"

    Scenario: send empty form
      Given I am on the upload page for "I Example Conference"
      When I press "Create"
      Then I should see "This value should not be blank."

     Scenario: send form
       Given I am on the upload page for "I Example Conference"
       When I fill in the following:
       |Title   |first   |
       |Author  |userA   |
       |Keyword |example1|
       |Abstract|1tex example abstract|
       Then I check "topicA"
       And the "topicA" checkbox should be checked
       And I attach the file "Perrito.jpg" to "article_path"
       When I press "Create"
       Then I should be on the conference page for "I Example Conference"
       Then I should see "Your article has been successfully uploaded"

