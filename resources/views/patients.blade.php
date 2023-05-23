<!DOCTYPE html>
<html>
<head>
    <title>Patient Management</title>
</head>
<body>
    <h1>Patient Management</h1>

    <!-- Display patients -->
    @if(count($patients) > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Illness</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $patient->illness }}</td>
                        <td>
                        
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No patients found.</p>
    @endif

    <!-- Create patient form -->
    <h2>Create Patient</h2>
    <form action="{{ route('patients.create') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="illness">Illness:</label>
        <input type="text" name="illness" required><br>

        <button type="submit">Create</button>
    </form>
</body>
</html>
