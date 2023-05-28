<!DOCTYPE html>
<html>
<head>
    <title>Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        table p {
            margin: 0;
            padding: 10px;
        }
        
        form {
            margin-top: 20px;
        }
        
        label {
            display: inline-block;
            width: 100px;
            margin-right: 10px;
        }
        
        input[type="text"],
        input[type="email"] {
            width: 200px;
            padding: 5px;
            margin-bottom: 10px;
        }
        
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        
        .error-message {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h1>Management</h1>

    <h2>Create Patient</h2>
    <form action="{{ route('management.createPatient') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="illness">Illness:</label>
        <input type="text" name="illness" required><br>

        <button type="submit">Create</button>
    </form>

    <h2>Create Doctor</h2>
    <form action="{{ route('management.createDoctor') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="specialization">Specialization:</label>
        <input type="text" name="specialization" required><br>

        <button type="submit">Create</button>
    </form>

    <h2>Create Nurse</h2>
    <form action="{{ route('management.createNurse') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="department">Department:</label>
        <input type="text" name="department" required><br>

        <button type="submit">Create</button>
    </form>
</body>
</html>
