<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Y Registro - MerakiImpresiones</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="assets/css/estilos.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c971a05466.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <main>
            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesion para entrar al Sistema</p>
                        <button id="btn__iniciar-sesion"> Iniciar Sesion</button>
                    </div>
                    <div class="caja__trasera-register">
                        <h3>¿Aun no tienes una cuenta?</h3>
                        <p>Registrate para iniciar sesion para entrar al Sistema</p>
                        <button id="btn__registrarse"> Registrarse</button>
                    </div>
                
                </div>
                <!--FORMULARIO LOGIN REGISTRO-->
                <div class="contenedor__login-register">
                    <form action="assets/php/conexion_bd.php" class="formulario__login" method = "post">
                        <h2>Iniciar Sesion</h2>
                        <input type="text" id = "usuario" name = "usuario" placeholder="Usuario" required>
                        <input type="password" id = "password" name = "password" placeholder="Contraseña" required>
                        <button type = "submit" class = "btn btn-primary">Entrar</button>
                    </form>
                    <form action="" class="formulario__register" method = "post">
                        <h2>Registrarse</h2>
                        <input type="text" placeholder="Nombre">
                        <input type="text" placeholder="Apellido">
                        <input type="text" placeholder="Telefono">
                        <input type="email" placeholder="Correo Electronico">
                        <input type="text" placeholder="Usuario">
                        <input type="password" placeholder="Contraseña">
                        <button>Registrarse</button>
                    </form>

                </div>
                
            </div>
        </main>

        <script src="assets/js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>
</html>