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
      | name   | description | date    |
      | Ritsi  | muy cool    |10/1/2015|
      | Madlis | bohemio     |10/1/2015|
      | Codoc  | mainstream  |10/1/2015|


  Scenario: Details of conferences
    Given I am on the homepage
    When I follow "List Conferences"
    Then I should be on "/conferences"

  Scenario: List conferences
    Given I am on "/conferences"
    Then I should see "RITSI"
    And I should see "Madlis"
    And I should see "Codoc"

  Scenario: when it not has conferences
    Given I am on "/conferences"
    Then I should not see "No hay datos"

  Scenario: Details the conference
    Given I am on "/conferences"
    When I follow "Show more details"
    Then I should be on "/conference/ritsi"

  Scenario: Inscription in the conference
    Given I am on "/conference/ritsi"
    And I should see "Ritsi"
    And I should see "muy cool"
    When I follow "Sign up"
    Then I should be on "/conference/ritsi/inscription"


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