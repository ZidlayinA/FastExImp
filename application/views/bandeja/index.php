
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo base_url("public/css/style_dashboard.css")?>"/>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#" >Fast EXIMP</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo site_url("cliente/cliente/index/")?>">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("bandeja/bandeja/index/")?>">Bandeja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("contrato/contrato/index/")?>">Contratos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("dispersion/dispersion/index/")?>">Dispersión</a>
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
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="btn_salir()">Cerrar Sesión</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-md" >
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2" id="subtitulo">Dashboard Ejecutivo</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <i class="bi bi-calendar"></i>
                    Esta semana
                </button>
            </div>
        </div>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 mb-4">
            <div class="col">
                <div class="card text-bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Solicitudes Pendientes</h5>
                        <h2 class="card-text">15</h2>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Contratos por Revisar</h5>
                        <h2 class="card-text">7</h2>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Clientes Activos</h5>
                        <h2 class="card-text">132</h2>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Dispersiones Pendientes</h5>
                        <h2 class="card-text">5</h2>
                    </div>
                </div>
            </div>
        </div>
        
        <h2 id="subtitulo">Solicitudes Recientes</h2>
        <div class="table-responsive">
            <table class="table table-striped ">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>SOL-001</td>
                        <td>Juan Pérez</td>
                        <td>Préstamo Personal</td>
                        <td>$10,000</td>
                        <td>15/05/2023</td>
                        <td><span class="badge bg-warning text-dark status-badge">Pendiente</span></td>
                    </tr>
                    <tr>
                        <td>SOL-002</td>
                        <td>María García</td>
                        <td>Crédito Automotriz</td>
                        <td>$150,000</td>
                        <td>14/05/2023</td>
                        <td><span class="badge bg-success status-badge">Aprobada</span></td>
                    </tr>
                    <tr>
                        <td>SOL-003</td>
                        <td>Carlos López</td>
                        <td>Préstamo Hipotecario</td>
                        <td>$500,000</td>
                        <td>13/05/2023</td>
                        <td><span class="badge bg-danger status-badge">Rechazada</span></td>
                    </tr>
                    <tr>
                        <td>SOL-004</td>
                        <td>Ana Martínez</td>
                        <td>Préstamo Personal</td>
                        <td>$15,000</td>
                        <td>12/05/2023</td>
                        <td><span class="badge bg-warning text-dark status-badge">Pendiente</span></td>
                    </tr>
                    <tr>
                        <td>SOL-005</td>
                        <td>Roberto Sánchez</td>
                        <td>Crédito PYME</td>
                        <td>$200,000</td>
                        <td>11/05/2023</td>
                        <td><span class="badge bg-success status-badge">Aprobada</span></td>
                    </tr>
                </tbody>
            </table>
        </div>            
    </div>


    <script>
    document.querySelectorAll('.sidebar .nav-link').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.sidebar .nav-link').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            alert('Cargando sección: ' + this.dataset.section);
        });
    });

    // Funcionalidad para el avatar del usuario en el navbar
    document.querySelector('.navbar .d-flex').addEventListener('click', function() {
        alert('Opciones de usuario');
    });

    function btn_salir(){
        localStorage.clear();
        location = '<?php echo site_url("app/logout")?>'
    }
    </script>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>

</body>