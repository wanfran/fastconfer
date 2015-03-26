@reviewer @sprint4

Feature: review an article
  In order to comment some articles
  As a reviewer
  I want to be able to comment some articles

  Background:
    Given there are following users:
      | username    | email             | plainPassword | enabled  |
      | user1       | user1@uco.es      | secret1       | 1        |

    And I am authenticated as "user1" with "secret1"
    And there are following articles:
      |title | authors | keyword  | abstract             |  stateEnd                  |
      |first | userA   | example1 | 1tex example abstract|  sent                      |
      |first2 | userA   | example1 | 1tex example abstract|  sent                      |
      |first3 | userA   | example1 | 1tex example abstract|  sent                      |

    And there are following reviewer:
      |username|title|
      |user1   |first|
      |user1   |first2|



    Scenario: can see button as reviewer
      Given I am on the homepage
      And I should see "Articles for Review"

    Scenario: List articles
      Given I am on the homepage
      When I follow "Articles for Review"
      Then I should be on page articles reviewer
      And I should see 2 reviewer


