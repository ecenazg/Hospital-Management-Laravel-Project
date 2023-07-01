import React, { useState, useEffect } from 'react';
import { Inertia } from '@inertiajs/inertia';
import Navbar from './Navbar';
import $ from 'jquery';

const Doctors = ({ doctors, csrf_token }) => {
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

      // Make an AJAX request to update the doctor
      $.ajax({
        type: 'POST',
        url: `/doctors/${id}`,
        data: {
          name: doctor.name,
          _token: csrf_token,
        },
        success: function (data) {
          console.log(data); // Add this line to inspect the response
          saveButton.innerText = 'Save';
          editField.style.display = 'none';
          saveButton.style.display = 'none';
        },
        error: function (data, textStatus, errorThrown) {
          console.error('Error:', data);
        },
      });
    }
  };

  const handleDelete = (id) => {
    if (window.confirm('Are you sure you want to delete this patient?')) {
      Inertia.delete(`/doctors/${id}`)
        .then(() => {
          // Handle success
        })
        .catch((error) => {
          console.error('Error:', error);
        });
    }
  };

  useEffect(() => {
    // Add CSRF token to AJAX requests
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
    });
  }, []);

  return (
    <div className="overflow-x-auto">
      <Navbar />
      <head>
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      </head>
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
                  <form className="delete-form" action={`/doctors/${doctor.id}`} method="POST">
                    <input type="hidden" name="_method" value="DELETE" />
                    {/* Include the CSRF token field */}
                    <input type="hidden" name="_token" value={csrf_token} />
                    <button type="submit">Delete</button>
                  </form>
                  <form
                    className="send-patients-form"
                    action={`/doctors/${doctor.id}/send-to-patients`}
                    method="POST"
                    target="_blank"
                  >
                    {/* Include the CSRF token field */}
                    <input type="hidden" name="_token" value={csrf_token} />
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
