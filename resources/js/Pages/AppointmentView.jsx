import React from 'react';

const AppointmentView = ({ appointment }) => {
  return (
    <div>
      <h1>Appointment Details</h1>
      <h2>Date: {appointment.date}</h2>
      <h2>Type: {appointment.type}</h2>
      <h2>Patient: {appointment.patient.name}</h2>
      {/* Additional appointment details can be displayed here */}
    </div>
  );
};

export default AppointmentView;
