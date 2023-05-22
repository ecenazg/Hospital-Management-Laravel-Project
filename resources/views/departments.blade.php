<!DOCTYPE html>
<html>
<head>
    <title>Department Management</title>
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

        .form-group input[type="text"] {
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

        .departments-list {
            margin-top: 20px;
        }

        .departments-list table {
            border-collapse: collapse;
            width: 100%;
        }

        .departments-list table th,
        .departments-list table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .departments-list table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Department Management</h1>

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name">
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <input type="text" id="description">
    </div>

    <div class="form-group">
        <button onclick="createDepartment()">Create</button>
    </div>

    <div class="departments-list">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="departmentsTableBody">
            </tbody>
        </table>
    </div>

    <script>
        function createDepartment() {
            var nameInput = document.getElementById('name');
            var descriptionInput = document.getElementById('description');

            var name = nameInput.value;
            var description = descriptionInput.value;

            if (name && description) {
                var department = {
                    name: name,
                    description: description
                };

                // Send an AJAX request to the server to create a new department
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/departments', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 201) {
                        var createdDepartment = JSON.parse(xhr.responseText);
                        addDepartmentToTable(createdDepartment);
                    }
                };
                xhr.send(JSON.stringify(department));

                // Clear the input fields
                nameInput.value = '';
                descriptionInput.value = '';
            }
        }

        function addDepartmentToTable(department) {
            var tableBody = document.getElementById('departmentsTableBody');

            var row = document.createElement('tr');
            var nameCell = document.createElement('td');
            var descriptionCell = document.createElement('td');
            var actionCell = document.createElement('td');

            nameCell.textContent = department.name;
            descriptionCell.textContent = department.description;
            actionCell.innerHTML = '<button onclick="deleteDepartment(' + department.id + ')">Delete</button>';

            row.appendChild(nameCell);
            row.appendChild(descriptionCell);
            row.appendChild(actionCell);

            tableBody.appendChild(row);
        }

        function deleteDepartment(departmentId) {
            if (confirm('Are you sure you want to delete this department?')) {
                // Send an AJAX request to the server to delete the department
                var xhr = new XMLHttpRequest();
                xhr.open('DELETE', '/departments/' + departmentId, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 204) {
                        removeDepartmentFromTable(departmentId);
                    }
                };
                xhr.send();
            }
        }

        function removeDepartmentFromTable(departmentId) {
            var row = document.getElementById('departmentRow_' + departmentId);
            if (row) {
                row.remove();
            }
        }
    </script>
</body>
</html>
