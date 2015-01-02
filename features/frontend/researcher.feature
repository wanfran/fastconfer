#language: es

Característica: Investigador
    Para administrar un artículo
    Como investigador del artículo
    Quiero poder subir un artículo

    Antecedentes:
        Dado que estoy dentro del sistema
        Y que estoy autentificado como investigador:
            |archivo|
            |aux1|

    Escenario: Listar Congresos
        Dado que estoy en la página principal de usuario
        Y presiono "Mostrar"

    Escenario: Listar congresos
        Dado que estoy en la página principal de usuario
        Y presiono “Mostrar”
        Entonces se listan los congresos existentes

    Escenario: Enviar formulario vacío
        Dado que tengo listado los congresos
        Y presiono “ Inscribirse”
        Entonces debería estar en la página princial de usuario
        Y debo ver "Usted NO esta Registrado"

    Escenario: Rellenar el formulario
        Dado que tengo listado los congresos
        Cuando tengo seleccionado un congreso “x”
        Y relleno lo siguiente:
            | Nombre | Pepito |
            | Apellidos | Perez |
            | DNI | 1111111X |
        Y adjunto el archivo "aux1"
        Y presiono “ Inscribirse”
        Entonces debería estar en la página princial de usuario
        Y debo ver "Usted esta Registrado"

    Escenario: Modificar un artículo
        Dado que estoy en la página princial de usuario
        Cuando tengo seleccionado el artículo “aux1”
        Y presiono el botón “Modificar”
        Y debo ver "Modificación Realizada"

    Escenario: Eliminar un artículo
        Dado que estoy en la página princial de usuario
        Cuando tengo seleccionado el artículo “aux1”
        Y presiono el botón “Eliminar”
        Y debo ver "Artículo Eliminado"


