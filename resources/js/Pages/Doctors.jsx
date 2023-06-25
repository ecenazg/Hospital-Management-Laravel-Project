import React, { useState, useEffect } from 'react';

const Doctors = ({ doctors }) => {
  const handleEdit = (id) => {
    const doctor = doctors.find((doctor) => doctor.id === id);
    const editField = document.querySelector(`#edit-field-${id}`);
    const saveButton = document.querySelector(`#save-button-${id}`);

    if (doctor && editField && saveButton) {
      editField.style.display = 'block';
      editField.value = doctor.name;
      saveButton.style.display = 'inline-block';
    }
  };

  const handleSave = (id) => {
    const doctor = doctors.find((doctor) => doctor.id === id);
    const editField = document.querySelector(`#edit-field-${id}`);
    const saveButton = document.querySelector(`#save-button-${id}`);

    if (doctor && editField && saveButton) {
      doctor.name = editField.value;
      saveButton.innerText = 'Saving...';

      // Make a fetch request to update the doctor
      fetch(`/doctors/${id}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          // Add your CSRF token header here
          // 'X-CSRF-TOKEN': 'your-csrf-token',
        },
        body: JSON.stringify({ name: doctor.name }),
      })
        .then((response) => response.json())
        .then((data) => {
          // Handle the response data
          saveButton.innerText = 'Save';
          editField.style.display = 'none';
          saveButton.style.display = 'none';
        })
        .catch((error) => {
          console.error('Error:', error);
        });
    }
  };

  return (
    <div className="overflow-x-auto">
      <h1>Doctor Management</h1>

      {doctors.length > 0 ? (
        <table className="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Department</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {doctors.map((doctor) => (
              <tr key={doctor.id}>
                <td>{doctor.id}</td>
                <td>
                  <span>{doctor.name}</span>
                  <input
                    type="text"
                    className="edit-field"
                    id={`edit-field-${doctor.id}`}
                    style={{ display: 'none' }}
                  />
                </td>
                <td>{doctor.email}</td>
                <td>{doctor.department_name}</td>
                <td>
                  <button className="edit-button" onClick={() => handleEdit(doctor.id)}>
                    Edit
                  </button>
                  <button
                    className="save-button"
                    id={`save-button-${doctor.id}`}
                    style={{ display: 'none' }}
                    onClick={() => handleSave(doctor.id)}
                  >
                    Save
                  </button>
                  <form
                    className="delete-form"
                    action={`/doctors/${doctor.id}`}
                    method="POST"
                  >
                    {/* CSRF token and other necessary fields for the DELETE request should be added here */}
                    <button type="submit">Delete</button>
                  </form>
                  <form
                    className="send-patients-form"
                    action={`/doctors/${doctor.id}/send-to-patients`}
                    method="POST"
                    target="_blank"
                  >
                    {/* CSRF token and other necessary fields for sending patients should be added here */}
                    <input type="hidden" name="doctor_id" value={doctor.id} />
                    <button type="submit" className="send-patients-button">
                      Send to Patients
                    </button>
                  </form>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      ) : (
        <p>No doctors found.</p>
      )}
    </div>
  );
};

export default Doctors;
