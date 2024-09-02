<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FastExImp</title>
        <link rel="stylesheet" href="<?php echo base_url("public/css/style.css")?>"/>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <div class="login-container" id="loginContainer">
            <h1>Iniciar Sesión</h1>
            <?php echo form_open('app/login'); ?>
            <div class="input-group">
                <!--input type="text" id="user" name="user" placeholder=" "-->
                <input class="input" type="text" name="login[usuario]" require autocomplete="username" >
                <label for="usuario">Nombre de usuario</label>
            </div>
            <div class="input-group">
                <input class="input" type="password" name="login[contrasena]" id="contrasena"  autocomplete="current-password" require/>
                    
                <label for="password">Contraseña</label>
            </div>
            <button type="submit">Ingresar</button>
            <?php //echo form_close(); ?>
            </form></form>
        </div>


  <style>
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
      20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    .shake {
      animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
    }
  </style>

<?php if (isset($alerta["Activado"]) && $alerta["Activado"] == 1): ?>
        <script>
            Swal.fire({
                icon: '<?= $alerta["icon"] ?>',
                title: '<?= $alerta["title"] ?>',
                text: '<?= $alerta["text"] ?>',
                confirmButtonColor: '#3085d6'
            });
        </script>
    <?php endif; ?>

</body>
</html>