import React, { useEffect, useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

const AppointmentsPage = () => {
  const [appointments, setAppointments] = useState([]);

  useEffect(() => {
    // Fetch appointments data using Inertia
    const fetchAppointments = async () => {
      try {
        const response = await Inertia.get('/appointments');
        if (response && response.data) {
          setAppointments(response.data);
        } else {
          console.error('Error fetching appointments: Invalid response format');
        }
      } catch (error) {
        console.error('Error fetching appointments:', error);
      }
    };
    
    fetchAppointments();
  }, []);

  return (
    <div>
      <h1>Appointments</h1>
      {appointments.length === 0 ? (
        <p>No appointments available.</p>
      ) : (
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Type</th>
              <th>Patient</th>
            </tr>
          </thead>
          <tbody>
            {appointments.map(appointment => (
              <tr key={appointment.id}>
                <td>{appointment.date}</td>
                <td>{appointment.type}</td>
                <td>{appointment.patient}</td>
              </tr>
            ))}
          </tbody>
        </table>
      )}
    </div>
  );
};

export default AppointmentsPage;
