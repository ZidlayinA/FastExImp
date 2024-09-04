<?php $this->load->view('app/carbon_header'); ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Listado de Contratos</h2>
    
    <div class="card">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-4">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Buscar contrato..." id="searchInput">
              <button class="btn btn-primary" type="button" id="searchButton">
                <i class="fas fa-search"></i> Buscar
              </button>
            </div>
          </div>
          <div class="col-md-4">
            <select class="form-select" id="institutionFilter">
              <option value="">Todas las instituciones</option>
              <!-- Institutions will be dynamically added here -->
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-select" id="statusFilter">
              <option value="">Todos los estados</option>
              <option value="Activo">Activo</option>
              <option value="Inactivo">Inactivo</option>
              <option value="Pendiente">Pendiente</option>
            </select>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Tipo de Contrato</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Estado</th>
                <th>Institución</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id="contractTableBody">
              <!-- Contract data will be dynamically added here -->
            </tbody>
          </table>
        </div>

        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center" id="pagination">
            <!-- Pagination will be dynamically added here -->
          </ul>
        </nav>
      </div>
    </div>
  </div>

<?php $this->load->view('app/carbon_footer'); ?>

<script>
    // Simulated contract data (replace with actual API calls)
    const contracts = [
      { id: 1, client: "Juan Pérez", type: "Préstamo", startDate: "2023-01-01", endDate: "2024-01-01", status: "Activo", institution: "Banco XYZ" },
      { id: 2, client: "María López", type: "Hipoteca", startDate: "2023-02-15", endDate: "2033-02-15", status: "Activo", institution: "Banco XYZ" },
      { id: 3, client: "Carlos Rodríguez", type: "Seguro", startDate: "2023-03-10", endDate: "2024-03-10", status: "Pendiente", institution: "Cooperativa ABC" },
      { id: 4, client: "Ana Martínez", type: "Inversión", startDate: "2023-04-01", endDate: "2025-04-01", status: "Activo", institution: "Cooperativa ABC" },
      { id: 5, client: "Pedro Sánchez", type: "Préstamo", startDate: "2023-05-20", endDate: "2024-05-20", status: "Inactivo", institution: "Financiera 123" },
      { id: 6, client: "Laura Gómez", type: "Seguro", startDate: "2023-06-05", endDate: "2024-06-05", status: "Activo", institution: "Financiera 123" },
      // Add more contract data as needed
    ];

    const itemsPerPage = 5;
    let currentPage = 1;
    let filteredContracts = [...contracts];

    function renderContracts() {
      const tableBody = document.getElementById('contractTableBody');
      tableBody.innerHTML = '';

      const start = (currentPage - 1) * itemsPerPage;
      const end = start + itemsPerPage;
      const paginatedContracts = filteredContracts.slice(start, end);

      let currentInstitution = '';

      paginatedContracts.forEach(contract => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${contract.id}</td>
          <td>${contract.client}</td>
          <td>${contract.type}</td>
          <td>${contract.startDate}</td>
          <td>${contract.endDate}</td>
          <td><span class="status-${contract.status.toLowerCase()}">${contract.status}</span></td>
          <td>${contract.institution}</td>
          <td>
            <button class="btn btn-primary btn-sm" onclick="viewContract(${contract.id})">
              <i class="fas fa-eye"></i>
            </button>
            <button class="btn btn-warning btn-sm" onclick="editContract(${contract.id})">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm" onclick="deleteContract(${contract.id})">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        `;
        tableBody.appendChild(row);
      });

      renderPagination();
    }

    function renderPagination() {
      const pagination = document.getElementById('pagination');
      const pageCount = Math.ceil(filteredContracts.length / itemsPerPage);
      pagination.innerHTML = '';

      for (let i = 1; i <= pageCount; i++) {
        const li = document.createElement('li');
        li.classList.add('page-item');
        if (i === currentPage) li.classList.add('active');
        li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
        pagination.appendChild(li);
      }
    }

    function changePage(page) {
      currentPage = page;
      renderContracts();
    }

    function populateInstitutionFilter() {
      const institutionFilter = document.getElementById('institutionFilter');
      const institutions = [...new Set(contracts.map(contract => contract.institution))];
      institutions.forEach(institution => {
        const option = document.createElement('option');
        option.value = institution;
        option.textContent = institution;
        institutionFilter.appendChild(option);
      });
    }

    function filterContracts() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      const institutionFilter = document.getElementById('institutionFilter').value;
      const statusFilter = document.getElementById('statusFilter').value;

      filteredContracts = contracts.filter(contract => {
        const matchesSearch = Object.values(contract).some(value => 
          value.toString().toLowerCase().includes(searchTerm)
        );
        const matchesInstitution = institutionFilter === '' || contract.institution === institutionFilter;
        const matchesStatus = statusFilter === '' || contract.status === statusFilter;
        return matchesSearch && matchesInstitution && matchesStatus;
      });

      currentPage = 1;
      renderContracts();
    }

    function viewContract(id) {
      // Implement view contract functionality
      console.log(`View contract with ID: ${id}`);
    }

    function editContract(id) {
      // Implement edit contract functionality
      console.log(`Edit contract with ID: ${id}`);
    }

    function deleteContract(id) {
      // Implement delete contract functionality
      console.log(`Delete contract with ID: ${id}`);
    }

    // Event listeners
    document.getElementById('searchButton').addEventListener('click', filterContracts);
    document.getElementById('searchInput').addEventListener('keyup', filterContracts);
    document.getElementById('institutionFilter').addEventListener('change', filterContracts);
    document.getElementById('statusFilter').addEventListener('change', filterContracts);

    // Initialize the page
    populateInstitutionFilter();
    renderContracts();

    // In a real-world scenario, you would fetch data from an API
    // Example using axios:
    /*
    axios.get('https://api.example.com/contracts')
      .then(response => {
        contracts = response.data;
        filteredContracts = [...contracts];
        populateInstitutionFilter();
        renderContracts();
      })
      .catch(error => {
        console.error('Error fetching contract data:', error);
      });
    */
  </script>