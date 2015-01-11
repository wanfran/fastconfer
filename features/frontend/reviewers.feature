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
        Entonces debería estar en la página principal de congresos
        Y debería ver 3 artículos

    Escenario: Seleccionar artículo
        Dado que estoy en la página principal de congresos
        Y presiono "Detalles" junto a "arti1"
        Entonces debería estar en la página del artículo con nombre "arti1"

    Escenario: Revisar artículo expirado
        Dado que estoy en la página del artículo con nombre "arti1"
        Y presiono “Revisar”
        Entonces el elemento "fecha_Fin" debe contener "10/01/15" // no se como poner que sea menor al tiempo fin
        Y debo ver "Tiempo Expirado"

    Escenario: Revisar artículo No expirado Ni evaluado
        Dado que estoy en la página del artículo con nombre "arti1"
        Y presiono “Revisar”
        Entonces el elemento "fecha_Fin" debe contener "10/01/15"
        Cuando relleno "evaluado" a "1"
        Y debo ver "Revision realizada"

    Escenario: Revisar artículo No expirado Si evaluado
        Dado que estoy en la página del artículo con nombre "arti1"
        Y presiono “Revisar”
        Entonces el elemento "evaluado" debe contener "0"
        Y debo ver "Este artículo ya esta revisado"