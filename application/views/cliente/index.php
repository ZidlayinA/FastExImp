<?php $this->load->view('app/carbon_header'); ?>

<div class="container-md">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" id="subtitulo">Clientes</h1>
  </div>
  
  <div class="card">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Buscar cliente..." id="searchInput">
              <button class="btn btn-primary" type="button" id="searchButton">
                <i class="fas fa-search"></i> Buscar
              </button>
            </div>
          </div>
          <div class="col-md-6">
            <select class="form-select" id="institutionFilter">
              <option value="">Todas las instituciones</option>
              <!-- Institutions will be dynamically added here -->
            </select>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table-primary">
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Institución</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id="clientTableBody">
              <!-- Client data will be dynamically added here -->
            </tbody>
          </table>
        </div>

        
      </div>
    </div> 
</div>

<?php $this->load->view('app/carbon_footer'); ?>

<script>
    // Simulated client data (replace with actual API calls)
    const clients = [
      { id: 1, name: "Juan Pérez", email: "juan@email.com", phone: "123-456-7890", institution: "Banco XYZ" },
      { id: 2, name: "María López", email: "maria@email.com", phone: "234-567-8901", institution: "Banco XYZ" },
      { id: 3, name: "Carlos Rodríguez", email: "carlos@email.com", phone: "345-678-9012", institution: "Cooperativa ABC" },
      { id: 4, name: "Ana Martínez", email: "ana@email.com", phone: "456-789-0123", institution: "Cooperativa ABC" },
      { id: 5, name: "Pedro Sánchez", email: "pedro@email.com", phone: "567-890-1234", institution: "Financiera 123" },
      { id: 6, name: "Laura Gómez", email: "laura@email.com", phone: "678-901-2345", institution: "Financiera 123" },
      // Add more client data as needed
    ];

    const itemsPerPage = 5;
    let currentPage = 1;
    let filteredClients = [...clients];

    function renderClients() {
      const tableBody = document.getElementById('clientTableBody');
      tableBody.innerHTML = '';

      const start = (currentPage - 1) * itemsPerPage;
      const end = start + itemsPerPage;
      const paginatedClients = filteredClients.slice(start, end);

      let currentInstitution = '';

      paginatedClients.forEach(client => {

        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${client.id}</td>
          <td>${client.name}</td>
          <td>${client.email}</td>
          <td>${client.phone}</td>
          <td>${client.institution}</td>
          <td>
            <button class="btn btn-primary btn-sm" onclick="viewClient(${client.id})">
              <i class="fas fa-eye"></i>
            </button>
            <button class="btn btn-warning btn-sm" onclick="editClient(${client.id})">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm" onclick="deleteClient(${client.id})">
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
      const pageCount = Math.ceil(filteredClients.length / itemsPerPage);
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
      renderClients();
    }

    function populateInstitutionFilter() {
      const institutionFilter = document.getElementById('institutionFilter');
      const institutions = [...new Set(clients.map(client => client.institution))];
      institutions.forEach(institution => {
        const option = document.createElement('option');
        option.value = institution;
        option.textContent = institution;
        institutionFilter.appendChild(option);
      });
    }

    function filterClients() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      const institutionFilter = document.getElementById('institutionFilter').value;

      filteredClients = clients.filter(client => {
        const matchesSearch = Object.values(client).some(value => 
          value.toString().toLowerCase().includes(searchTerm)
        );
        const matchesInstitution = institutionFilter === '' || client.institution === institutionFilter;
        return matchesSearch && matchesInstitution;
      });

      currentPage = 1;
      renderClients();
    }

    function viewClient(id) {
      // Implement view client functionality
      console.log(`View client with ID: ${id}`);
    }

    function editClient(id) {
      // Implement edit client functionality
      console.log(`Edit client with ID: ${id}`);
    }

    function deleteClient(id) {
      // Implement delete client functionality
      console.log(`Delete client with ID: ${id}`);
    }

    // Event listeners
    document.getElementById('searchButton').addEventListener('click', filterClients);
    document.getElementById('searchInput').addEventListener('keyup', filterClients);
    document.getElementById('institutionFilter').addEventListener('change', filterClients);

    // Initialize the page
    populateInstitutionFilter();
    renderClients();

    // In a real-world scenario, you would fetch data from an API
    // Example using axios:
    /*
    axios.get('https://api.example.com/clients')
      .then(response => {
        clients = response.data;
        filteredClients = [...clients];
        populateInstitutionFilter();
        renderClients();
      })
      .catch(error => {
        console.error('Error fetching client data:', error);
      });
    */
  </script>