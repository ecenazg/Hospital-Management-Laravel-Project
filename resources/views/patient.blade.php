<!DOCTYPE html>
<html>
<head>
    <title>Patient Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: inline-block;
            width: 100px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 200px;
            padding: 5px;
        }

        .form-group button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .patients-list {
            margin-top: 20px;
        }

        .patients-list table {
            border-collapse: collapse;
            width: 100%;
        }

        .patients-list table th,
        .patients-list table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .patients-list table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Patient Management</h1>

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name">
    </div>

    <div class="form-group">
        <label for="illness">Illness:</label>
        <input type="text" id="illness">
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email">
    </div>

    <div class="form-group">
        <button onclick="createPatient()">Create</button>
    </div>

    <div class="patients-list">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Illness</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="patientsTableBody">
            </tbody>
        </table>
    </div>

    <script>
        function createPatient() {
            var nameInput = document.getElementById('name');
            var illnessInput = document.getElementById('illness');
            var emailInput = document.getElementById('email');

            var name = nameInput.value;
            var illness = illnessInput.value;
            var email = emailInput.value;

            if (name && illness && email) {
                var patient = {
                    name: name,
                    illness: illness,
                    email: email
                };

                // Send an AJAX request to the server to create a new patient
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/patients', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 201) {
                        var createdPatient = JSON.parse(xhr.responseText);
                        addPatientToTable(createdPatient);
                    }
                };
                xhr.send(JSON.stringify(patient));

                // Clear the input fields
                nameInput.value = '';
                illnessInput.value = '';
                emailInput.value = '';
            }
        }

        function addPatientToTable(patient) {
            var tableBody = document.getElementById('patientsTableBody');

            var row = document.createElement('tr');
            var nameCell = document.createElement('td');
            var illnessCell = document.createElement('td');
            var emailCell = document.createElement('td');
            var actionCell = document.createElement('td');

            nameCell.textContent = patient.name;
            illnessCell.textContent = patient.illness;
            emailCell.textContent = patient.email;
            actionCell.innerHTML = '<button onclick="deletePatient(' + patient.id + ')">Delete</button>';

            row.appendChild(nameCell);
            row.appendChild(illnessCell);
            row.appendChild(emailCell);
            row.appendChild(actionCell);

            tableBody.appendChild(row);
        }

        function deletePatient(id) {
            // Send an AJAX request to the server to delete the patient
            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', '/patients/' + id, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 204) {
                    var row = document.getElementById('patientRow_' + id);
                    row.parentNode.removeChild(row);
                }
            };
            xhr.send();
        }

        // Initial load of patients
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/patients', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var patients = JSON.parse(xhr.responseText);
                patients.forEach(function(patient) {
                    addPatientToTable(patient);
                });
            }
        };
        xhr.send();
    </script>
</body>
</html>
