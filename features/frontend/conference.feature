@conference @sprint1

Feature: Conference register
  In order to register at a conference
  As user the system
  I want to be register in the system

  Background:
    Given that existing users:
      | username |  email   | plainPassword |enabled|
      |   pepe   | a@uco.es |      hola     |  1    |
      |   juan   | b@uco.e  |      jola     |  1    |

    And that existing conferences:
      | name   | description |slug|image|
      | Ritsi  | muy cool    | a  |as   |
      | Madlis | bohemio     | b  |ass  |
      | Codoc  | mainstream  | c  |sad  |


  Scenario: when it not has conferences
    Given I am on the homepage
    Then I should not see "No data"

  Scenario: List conferences
    Given I am on the homepage
    Then I should see "RITSI"
    And I should see "muy cool"
    And I should see "Madlis"
    And I should see "bohemio"
    And I should see "Codoc"
    And I should see "mainstream"

  Scenario: Show conference
    Given I am on the homepage
    And I should see "VIEW DETAILS"
    When I press "View details"
    Then I should be on "/conference/a"

  Scenario: Details the conference
    Given I am on "/conference/a"
    Then I should see "RITSI"
    And I should see "muy cool"
    And I should see "a"
    And I should see "as"

  Scenario: Inscription in the conference
    Given I am on "/conference/a"
    And I should see "Sign up"
    When I press "Sign up"
    Then I should be on "/conference/a"


#  Escenario: Apuntarse al congreso
#    Dado que estoy en la página de inicio
 #   Y presiono "Inscribirse"
  #  Entonces debería estar en la página alta del congreso

#  Escenario: Enviar formulario vacío
 #   Dado que estoy en la página alta del congreso
  #  Y presiono “Dar alta”
   # Entonces debería estar en la página de inicio
  #  Y debo ver "Usted NO esta dado de alta"

 # Escenario: Rellenar el formulario
 #   Dado que estoy en la página alta del congreso
 #   Y relleno lo siguiente:
 #   | Nombre | Pepito |
 #   | Apellidos | Perez |
 #   | DNI | 1111111X |
 #   |Correo|a@uco.es|
 #   Y adjunto el archivo "aux1"
 #   Y presiono “Dar alta”
  #  Entonces debería estar en la página de inicio
   # Y debo ver "Usted esta dado de alta"