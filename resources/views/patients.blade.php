<!DOCTYPE html>
<html>
<head>
    <title>Patient Management</title>
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
            <tr id="patient-row-{{ $patient->id }}">
                <td>{{ $patient->id }}</td>
                <td>
                    <span>{{ $patient->name }}</span>
                    <input type="text" class="edit-field" value="{{ $patient->name }}" style="display: none;">
                </td>
                <td>
                    <span>{{ $patient->email }}</span>
                    <input type="text" class="edit-field" value="{{ $patient->email }}" style="display: none;">
                </td>
                <td>
                    <span>{{ $patient->illness }}</span>
                    <input type="text" class="edit-field" value="{{ $patient->illness }}" style="display: none;">
                </td>
                <td>
                    <button class="edit-button">Edit</button>
                    <button class="save-button" style="display: none;">Save</button>
                    <form class="delete-form" action="{{ route('patients.destroy', $patient->id) }}" method="POST">
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editButtons = document.querySelectorAll('.edit-button');
            const saveButtons = document.querySelectorAll('.save-button');
            const editFields = document.querySelectorAll('.edit-field');
            const spans = document.querySelectorAll('td span');

            const handleEdit = (index) => {
                spans[index].style.display = 'none';
                editFields[index * 3].style.display = 'inline-block';
                editFields[index * 3 + 1].style.display = 'inline-block';
                editFields[index * 3 + 2].style.display = 'inline-block';
                editButtons[index].style.display = 'none';
                saveButtons[index].style.display = 'inline-block';
            };

            const handleSave = (patientId, index) => {
                const formData = new FormData();
                const name = editFields[index * 3].value;
                const email = editFields[index * 3 + 1].value;
                const illness = editFields[index * 3 + 2].value;

                formData.append('name', name);
                formData.append('email', email);
                formData.append('illness', illness);

                fetch(`/patients/${patientId}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            location.reload(); // Refresh 
                            throw new Error('Failed to save changes.');
                        }
                    })
                    .catch(error => {
                        console.error('An error occurred while saving changes:', error);
                    });
            };

            const handleInputChange = (event) => {
                // Input değişikliklerini takip etmek için 
            };

            editButtons.forEach((button, index) => {
                button.addEventListener('click', () => handleEdit(index));
            });

            saveButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    const patientId = button.parentElement.parentElement.querySelector('td:first-child').textContent;
                    handleSave(patientId, index);
                });
            });

            editFields.forEach(field => {
                field.addEventListener('input', handleInputChange);
            });
        });
    </script>
</body>
</html>
