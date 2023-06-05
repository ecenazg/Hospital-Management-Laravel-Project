<!DOCTYPE html>
<html>

<head>
    <title>Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select,
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }

        button:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }
    </style>

</head>

<body>
    <div class="container">
        <h1>Appointment</h1>
        <form id="appointmentForm" method="POST" action="{{ route('appointments.store') }}">
            @csrf

            <div class="form-group">
                <label for="department">Department</label>
                <select id="department" name="department" required>
                    <option value="">Please select a department</option>
                    @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="doctor">Doctor</label>
                <select id="doctor" name="doctor" required disabled>
                    <option value="">Please select a department first</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required disabled>
            </div>

            <div class="form-group">
                <label for="time">Time</label>
                <select id="time" name="time" required disabled>
                    <option value="">Please select a date first</option>
                </select>
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea id="notes" name="notes"></textarea>
            </div>

            <button type="submit" id="submitButton" disabled>Create Appointment</button>
        </form>
    </div>

    <script>
        const departmentSelect = document.getElementById('department');
        const doctorSelect = document.getElementById('doctor');
        const dateInput = document.getElementById('date');
        const timeSelect = document.getElementById('time');
        const submitButton = document.getElementById('submitButton');

        departmentSelect.addEventListener('change', function() {
            const departmentId = this.value;

            if (departmentId) {
                doctorSelect.innerHTML = '<option value="">Loading doctors...</option>';

                fetch(`/departments/${departmentId}/doctors`)
                    .then(response => response.json())
                    .then(data => {
                        let options = '<option value="">Please select a doctor</option>';
                        data.forEach(doctor => {
                            options += `<option value="${doctor.id}">${doctor.first_name} ${doctor.last_name}</option>`;
                        });
                        doctorSelect.innerHTML = options;
                        doctorSelect.disabled = false;
                    });
            } else {
                doctorSelect.innerHTML = '<option value="">Please select a department first</option>';
                doctorSelect.disabled = true;
                dateInput.disabled = true;
                timeSelect.disabled = true;
                submitButton.disabled = true;
            }
        });

        doctorSelect.addEventListener('change', function() {
            const doctorId = this.value;

            if (doctorId) {
                dateInput.disabled = false;
            } else {
                dateInput.value = '';
                dateInput.disabled = true;
                timeSelect.innerHTML = '<option value="">Please select a date first</option>';
                timeSelect.disabled = true;
                submitButton.disabled = true;
            }
        });

        dateInput.addEventListener('change', function() {
            const date = this.value;
            const doctorId = doctorSelect.value;

            if (date && doctorId) {
                timeSelect.innerHTML = '<option value="">Loading time slots...</option>';
                fetch(`/appointments/time-slots?doctor_id=${doctorId}&date=${date}`)
                    .then(response => response.json())
                    .then(data => {
                        let options = '<option value="">Please select a time slot</option>';
                        data.forEach(timeSlot => {
                            options += `<option value="${timeSlot}">${timeSlot}</option>`;
                        });
                        timeSelect.innerHTML = options;
                        timeSelect.disabled = false;
                        submitButton.disabled = false;
                    });
            } else {
                timeSelect.innerHTML = '<option value="">Please select a date first</option>';
                timeSelect.disabled = true;
                submitButton.disabled = true;
            }
        });
    </script>
</body>

</html>