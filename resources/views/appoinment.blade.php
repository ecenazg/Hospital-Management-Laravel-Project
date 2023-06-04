<!DOCTYPE html>
<html>
<head>
    <title>Create Appointment</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            max-width: 500px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        select,
        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Create Appointment</h1>

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf

        <div>
            <label for="department">Department</label>
            <select name="department" id="department">
                <option value="">Please select a department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="doctor">Doctor</label>
            <select name="doctor" id="doctor">
                <option value="">Please select a department first</option>
            </select>
        </div>

        <div>
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="">
        </div>

        <div>
            <label for="time">Time</label>
            <select name="time" id="time">
                <option value="">Please select a time</option>
            </select>
        </div>

        <div>
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <div>
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes" cols="30" rows="5"></textarea>
        </div>

        <button type="submit">Create</button>
    </form>

    <script>
    // Inline JavaScript for dynamic doctor selection based on department
    const departmentSelect = document.getElementById('department');
    const doctorSelect = document.getElementById('doctor');
    const timeSelect = document.getElementById('time');

    departmentSelect.addEventListener('change', function() {
        const departmentId = this.value;
        if (departmentId !== '') {
            // Make an AJAX request to fetch doctors based on the selected department
            fetch(`/doctors?department_id=${departmentId}`)
                .then(response => response.json())
                .then(data => {
                    // Clear existing options
                    doctorSelect.innerHTML = '<option value="">Please select a doctor</option>';
                    // Add new options based on the fetched data
                    data.forEach(doctor => {
                        const option = document.createElement('option');
                        option.value = doctor.id;
                        option.textContent = doctor.first_name + ' ' + doctor.last_name;
                        doctorSelect.appendChild(option);
                    });
                })
                .catch(error => console.log(error));
        } else {
            doctorSelect.innerHTML = '<option value="">Please select a department first</option>';
        }
    });

    // Set the initial doctor selection if editing an appointment
    const initialDoctorId = {!! isset($appointment) && isset($appointment->doctor_id) ? $appointment->doctor_id : 'null' !!};
    if (initialDoctorId) {
        doctorSelect.value = initialDoctorId;
    }

    // Fetch available timeslots based on the selected doctor
    doctorSelect.addEventListener('change', function() {
        const doctorId = this.value;
        if (doctorId !== '') {
            // Make an AJAX request to fetch available timeslots for the selected doctor
            fetch(`/timeslots?doctor_id=${doctorId}`)
                .then(response => response.json())
                .then(data => {
                    // Clear existing options
                    timeSelect.innerHTML = '<option value="">Please select a time</option>';
                    // Add new options based on the fetched data
                    data.forEach(timeslot => {
                        const option = document.createElement('option');
                        option.value = timeslot.id;
                        option.textContent = timeslot.start_time + ' - ' + timeslot.end_time;
                        timeSelect.appendChild(option);
                    });
                })
                .catch(error => console.log(error));
        } else {
            timeSelect.innerHTML = '<option value="">Please select a doctor first</option>';
        }
    });

    // Set the initial timeslot selection if editing an appointment
    const initialTimeslotId = {!! isset($appointment) && isset($appointment->time) ? $appointment->time : 'null' !!};
    if (initialTimeslotId) {
        timeSelect.value = initialTimeslotId;
    }
</script>

</body>
</html>
