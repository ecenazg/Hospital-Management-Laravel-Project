import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Link } from '@inertiajs/inertia-react';

const Appointment = ({appointments}) => {
  console.log(appointments);

  return (
    <div>
      <h1>Appointments</h1>
      <Link href={route('appointments.add')}>Add Appointment</Link>
      {appointments.data.length === 0 ? (
        <p>No appointments available.</p>
      ) : (
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Type</th>
              <th>Patient</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {appointments.data.map(appointment => (
              <tr key={appointment.id}>
                <td>{appointment.date}</td>
                <td>{appointment.type}</td>
                <td>{appointment.patient.name}</td>
                <td>
                  <Link href={route('appointments.view', { appointment })}>View</Link>
                  <Link href={route('appointments.book', { patient: appointment.patient })}>Book</Link>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      )}
    </div>
  );
};

export default Appointment;
