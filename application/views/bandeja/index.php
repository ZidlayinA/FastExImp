<?php $this->load->view('app/carbon_header'); ?>

    <div class="container-md">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2" id="subtitulo">Solicitudes de Crédito</h1>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 mb-4">
            <div class="col">
                <div class="card border border-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-danger"><i class="fas fa-paper-plane"></i>
                            Solicitudes sin Enviar
                        </h5>
                        <h2 class="card-text">15</h2>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border border-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-warning"><i class="fas fa-file-signature"></i>
                            Documentos en Revisión
                        </h5>
                        <h2 class="card-text">7</h2>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><i class="fas fa-magnifying-glass"></i>
                            Documentos en Análisis
                        </h5>
                        <h2 class="card-text">132</h2>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border border-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-success"><i class="fas fa-signature"></i>
                            Documentos para Firmar
                        </h5>
                        <h2 class="card-text">5</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar solicitudes...">
                    <button class="btn btn-outline-info" type="button" id="searchButton">Buscar</button>
                </div>
            </div>
            <div class="col-md-6">
                <select class="form-select" id="statusFilter">
                    <option value="all">Todos los estados</option>
                    <option value="pending">Pendiente</option>
                    <option value="approved">Aprobado</option>
                    <option value="rejected">Rechazado</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Solicitante</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="applicationTableBody">
                <!-- Table rows will be dynamically inserted here -->
                </tbody>
            </table>
        </div> 
    
        <!-- Modal for application details -->
        <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applicationModalLabel">Detalles de la Solicitud</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="applicationModalBody">
                    <!-- Application details will be dynamically inserted here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" id="approveButton">Aprobar</button>
                        <button type="button" class="btn btn-danger" id="rejectButton">Rechazar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('app/carbon_footer'); ?>

<script>
    // Simulated credit applications data
    let applications = [
      { id: 1, name: "Juan Pérez", email: "juan@example.com", phone: "1234567890", amount: 10000, purpose: "Negocio", date: "2023-05-01", status: "pending" },
      { id: 2, name: "Ana López", email: "ana@example.com", phone: "9876543210", amount: 5000, purpose: "Educación", date: "2023-05-03", status: "approved" },
      { id: 3, name: "Carlos Rodríguez", email: "carlos@example.com", phone: "5555555555", amount: 15000, purpose: "Vivienda", date: "2023-05-05", status: "rejected" },
      // Add more sample data as needed
    ];

    const itemsPerPage = 10;
    let currentPage = 1;
    let filteredApplications = [...applications];

    function renderApplications() {
      const tableBody = document.getElementById('applicationTableBody');
      tableBody.innerHTML = '';

      const startIndex = (currentPage - 1) * itemsPerPage;
      const endIndex = startIndex + itemsPerPage;
      const pageApplications = filteredApplications.slice(startIndex, endIndex);

      pageApplications.forEach(app => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${app.id}</td>
          <td>${app.name}</td>
          <td>$${app.amount.toFixed(2)}</td>
          <td>${app.date}</td>
          <td><span class="badge bg-${getStatusColor(app.status)} application-status">${getStatusText(app.status)}</span></td>
          <td>
            <button class="btn btn-sm btn-primary" onclick="viewApplication(${app.id})">Ver</button>
          </td>
        `;
        tableBody.appendChild(row);
      });

      renderPagination();
    }

    function renderPagination() {
      const pagination = document.getElementById('pagination');
      pagination.innerHTML = '';

      const totalPages = Math.ceil(filteredApplications.length / itemsPerPage);

      for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement('li');
        li.className = `page-item ${i === currentPage ? 'active' : ''}`;
        li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
        pagination.appendChild(li);
      }
    }

    function changePage(page) {
      currentPage = page;
      renderApplications();
    }

    function getStatusColor(status) {
      switch (status) {
        case 'pending': return 'warning';
        case 'approved': return 'success';
        case 'rejected': return 'danger';
        default: return 'secondary';
      }
    }

    function getStatusText(status) {
      switch (status) {
        case 'pending': return 'Pendiente';
        case 'approved': return 'Aprobado';
        case 'rejected': return 'Rechazado';
        default: return 'Desconocido';
      }
    }

    function viewApplication(id) {
      const app = applications.find(a => a.id === id);
      if (app) {
        const modalBody = document.getElementById('applicationModalBody');
        modalBody.innerHTML = `
          <p><strong>Solicitante:</strong> ${app.name}</p>
          <p><strong>Email:</strong> ${app.email}</p>
          <p><strong>Teléfono:</strong> ${app.phone}</p>
          <p><strong>Monto:</strong> $${app.amount.toFixed(2)}</p>
          <p><strong>Propósito:</strong> ${app.purpose}</p>
          <p><strong>Fecha:</strong> ${app.date}</p>
          <p><strong>Estado:</strong> <span class="badge bg-${getStatusColor(app.status)}">${getStatusText(app.status)}</span></p>
        `;

        const modal = new bootstrap.Modal(document.getElementById('applicationModal'));
        modal.show();

        const approveButton = document.getElementById('approveButton');
        const rejectButton = document.getElementById('rejectButton');

        approveButton.onclick = () => updateStatus(id, 'approved');
        rejectButton.onclick = () => updateStatus(id, 'rejected');
      }
    }

    function updateStatus(id, newStatus) {
      const app = applications.find(a => a.id === id);
      if (app) {
        app.status = newStatus;
        renderApplications();
        const modal = bootstrap.Modal.getInstance(document.getElementById('applicationModal'));
        modal.hide();
      }
    }

    function filterApplications() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      const statusFilter = document.getElementById('statusFilter').value;

      filteredApplications = applications.filter(app => {
        const matchesSearch = app.name.toLowerCase().includes(searchTerm) ||
                              app.email.toLowerCase().includes(searchTerm) ||
                              app.id.toString().includes(searchTerm);
        const matchesStatus = statusFilter === 'all' || app.status === statusFilter;
        return matchesSearch && matchesStatus;
      });

      currentPage = 1;
      renderApplications();
    }

    document.getElementById('searchButton').addEventListener('click', filterApplications);
    document.getElementById('searchInput').addEventListener('keyup', (e) => {
      if (e.key === 'Enter') filterApplications();
    });
    document.getElementById('statusFilter').addEventListener('change', filterApplications);

    // Initial render
    renderApplications();
    
</script>