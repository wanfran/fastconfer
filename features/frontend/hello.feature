#language: es
@symfony
Característica: Comprobar el funcionamiento de Symfony
    Para poder programar con Symfony y Behat
    Como desarrollador de la aplicación
    Quiero comprobar que el framework está bien configurado

    Escenario: Test de hola mundo
        Dado estoy en "/hello/world"
        Entonces debo ver "Hello world"