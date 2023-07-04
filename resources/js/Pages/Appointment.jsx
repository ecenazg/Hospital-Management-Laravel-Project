import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Appointment = () => {
  const [patients, setPatients] = useState([]);
  const [doctors, setDoctors] = useState([]);
  const [departments, setDepartments] = useState([]);
  const [timeSchedules, setTimeSchedules] = useState([]);
  const [selectedDepartment, setSelectedDepartment] = useState('');
  const [selectedDoctor, setSelectedDoctor] = useState('');
  const [selectedDate, setSelectedDate] = useState('');
  const [selectedTimeSlot, setSelectedTimeSlot] = useState('');
  const [status, setStatus] = useState('');
  const [notes, setNotes] = useState('');

  useEffect(() => {
    // Fetch patients
    axios.get('/api/patients')
      .then(response => {
        setPatients(response.data);
      })
      .catch(error => {
        console.error('Error fetching patients:', error);
      });

    // Fetch doctors
    axios.get('/api/doctors')
      .then(response => {
        setDoctors(response.data);
      })
      .catch(error => {
        console.error('Error fetching doctors:', error);
      });

    // Fetch departments
    axios.get('/api/departments')
      .then(response => {
        setDepartments(response.data);
      })
      .catch(error => {
        console.error('Error fetching departments:', error);
      });

    // Fetch time schedules
    axios.get('/api/time-schedules')
      .then(response => {
        setTimeSchedules(response.data);
      })
      .catch(error => {
        console.error('Error fetching time schedules:', error);
      });
  }, []);

  const handleDepartmentChange = (event) => {
    setSelectedDepartment(event.target.value);
    setSelectedDoctor('');
  };

  const handleDoctorChange = (event) => {
    setSelectedDoctor(event.target.value);
  };

  const handleDateChange = (event) => {
    setSelectedDate(event.target.value);
  };

  const handleTimeSlotChange = (event) => {
    setSelectedTimeSlot(event.target.value);
  };

  const handleStatusChange = (event) => {
    setStatus(event.target.value);
  };

  const handleNotesChange = (event) => {
    setNotes(event.target.value);
  };

  const handleSubmit = (event) => {
    event.preventDefault();

    // Create the appointment
    axios.post('/api/appointments', {
      patient: selectedPatient,
      doctor: selectedDoctor,
      department: selectedDepartment,
      date: selectedDate,
      timeSlots: selectedTimeSlot,
      status,
      notes
    })
      .then(response => {
        // Handle success
        console.log('Appointment created successfully:', response.data);
        // Redirect or display success message
      })
      .catch(error => {
        // Handle error
        console.error('Error creating appointment:', error);
        // Display error message
      });
  };

  return (
    <div>
      <h1>Create Appointment</h1>
      <form onSubmit={handleSubmit}>
        <div>
          <label>Patient:</label>
          <select>
            <option value="">Select a patient</option>
            {patients.map(patient => (
              <option key={patient.id} value={patient.id}>{patient.name}</option>
            ))}
          </select>
        </div>
        <div>
          <label>Department:</label>
          <select value={selectedDepartment} onChange={handleDepartmentChange}>
            <option value="">Select a department</option>
            {departments.map(department => (
              <option key={department.id} value={department.id}>{department.name}</option>
            ))}
          </select>
        </div>
        <div>
          <label>Doctor:</label>
          <select value={selectedDoctor} onChange={handleDoctorChange}>
            <option value="">Select a doctor</option>
            {doctors
              .filter(doctor => doctor.department_id === selectedDepartment)
              .map(doctor => (
                <option key={doctor.id} value={doctor.id}>{doctor.name}</option>
              ))}
          </select>
        </div>
        <div>
          <label>Date:</label>
          <input type="date" value={selectedDate} onChange={handleDateChange} />
        </div>
        <div>
          <label>Time Slot:</label>
          <select value={selectedTimeSlot} onChange={handleTimeSlotChange}>
            <option value="">Select a time slot</option>
            {timeSchedules.map(timeSchedule => (
              <option key={timeSchedule.id} value={timeSchedule.time}>{timeSchedule.time}</option>
            ))}
          </select>
        </div>
        <div>
          <label>Status:</label>
          <input type="text" value={status} onChange={handleStatusChange} />
        </div>
        <div>
          <label>Notes:</label>
          <textarea value={notes} onChange={handleNotesChange} />
        </div>
        <button type="submit">Create Appointment</button>
      </form>
    </div>
  );
};

export default Appointment;
