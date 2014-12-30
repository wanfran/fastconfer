#language: es

Característica: Organizador
Para administrar un congreso
Como organizador del congreso
Quiero poder crear tareas gestoras

Antecedentes
Dado que estoy dentro del sistema
Y estoy autentificado como organizador

Escenario: Listar revisores
Dado que estoy en la página listar revisores
Y presionar el botón “listar”
Entonces estoy mostrando la lista de los revisores

Escenario: Asignar revisores al artículo
Dado que tengo listado los revisores
Cuando tengo seleccionado un artículo “x”
Y presionar el botón “asignar” 3 veces
Entonces estoy asignando revisores al artículo “x”

Escenario: Leer revisiones
Dado que tengo revisados
Cuando el tiempo expira
Y presionar el botón “mostrar revisiones”
Entonces estoy se muestran las revisiones del artículo “x”

Escenario: Enviar notificación correo
Dado que tengo las revisiones del artículo “x”
Cuando tengo seleccionado un investigador “x”
Y presionar el botón “enviar”
Entonces estoy enviando correo al investigador “x”


Pruebas para revisores.

Antecedentes
Dado que estoy dentro del sistema
Y estoy autentificado como revisor

Escenario: Listar artículos asignados
Dado que tengo artículos asignados
Y presionar el botón “mostrar artículos”
Entonces estoy se muestran los artículos asignados

Escenario: Revisar artículo
Dado que tengo artículos asignados
Cuando el tiempo aún no esté expirado
Y presionar el botón “revisar”
Entonces estoy se muestra el contenido del artículo “x”