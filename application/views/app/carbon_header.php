<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastExImp</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <link rel="stylesheet" href="<?php echo base_url("public/css/style_dashboard.css")?>"/>
  </head>
  
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="<?php echo site_url("bandeja/bandeja/dashboard")?>"> Fast EXIMP</a>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?php echo site_url("bandeja/bandeja/index/")?>">Bandeja</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo site_url("cliente/cliente/index/")?>">Clientes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo site_url("contrato/contrato/index/")?>">Contratos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo site_url("dispersion/dispersion/index/")?>">Dispersión</a>
            </li>
          </ul>

          <ul class="navbar-nav flex-row">
            <li class="nav-item me-3 me-lg-0 dropdown">
              <a data-mdb-dropdown-init class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-expanded="false">
                <i class="fas fa-user"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="#">Ver Perfil</a>
                </li>
                <li><hr class="dropdown-divider"/></li>
                <li>
                  <a class="dropdown-item" href="#" onclick="btn_salir()">Cerrar Sesión</a>
                </li>
              </ul>
            </li>
          </ul>
      </div>
    </div>
  </nav>

  
  