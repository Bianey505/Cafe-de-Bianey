<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Primera Página Web</title>

    <!-- Enlace al archivo CSS -->
     <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <header>
        <h1>Mi Primera Página Web</h1>
        <p>Ejemplo utilizando HTML, CSS, y PHP</p>
    </header>

    <main>
        <section class="contenido">
            <h2>Bienvenido</h2>

            <p>
                Esta página fue creada utilizando HTML, CSS y PHP
                y se ejecuta mediante XAMPP.
            </p>

            <?php
                $nombre = "Estudiante";
                $fecha = date("d/m/Y");
            ?>

            <div class="mensaje">
                <h3>Información</h3>
                <p>Hola, <?php echo $nombre; ?>.</p>
                <p>La página funciona correctamente.</p>
            </div>
        </section>
    </main>

    <footer>
        <p>Bianey Zenteno - Programación Web 505</p>
    </footer>

</body>
</html>
