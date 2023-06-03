<!DOCTYPE html>
<html>
<head>
    <title>Patients</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Patients</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td>{{ $patient['id'] }}</td>
                    <td>{{ $patient['name'] }}</td>
                    <td>{{ $patient['email'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
