<!DOCTYPE html>
<html>
<head>
    <title>Doctor Management</title>
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

        .doctors-list {
            margin-top: 20px;
        }

        .doctors-list table {
            border-collapse: collapse;
            width: 100%;
        }

        .doctors-list table th,
        .doctors-list table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .doctors-list table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Doctor Management</h1>

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name">
    </div>

    <div class="form-group">
        <label for="specialization">Specialization:</label>
        <input type="text" id="specialization">
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email">
    </div>

    <div class="form-group">
        <button onclick="createDoctor()">Create</button>
    </div>

    <div class="doctors-list">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="doctorsTableBody">
            </tbody>
        </table>
    </div>

    <script>
        function createDoctor() {
            var nameInput = document.getElementById('name');
            var specializationInput = document.getElementById('specialization');
            var emailInput = document.getElementById('email');

            var name = nameInput.value;
            var specialization = specializationInput.value;
            var email = emailInput.value;

            if (name && specialization && email) {
                var doctor = {
                    name: name,
                    specialization: specialization,
                    email: email
                };

                // Send an AJAX request to the server to create a new doctor
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/doctors', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 201) {
                        var createdDoctor = JSON.parse(xhr.responseText);
                        addDoctorToTable(createdDoctor);
                    }
                };
                xhr.send(JSON.stringify(doctor));

                // Clear the input fields
                nameInput.value = '';
                specializationInput.value = '';
                emailInput.value = '';
            }
        }

        function addDoctorToTable(doctor) {
            var tableBody = document.getElementById('doctorsTableBody');

            var row = document.createElement('tr');
            var nameCell = document.createElement('td');
            var specializationCell = document.createElement('td');
            var emailCell = document.createElement('td');
            var actionCell = document.createElement('td');

            nameCell.textContent = doctor.name;
            specializationCell.textContent = doctor.specialization;
            emailCell.textContent = doctor.email;
            actionCell.innerHTML = '<button onclick="deleteDoctor(' + doctor.id + ')">Delete</button>';

            row.appendChild(nameCell);
            row.appendChild(specializationCell);
            row.appendChild(emailCell);
            row.appendChild(actionCell);

            tableBody.appendChild(row);
        }

        function deleteDoctor(id) {
            // Send an AJAX request to the server to delete the doctor
            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', '/doctors/' + id, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 204) {
                    var row = document.getElementById('doctorRow_' + id);
                    row.parentNode.removeChild(row);
                }
            };
            xhr.send();
        }

        // Initial load of doctors
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/doctors', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var doctors = JSON.parse(xhr.responseText);
                doctors.forEach(function(doctor) {
                    addDoctorToTable(doctor);
                });
            }
        };
        xhr.send();
    </script>
</body>
</html>
