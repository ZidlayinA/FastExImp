<?php $this->load->view('app/carbon_header'); ?>

<div class="container mt-4">
    <h2 class="mb-4" id="subtitulo">Dashboard General</h2>
    
    <!-- Resumen de Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-4 mb-4">
            <div class="card dashboard-card border border-primary">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-file-alt me-2"></i>Solicitudes</h5>
                    <h2 class="card-text" id="totalSolicitudes">0</h2>
                    <p class="card-text text-muted">Total de solicitudes</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card dashboard-card border border-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning"><i class="fas fa-file-contract me-2"></i>Contratos</h5>
                    <h2 class="card-text" id="totalContratos">0</h2>
                    <p class="card-text text-muted">Total de contratos</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card dashboard-card border border-success">
                <div class="card-body">
                    <h5 class="card-title text-success"><i class="fas fa-money-bill-wave me-2"></i>Dispersiones</h5>
                    <h2 class="card-text" id="totalDispersiones">$0</h2>
                    <p class="card-text text-muted">Monto total dispersado</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tablas -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card dashboard-card">
                <div class="card-header">
                    <h5 class="mb-0 text-danger">Últimas Solicitudes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody id="solicitudesTable">
                                <!-- Datos de solicitudes se insertarán aquí -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card dashboard-card">
                <div class="card-header">
                    <h5 class="mb-0 text-danger">Últimos Contratos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody id="contratosTable">
                                <!-- Datos de contratos se insertarán aquí -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Datos de ejemplo
    const solicitudes = [
        { id: 1, cliente: 'Juan Pérez', monto: 5000, estado: 'Aprobada' },
        { id: 2, cliente: 'María López', monto: 7500, estado: 'En revisión' },
        { id: 3, cliente: 'Carlos Gómez', monto: 3000, estado: 'Rechazada' },
        { id: 4, cliente: 'Ana Martínez', monto: 10000, estado: 'Aprobada' },
        { id: 5, cliente: 'Pedro Sánchez', monto: 6000, estado: 'En revisión' }
    ];

    const contratos = [
        { id: 1, cliente: 'Juan Pérez', fecha: '2023-06-15', estado: 'Activo' },
        { id: 2, cliente: 'María López', fecha: '2023-06-14', estado: 'Pendiente' },
        { id: 3, cliente: 'Carlos Gómez', fecha: '2023-06-13', estado: 'Finalizado' },
        { id: 4, cliente: 'Ana Martínez', fecha: '2023-06-12', estado: 'Activo' },
        { id: 5, cliente: 'Pedro Sánchez', fecha: '2023-06-11', estado: 'Pendiente' }
    ];

    const dispersiones = [
        { mes: 'Enero', monto: 50000 },
        { mes: 'Febrero', monto: 65000 },
        { mes: 'Marzo', monto: 55000 },
        { mes: 'Abril', monto: 70000 },
        { mes: 'Mayo', monto: 80000 },
        { mes: 'Junio', monto: 75000 }
    ];

    // Actualizar resumen de estadísticas
    document.getElementById('totalSolicitudes').textContent = solicitudes.length;
    document.getElementById('totalContratos').textContent = contratos.length;
    document.getElementById('totalDispersiones').textContent = '$' + dispersiones.reduce((sum, disp) => sum + disp.monto, 0).toLocaleString();

    // Poblar tabla de solicitudes
    const solicitudesTable = document.getElementById('solicitudesTable');
    solicitudes.forEach(sol => {
        const row = solicitudesTable.insertRow();
        row.innerHTML = `
            <td>${sol.id}</td>
            <td>${sol.cliente}</td>
            <td>$${sol.monto.toLocaleString()}</td>
            <td><span class="badge rounded-pill ${getStatusClass(sol.estado)}">${sol.estado}</span></td>
        `;
    });

    // Poblar tabla de contratos
    const contratosTable = document.getElementById('contratosTable');
    contratos.forEach(con => {
        const row = contratosTable.insertRow();
        row.innerHTML = `
            <td>${con.id}</td>
            <td>${con.cliente}</td>
            <td>${con.fecha}</td>
            <td><span class="badge rounded-pill ${getStatusClass(con.estado)}">${con.estado}</span></td>
        `;
    });

    // Función para asignar clase de color a los estados
    function getStatusClass(status) {
        switch(status.toLowerCase()) {
            case 'aprobada':
            case 'activo':
                return 'bg-success';
            case 'en revisión':
            case 'pendiente':
                return 'bg-warning';
            case 'rechazada':
            case 'finalizado':
                return 'bg-danger';
            default:
                return 'bg-secondary';
        }
    }
</script>


<?php $this->load->view('app/carbon_footer'); ?>