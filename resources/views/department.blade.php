<!DOCTYPE html>
<html>
<head>
    <title>Departments</title>
    <style>
        .department-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin: 5px;
        }
        table {
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Departments</h1>

    @foreach ($departments as $department)
        <button class="department-button" onclick="showDoctors('{{ $department->department_name }}')">{{ $department->department_name }}</button>
    @endforeach

    <div id="doctors-container"></div>

    <script>
        function showDoctors(departmentName) {
            // Send an AJAX request to fetch the doctors of the department
            fetch(`/department/${departmentName}/doctors`)
                .then(response => response.json())
                .then(data => {
                    let tableHtml = '<table>';
                    tableHtml += '<tr><th>Name</th><th>Email</th></tr>';
                    data.doctors.forEach(doctor => {
                        tableHtml += '<tr>';
                        tableHtml += '<td>' + doctor.name + '</td>';
                        tableHtml += '<td>' + doctor.email + '</td>';
                        tableHtml += '</tr>';
                    });
                    tableHtml += '</table>';
                    document.getElementById('doctors-container').innerHTML = tableHtml;
                });
        }
    </script>
</body>
</html>
