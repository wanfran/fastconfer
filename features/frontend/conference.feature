#language: es

@conference @sprint1
Característica: Visualizar congresos
  Para poder enviar un artículo a un congreso
  Como investigador que ha realizado un artículo
  Quiero poder visualizar los congresos disponibles

  Antecedentes:
    Dado que existen los siguientes congresos:
      |name    | description | date   |
      | Ritsi  | muy cool   |10/1/2015|
      | Madlis | bohemio    |10/1/2015|
      | Codoc  | mainstream |10/1/2015|

  Escenario: Listar congresos
    Dado estoy en la página de inicio
    Entonces debo ver "RITSI"
    Y debo ver "Madlis"
    Y debo ver "Codoc"

  Escenario: Cuanto no hay congresos
    Dado estoy en la página de inicio
    Entonces debo no ver "No hay datos"

  Escenario: Detalles del congreso
    Dado estoy en la página de inicio
    Y presiono "Detalles" junto a "Ritsi"
    Entonces debería estar en la página de congreso con nombre "Ritsi"

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