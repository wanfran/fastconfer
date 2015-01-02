#language: es


Característica: Revisor
    Para administrar un artículo
    Como revisor del artículo
    Quiero poder comentar artículos

    Antecedentes:
        Dado que estoy dentro del sistema
        Y que estoy autentificado como revisor:
            |artículo|evaluado|fecha_Inicio|fecha_Fin |
            |  arti1 |    0   |  05/01/15  | 10/01/15 |
            |  arti2 |    0   |  05/01/15  | 10/01/15 |
            |  arti3 |    0   |  05/01/15  | 10/01/15 |


    Escenario: Listar artículos asignados
        Dado que estoy en la página del revisor
        Y presiono “Mostrar”
        Entonces debería ver 3 artículos

    Escenario: Revisar artículo expirado
        Dado que estoy en la página del revisor
        Y presiono “Revisar”
        Entonces el elemento "fecha_Fin" debe contener "10/01/15" // no se como poner que sea menor al tiempo fin
        Y debo ver "Tiempo Expirado"

    Escenario: Revisar artículo No expirado
        Dado que estoy en la página del revisor
        Y presiono “Revisar”
        Entonces el elemento "fecha_Fin" debe contener "10/01/15"
        Entonces debo ver el contenido de "articulo"
        Y debo ver "Revision realizada"