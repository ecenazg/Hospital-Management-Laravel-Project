<!DOCTYPE html>
<html>
<head>
    <title>Doctor Management</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <h1>Doctor Management</h1>

    <!-- Display doctors -->
    @if(count($doctors) > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Specialization</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->id }}</td>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->email }}</td>
                        <td>{{ $doctor->specialization }}</td>
                        <td>
                        
                            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST">
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
        <p>No doctors found.</p>
    @endif

    <!-- Create doctor form -->
    <h2>Create Doctor</h2>
    <form action="{{ route('doctors.create') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="specialization">Specialization:</label>
        <input type="text" name="specialization" required><br>

        <button type="submit">Create</button>
    </form>
</body>
</html>
