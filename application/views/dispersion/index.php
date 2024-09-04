<?php $this->load->view('app/carbon_header'); ?>


<div class="container-fluid mt-5">
    <h2 class="text-center mb-4">Dispersión y Listado de Contratos</h2>
    
    <div class="card mb-4">
      <div class="card-body">
        <div class="row filter-section">
          <div class="col-md-3 mb-3">
            <select class="form-select" id="institutionFilter">
              <option value="">Todas las instituciones</option>
              <!-- Institutions will be dynamically added here -->
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <select class="form-select" id="typeFilter">
              <option value="">Todos los tipos de contrato</option>
              <!-- Contract types will be dynamically added here -->
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <select class="form-select" id="yearFilter">
              <option value="">Todos los años</option>
              <!-- Years will be dynamically added here -->
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <button class="btn btn-primary w-100" id="applyFilters">Aplicar Filtros</button>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Listado de Contratos</h5>
        <div class="table-container">
          <table id="contractsTable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th data-sort="id">ID <span class="sort-icon"></span></th>
                <th data-sort="client">Cliente <span class="sort-icon"></span></th>
                <th data-sort="type">Tipo <span class="sort-icon"></span></th>
                <th data-sort="startDate">Fecha de Inicio <span class="sort-icon"></span></th>
                <th data-sort="endDate">Fecha de Fin <span class="sort-icon"></span></th>
                <th data-sort="amount">Monto <span class="sort-icon"></span></th>
                <th data-sort="institution">Institución <span class="sort-icon"></span></th>
              </tr>
            </thead>
            <tbody>
              <!-- Contract data will be dynamically added here -->
            </tbody>
          </table>
        </div>
        <nav aria-label="Table pagination">
          <ul class="pagination" id="tablePagination"></ul>
        </nav>
      </div>
    </div>
  </div>

  

<?php $this->load->view('app/carbon_footer'); ?>

