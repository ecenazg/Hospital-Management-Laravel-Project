<!DOCTYPE html>
<html>
<head>
    <title>Nurse Management</title>
</head>
<body>
    <h1>Nurse Management</h1>

    <!-- Display nurses -->
    @if(count($nurses) > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nurses as $nurse)
                    <tr>
                        <td>{{ $nurse->id }}</td>
                        <td>{{ $nurse->name }}</td>
                        <td>{{ $nurse->email }}</td>
                        <td>{{ $nurse->department }}</td>
                        <td>
                            <form action="{{ route('nurses.destroy', $nurse->id) }}" method="POST">
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
        <p>No nurses found.</p>
    @endif

    <!-- Create nurse form -->
    <h2>Create Nurse</h2>
    <form action="{{ route('nurses.create') }}" method="POST">
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
