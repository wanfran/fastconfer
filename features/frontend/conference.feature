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
    Y no hay ningún congreso activo
    Entonces no debo ver "RITSI"