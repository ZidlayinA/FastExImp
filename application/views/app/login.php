<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastExImp</title>
    <link rel="stylesheet" href="<?php echo base_url("public/css/style.css") ?>" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body
    style="background-image: url('<?php echo base_url("public/img/Fondo-fast.png"); ?>'); background-size: cover; background-position: center;">
    <div class="flex-container">
        <div class="logo-container">
            <span style="color: #0c344c;">Fast</span><span style="color: #f50000;">ExImp</span>
        </div>
        <div class="log-in-container">
            <div class="header">
                <div class="logIn active">
                </div>
            </div>
            <div class="form">
                <div class="login-container-v2" id="loginContainer">
                    <h1>INICIAR SESION</h1>
                    <?php echo form_open('app/login'); ?>
                    <div class="input-group">
                        <input class="input" type="text" name="login[usuario]" required autocomplete="username">
                        <label for="usuario">Nombre de usuario</label>
                    </div>
                    <div class="input-group">
                        <input class="input" type="password" name="login[contrasena]" id="contrasena"
                            autocomplete="current-password" required />
                        <label for="password">Contraseña</label>
                    </div>
                </div>
                <button type="submit" class="Enviar">INGRESAR</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    var alertaActivado = <?php echo isset($alerta["Activado"]) ? $alerta["Activado"] : '0'; ?>;
    var alertaIcon = "<?php echo isset($alerta["icon"]) ? $alerta["icon"] : ''; ?>";
    var alertaTitle = "<?php echo isset($alerta["title"]) ? $alerta["title"] : ''; ?>";
    var alertaText = "<?php echo isset($alerta["text"]) ? $alerta["text"] : ''; ?>";

    if (alertaActivado == 1) {
        Swal.fire({
            icon: alertaIcon,
            title: alertaTitle,
            text: alertaText,
            confirmButtonColor: '#3085d6'
        });
    }
</script>