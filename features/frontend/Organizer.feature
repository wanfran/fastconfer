#language: es

Característica: Organizador
    Para administrar un congreso
    Como organizador del congreso
    Quiero poder crear tareas gestoras

    Antecedentes
        Dado que estoy dentro del sistema
        Y estoy autentificado como organizador:
            |investigador|artículo|revisor|evaluado|fecha_Fin |
            |    Adamm   |  arti1 | pepe  |   0    | 10/01/15 |
            |    Juanal  |  arti2 | juan  |   0    | 10/01/15 |
            |     Pino   |  arti3 | luis  |   0    | 10/01/15 |


    Escenario: Listar revisores
        Dado que estoy en la página del organizador
        Y presiono el botón “Listar”
        Entonces debería ver 3 resivores

    Escenario: Asignar revisores al artículo
        Dado que estoy en la página del organizador
        Y presiono “Asignar”
        Entonces estoy asignando revisores al artículo “artículo”

    Escenario: Leer revisiones
        Dado que estoy en la página del organizador
        Cuando "fecha_Fin" es 10/01/15
        Y presiono “Mostrar revisiones”
        Y debo ver "Artículo revisado"

    Escenario: Enviar notificación correo
        Dado que estoy en la página del organizador
        Cuando tengo seleccionado un investigador “investigador”
        Y presiono el botón “Enviar”
        Y debo ver "Correo Enviado"


