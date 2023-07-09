import React, { useState } from "react";
import { Form, FormGroup, Label, Input, Button } from "reactstrap";
import { Inertia } from "@inertiajs/inertia";

const AppointmentDetail = ({ appointment, historicalAppointments }) => {
  const [problems, setProblems] = useState(appointment.visit.problems);
  const [prescription, setPrescription] = useState(appointment.visit.prescription);

  const handleSubmit = (e) => {
    e.preventDefault();

    const formData = {
      problems,
      prescription,
      visit_id: appointment.visit.id,
    };

    Inertia.post("/appointments/update", formData);
  };

  return (
    <div>
      <h1>Appointment Detail</h1>
      <div>
        <h2>Patient Information</h2>
        <p>Patient Name: {appointment.patient.name}</p>
        <p>Patient ID: {appointment.patient.patient_id}</p>
        <p>Phone Number: {appointment.patient.phone_number}</p>
      </div>
      <div>
        <h2>Visit Information</h2>
        <p>Date: {appointment.date}</p>
        <p>Type: {appointment.type}</p>
      </div>
      <div>
        <h2>Visit Details</h2>
        <Form onSubmit={handleSubmit}>
          <FormGroup>
            <Label for="problems">Problems</Label>
            <Input
              type="textarea"
              id="problems"
              value={problems}
              onChange={(e) => setProblems(e.target.value)}
            />
          </FormGroup>
          <FormGroup>
            <Label for="prescription">Prescription</Label>
            <Input
              type="textarea"
              id="prescription"
              value={prescription}
              onChange={(e) => setPrescription(e.target.value)}
            />
          </FormGroup>
          <Button type="submit">Update</Button>
        </Form>
      </div>
      {historicalAppointments.length > 0 && (
        <div>
          <h2>Historical Appointments</h2>
          <ul>
            {historicalAppointments.map((historicalAppointment) => (
              <li key={historicalAppointment.id}>
                <p>Date: {historicalAppointment.date}</p>
                <p>Type: {historicalAppointment.type}</p>
              </li>
            ))}
          </ul>
        </div>
      )}
    </div>
  );
};

export default AppointmentDetail;
