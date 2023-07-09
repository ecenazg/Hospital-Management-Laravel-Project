import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { Form, FormGroup, Label, Input, Button } from 'reactstrap';

const AppointmentAdd = ({ phone_number, patients }) => {
  const [patientId, setPatientId] = useState('');
  const [type, setType] = useState('Follow up');
  const [date, setDate] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();

    const formData = {
      patient_id: patientId,
      type,
      date,
    };

    Inertia.post('/appointments/confirm', formData);
  };

  return (
    <div>
      <h1>Add Appointment</h1>
      <Form onSubmit={handleSubmit}>
        {phone_number && (
          <FormGroup>
            <Label for="phone_number">Phone Number</Label>
            <Input type="text" id="phone_number" value={phone_number} disabled />
          </FormGroup>
        )}
        {patients && patients.length > 0 && (
          <FormGroup>
            <Label for="patient_id">Patient</Label>
            <Input
              type="select"
              id="patient_id"
              value={patientId}
              onChange={(e) => setPatientId(e.target.value)}
            >
              <option value="">Select Patient</option>
              {patients.map((patient) => (
                <option key={patient.id} value={patient.id}>
                  {patient.name}
                </option>
              ))}
            </Input>
          </FormGroup>
        )}
        <FormGroup>
          <Label for="type">Type</Label>
          <Input
            type="select"
            id="type"
            value={type}
            onChange={(e) => setType(e.target.value)}
          >
            <option value="Follow up">Follow up</option>
            <option value="Visit">Visit</option>
          </Input>
        </FormGroup>
        <FormGroup>
          <Label for="date">Date</Label>
          <Input
            type="date"
            id="date"
            value={date}
            onChange={(e) => setDate(e.target.value)}
          />
        </FormGroup>
        <Button type="submit">Add Appointment</Button>
      </Form>
    </div>
  );
};

export default AppointmentAdd;
