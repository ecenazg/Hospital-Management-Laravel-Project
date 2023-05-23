<!DOCTYPE html>
<html>
<head>
    <title>Doctor Management</title>
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
                        <td contenteditable="true" class="edit-field">{{ $doctor->name }}</td>
                    <td contenteditable="true" class="edit-field">{{ $doctor->email }}</td>
                    <td contenteditable="true" class="edit-field">{{ $doctor->specialization }}</td>
                    <td>
                        <button class="edit-button" data-doctor-id="{{ $doctor->id }}">Edit</button>
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
    @verbatim
    <script>
       

// Get all edit buttons and attach click event listeners
const editButtons = document.querySelectorAll('.edit-button');
editButtons.forEach(button => {
    button.addEventListener('click', handleEdit);
});

// Handle the edit button click event
function handleEdit(event) {
    const doctorId = event.target.dataset.doctorId;
    const editFields = document.querySelectorAll(`tr[data-doctor-id="${doctorId}"] .edit-field`);

    // Enable editing on the fields
    editFields.forEach(field => {
        field.contentEditable = true;
        field.classList.add('editing');
    });

    // Change the button text to 'Save'
    event.target.textContent = 'Save';
    event.target.removeEventListener('click', handleEdit);
    event.target.addEventListener('click', handleSave);
}

// Handle the save button click event
function handleSave(event) {
    const doctorId = event.target.dataset.doctorId;
    const editFields = document.querySelectorAll(`tr[data-doctor-id="${doctorId}"] .edit-field`);

    // Disable editing on the fields
    editFields.forEach(field => {
        field.contentEditable = false;
        field.classList.remove('editing');
    });

    // Change the button text back to 'Edit'
    event.target.textContent = 'Edit';
    event.target.removeEventListener('click', handleSave);
    event.target.addEventListener('click', handleEdit);

    // Save the changes
    const formData = new FormData();
    editFields.forEach(field => {
        const columnName = field.getAttribute('data-column-name');
        const columnValue = field.textContent;
        formData.append(columnName, columnValue);
    });

    fetch(`/doctors/${doctorId}`, {
        method: 'PUT', 
        body: formData
    })
    .then(response => {
        if (response.ok) {
            console.log('Changes saved successfully.');
        } else {
            console.error('Failed to save changes.');
        }
    })
    .catch(error => {
        console.error('An error occurred while saving changes:', error);
    });
}

// Prevent form submission on delete confirmation
const deleteForms = document.querySelectorAll('.delete-form');
deleteForms.forEach(form => {
    form.addEventListener('submit', event => {
        const confirmation = confirm('Are you sure you want to delete this doctor?');
        if (!confirmation) {
            event.preventDefault();
        }
    });
});

    </script>
</body>
</html>
