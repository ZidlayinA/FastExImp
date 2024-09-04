<?php $this->load->view('app/carbon_header'); ?>

<div class="container-md">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" id="subtitulo">Clientes</h1>
  </div>

    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Información Personal</h5>
            <ul class="list-group list-group-flush" id="personal-info">
              <!-- Personal info will be populated here -->
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Contratos</h5>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID Contrato</th>
                    <th>Tipo</th>
                    <th>Fecha Inicio</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody id="contracts-body">
                  <!-- Contracts will be populated here -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title">Solicitudes</h5>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID Solicitud</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody id="requests-body">
                  <!-- Requests will be populated here -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Simulated customer data (replace with actual API calls)
    const customerData = {
      name: "Juan Pérez",
      email: "juan.perez@email.com",
      phone: "+1 234 567 8900",
      address: "Calle Principal 123, Ciudad"
    };

    const contracts = [
      { id: "C001", type: "Servicio Básico", startDate: "2023-01-01", status: "Activo" },
      { id: "C002", type: "Servicio Premium", startDate: "2023-03-15", status: "Pendiente" }
    ];

    const requests = [
      { id: "R001", type: "Cambio de Plan", date: "2023-05-10", status: "En Proceso" },
      { id: "R002", type: "Soporte Técnico", date: "2023-05-15", status: "Resuelto" }
    ];

    // Populate personal information
    const personalInfoList = document.getElementById('personal-info');
    for (const [key, value] of Object.entries(customerData)) {
      const li = document.createElement('li');
      li.className = 'list-group-item';
      li.innerHTML = `<strong>${key.charAt(0).toUpperCase() + key.slice(1)}:</strong> ${value}`;
      personalInfoList.appendChild(li);
    }

    // Populate contracts table
    const contractsBody = document.getElementById('contracts-body');
    contracts.forEach(contract => {
      const row = contractsBody.insertRow();
      row.innerHTML = `
        <td>${contract.id}</td>
        <td>${contract.type}</td>
        <td>${contract.startDate}</td>
        <td><span class="badge bg-${contract.status === 'Activo' ? 'success' : 'warning'} rounded-pill">${contract.status}</span></td>
      `;
    });

    // Populate requests table
    const requestsBody = document.getElementById('requests-body');
    requests.forEach(request => {
      const row = requestsBody.insertRow();
      row.innerHTML = `
        <td>${request.id}</td>
        <td>${request.type}</td>
        <td>${request.date}</td>
        <td><span class="badge bg-${request.status === 'Resuelto' ? 'success' : 'primary'} rounded-pill">${request.status}</span></td>
      `;
    });

    // In a real-world scenario, you would fetch data from an API
    // Example using fetch:
    /*
    fetch('https://api.example.com/customer-data')
      .then(response => response.json())
      .then(data => {
        // Populate the tables and fields with the fetched data
        populatePersonalInfo(data.personalInfo);
        populateContracts(data.contracts);
        populateRequests(data.requests);
      })
      .catch(error => {
        console.error('Error fetching customer data:', error);
      });

    function populatePersonalInfo(info) {
      // Implementation
    }

    function populateContracts(contractsData) {
      // Implementation
    }

    function populateRequests(requestsData) {
      // Implementation
    }
    */
</script>

<?php $this->load->view('app/carbon_footer'); ?>