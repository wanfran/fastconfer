#language: es

@article
Característica: artículo
    Para llevar una gestión de los artículos
    Como revisor de artículos
    Quiero poder listar y evaluar los mismos

    Antecedentes:
      Dado que existen los siguientes artículos:
        |  title | description |
        |  arti1 |    hola     |
        |  arti2 |    cara     |
        |  arti3 |    pan      |

    Escenario: Listar artículos asignados
      Dado estoy en la página de inicio
      Entonces debo ver "arti1"
      Y debo ver "arti2"
      Y debo ver "arti3"
      Y debo ver 3 artículos

    Escenario: Cuando no hay artículos
      Dado estoy en la página de inicio
      Y no hay ningún artículo activo
      Entonces debo ver "No hay articulos"

    Escenario: Seleccionar artículo
      Dado estoy en la página principal de congresos
      Y presiono "Detalles" junto a "arti1"
      Entonces debería estar en la página del artículo con nombre "arti1"

