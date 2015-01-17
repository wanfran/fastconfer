#language: es

Característica: Investigador
    Para administrar un artículo
    Como investigador del artículo
    Quiero poder subir un artículo

    Antecedentes:
        Dado que estoy dentro del sistema
        Y que estoy autentificado como investigador:
            |archivo|congreso|descripción | fecha   |
            | aux1  | Ritsi  | muy cool   |10/1/2015|
            | aux2  | Madlis | bohemio    |10/1/2015|
            | aux3  | Codoc  | mainstream |10/1/2015|

    Escenario: Listar congresos
        Dado que estoy en la página principal de usuario
        Y presiono “Mostrar”
        Entonces debería estar en la página principal de congresos
        Y debería ver 3 congresos en la lista

    Escenario: Detalles del congreso
        Dado que estoy en la página principal de congresos
        Y presiono "Detalles" junto a "Ritsi"
        Entonces debería estar en la página del congreso con nombre "Ritsi"

    Escenario: Apuntarse al congreso
        Dado que estoy en la página principal de congresos
        Y presiono "Inscribirse"
        Entonces debería estar en la página alta del congreso

    Escenario: Enviar formulario vacío
            Dado que estoy en la página alta del congreso
            Y presiono “Dar alta”
            Entonces debería estar en la página princial de congresos
            Y debo ver "Usted NO esta dado de alta"

    Escenario: Rellenar el formulario
        Dado que estoy en la página alta del congreso
        Y relleno lo siguiente:
            | Nombre | Pepito |
            | Apellidos | Perez |
            | DNI | 1111111X |
        Y adjunto el archivo "aux1"
        Y presiono “Dar alta”
        Entonces debería estar en la página princial de usuario
        Y debo ver "Usted esta dado de alta"

    Escenario: Modificar información personal
        Dado que estoy en la página princial de usuario
        Y presiono el botón “Modificar”
        Entonces debería estar en la página modificación

    Escenario: Actualizar información personal
        Dado que esto en la página modificación
        Y relleno lo siguiente:
            | Nombre | Juan |
            | Apellidos | Muñoz |
            | DNI | 0000000X |
        Y adjunto el archivo "aux2"
        Y presiono “Actualizar”
        Y debo ver "Actualización Realizada"

    Escenario: Eliminar un artículo
        Dado que estoy en la página modificación
        Cuando presiono "Eliminar" junto a "aux1"
        Entonces debo ver "¿Está seguro de que quiere borrar el artículo?"
        Cuando presiono "Sí"
        Entonces debería estar en la página principal de usuario
        Y debo ver "Artículo Eliminado"

    Escenario: Darse de baja en el congreso
        Dado que estoy en la página principal de congresos
        Cuando presiono "Borrar" junto a "Ritsi"
        Entonces debo ver "¿Está seguro de que quiere darse de baja?"
        Cuando presiono "Sí"
        Entonces debería estar en la página principal de usuario
        Y debo ver "Dado de Baja en el congreso"
        Pero no debo ver "Ritsi"