<script>
    const contracts = [
      { id: 1, client: "Juan Pérez", type: "Préstamo", startDate: "2023-01-01", endDate: "2024-01-01", amount: 10000, institution: "Banco XYZ" },
      { id: 2, client: "María López", type: "Hipoteca", startDate: "2023-02-15", endDate: "2033-02-15", amount: 200000, institution: "Banco XYZ" },
      { id: 3, client: "Carlos Rodríguez", type: "Seguro", startDate: "2023-03-10", endDate: "2024-03-10", amount: 5000, institution: "Cooperativa ABC" },
      { id: 4, client: "Ana Martínez", type: "Inversión", startDate: "2023-04-01", endDate: "2025-04-01", amount: 50000, institution: "Cooperativa ABC" },
      { id: 5, client: "Pedro Sánchez", type: "Préstamo", startDate: "2023-05-20", endDate: "2024-05-20", amount: 15000, institution: "Financiera 123" },
      { id: 6, client: "Laura Gómez", type: "Seguro", startDate: "2023-06-05", endDate: "2024-06-05", amount: 3000, institution: "Financiera 123" },
    ];

    let filteredContracts = [...contracts];
    let currentPage = 1;
    const itemsPerPage = 10;
    let sortColumn = 'id';
    let sortDirection = 'asc';

    function initializeChart() {
      const canvas = document.getElementById('contractScatterChart');
      const ctx = canvas.getContext('2d');
      
      canvas.width = canvas.offsetWidth;
      canvas.height = canvas.offsetHeight;

      ctx.beginPath();
      ctx.moveTo(50, 350);
      ctx.lineTo(750, 350);
      ctx.moveTo(50, 350);
      ctx.lineTo(50, 50);
      ctx.stroke();

      ctx.font = '12px Arial';
      ctx.fillText('Fecha de Inicio', 350, 380);
      ctx.save();
      ctx.rotate(-Math.PI/2);
      ctx.fillText('Monto del Contrato', -200, 30);
      ctx.restore();
    }

    function updateChart() {
      const canvas = document.getElementById('contractScatterChart');
      const ctx = canvas.getContext('2d');

      ctx.clearRect(0, 0, canvas.width, canvas.height);
      initializeChart();

      const minDate = new Date(Math.min(...filteredContracts.map(c => new Date(c.startDate))));
      const maxDate = new Date(Math.max(...filteredContracts.map(c => new Date(c.startDate))));
      const maxAmount = Math.max(...filteredContracts.map(c => c.amount));

      filteredContracts.forEach(contract => {
        const x = 50 + (new Date(contract.startDate) - minDate) / (maxDate - minDate) * 700;
        const y = 350 - (contract.amount / maxAmount * 300);

        ctx.beginPath();
        ctx.arc(x, y, 5, 0, 2 * Math.PI);
        ctx.fillStyle = 'rgba(13, 110, 253, 0.6)';
        ctx.fill();
        ctx.strokeStyle = 'rgba(13, 110, 253, 1)';
        ctx.stroke();
      });
    }

    function updateStatistics() {
      const totalContracts = filteredContracts.length;
      document.getElementById('totalContracts').textContent = totalContracts;

      const durations = filteredContracts.map(contract => 
        (new Date(contract.endDate) - new Date(contract.startDate)) / (1000 * 60 * 60 * 24)
      );

      const avgDuration = durations.reduce((a, b) => a + b, 0) / totalContracts;
      document.getElementById('avgDuration').textContent = avgDuration.toFixed(0);

      const longestContract = Math.max(...durations);
      document.getElementById('longestContract').textContent = longestContract.toFixed(0);

      const shortestContract = Math.min(...durations);
      document.getElementById('shortestContract').textContent = shortestContract.toFixed(0);
    }

    function populateFilters() {
      const institutionFilter = document.getElementById('institutionFilter');
      const typeFilter = document.getElementById('typeFilter');
      const yearFilter = document.getElementById('yearFilter');

      const institutions = [...new Set(contracts.map(contract => contract.institution))];
      const types = [...new Set(contracts.map(contract => contract.type))];
      const years = [...new Set(contracts.map(contract => new Date(contract.startDate).getFullYear()))];

      institutions.forEach(institution => {
        const option = document.createElement('option');
        option.value = institution;
        option.textContent = institution;
        institutionFilter.appendChild(option);
      });

      types.forEach(type => {
        const option = document.createElement('option');
        option.value = type;
        option.textContent = type;
        typeFilter.appendChild(option);
      });

      years.forEach(year => {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        yearFilter.appendChild(option);
      });
    }

    function applyFilters() {
      const institutionFilter = document.getElementById('institutionFilter').value;
      const typeFilter = document.getElementById('typeFilter').value;
      const yearFilter = document.getElementById('yearFilter').value;

      filteredContracts = contracts.filter(contract => {
        const matchesInstitution = institutionFilter === '' || contract.institution === institutionFilter;
        const matchesType = typeFilter === '' || contract.type === typeFilter;
        const matchesYear = yearFilter === '' || new Date(contract.startDate).getFullYear().toString() === yearFilter;
        return matchesInstitution && matchesType && matchesYear;
      });

      currentPage = 1; 
      updateChart();
      updateStatistics();
      updateTable();
    }

    function updateTable() {
      const tableBody = document.querySelector('#contractsTable tbody');
      tableBody.innerHTML = '';

      const startIndex = (currentPage - 1) * itemsPerPage;
      const endIndex = startIndex + itemsPerPage;
      const sortedContracts = sortContracts(filteredContracts);
      const pageContracts = sortedContracts.slice(startIndex, endIndex);

      pageContracts.forEach(contract => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${contract.id}</td>
          <td>${contract.client}</td>
          <td>${contract.type}</td>
          <td>${contract.startDate}</td>
          <td>${contract.endDate}</td>
          <td>${formatCurrency(contract.amount)}</td>
          <td>${contract.institution}</td>
        `;
        tableBody.appendChild(row);
      });

      updatePagination(sortedContracts.length);
    }

    function updatePagination(totalItems) {
      const pagination = document.getElementById('tablePagination');
      pagination.innerHTML = '';

      const totalPages = Math.ceil(totalItems / itemsPerPage);

      for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement('li');
        li.classList.add('page-item');
        if (i === currentPage) {
          li.classList.add('active');
        }
        li.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
        pagination.appendChild(li);
      }

      pagination.addEventListener('click', (e) => {
        e.preventDefault();
        if (e.target.tagName === 'A') {
          currentPage = parseInt(e.target.dataset.page);
          updateTable();
        }
      });
    }

    function sortContracts(contracts) {
      return contracts.sort((a, b) => {
        let aValue = a[sortColumn];
        let bValue = b[sortColumn];

        if (sortColumn === 'startDate' || sortColumn === 'endDate') {
          aValue = new Date(aValue);
          bValue = new Date(bValue);
        } else if (sortColumn === 'amount') {
          aValue = parseFloat(aValue);
          bValue = parseFloat(bValue);
        }

        if (aValue < bValue) return sortDirection === 'asc' ? -1 : 1;
        if (aValue > bValue) return sortDirection === 'asc' ? 1 : -1;
        return 0;
      });
    }

    function formatCurrency(amount) {
      return new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' }).format(amount);
    }

    document.querySelectorAll('#contractsTable th[data-sort]').forEach(th => {
      th.addEventListener('click', () => {
        const column = th.dataset.sort;
        if (column === sortColumn) {
          sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
          sortColumn = column;
          sortDirection = 'asc';
        }

        document.querySelectorAll('#contractsTable th .sort-icon').forEach(icon => {
          icon.className = 'sort-icon';
        });

        th.querySelector('.sort-icon').classList.add(sortDirection);
        updateTable();
      });
    });

    // Initialize the page
    initializeChart();
    populateFilters();
    updateChart();
    updateStatistics();
    updateTable();
  </script>