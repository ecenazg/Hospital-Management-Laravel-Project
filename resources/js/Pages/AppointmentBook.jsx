import React, { useState } from 'react';
import { Form, FormGroup, Label, Input, Button } from 'reactstrap';

const AppointmentBook = ({ patient }) => {
  const [type, setType] = useState('Follow up');
  const [date, setDate] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    // Perform form validation if needed

    // Create appointment using the form data
    const appointmentData = {
      patient_id: patient.id,
      type,
      date,
    };

    // Submit the form data to the server
    // You can make an API request here to the 'confirm' endpoint in the controller
    // using the appointmentData

    // Redirect to the home page after successful submission
    // You can replace the following line with your preferred redirection method
    window.location.href = '/';
  };

  return (
    <div>
      <h1>Book Appointment</h1>
      <h2>Patient: {patient.name}</h2>
      <Form onSubmit={handleSubmit}>
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
        <Button type="submit">Book Appointment</Button>
      </Form>
    </div>
  );
};

export default AppointmentBook;
