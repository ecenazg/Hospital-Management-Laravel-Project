<!DOCTYPE html>
<html>

<head>
    <title>Doctor Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #cbbcf6;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #512b58;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #35013f;
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
            <tr id="doctor-row-{{ $doctor->id }}">
                <td>{{ $doctor->id }}</td>
                <td>
                    <span>{{ $doctor->name }}</span>
                    <input type="text" class="edit-field" value="{{ $doctor->name }}" style="display: none;">
                </td>
                <td>
                    <span>{{ $doctor->email }}</span>
                    <input type="text" class="edit-field" value="{{ $doctor->email }}" style="display: none;">
                </td>
                <td>
                    <span>{{ $doctor->specialization }}</span>
                    <input type="text" class="edit-field" value="{{ $doctor->specialization }}" style="display: none;">
                </td>
                <td>
                    <button class="edit-button">Edit</button>
                    <button class="save-button" style="display: none;">Save</button>
                    <form class="delete-form" action="{{ route('doctors.destroy', $doctor->id) }}" method="POST">
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

            const handleSave = (doctorId, index) => {
                const formData = new FormData();
                const name = editFields[index * 3].value;
                const email = editFields[index * 3 + 1].value;
                const specialization = editFields[index * 3 + 2].value;

                formData.append('name', name);
                formData.append('email', email);
                formData.append('specialization', specialization);

                fetch(`/doctors/${doctorId}`, {
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
                    const doctorId = button.parentElement.parentElement.querySelector('td:first-child').textContent;
                    handleSave(doctorId, index);
                });
            });

            editFields.forEach(field => {
                field.addEventListener('input', handleInputChange);
            });
        });
    </script>

</body>

</html>