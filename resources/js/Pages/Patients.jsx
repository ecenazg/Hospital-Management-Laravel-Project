import React, { useState, useEffect } from 'react';
import { Inertia } from '@inertiajs/inertia';
import Navbar from './Navbar';
import axios from 'axios';

const Patients = ({ patients, csrf_token }) => {
  const handleEdit = (id) => {
    const patient = patients.find((patient) => patient.id === id);
    const editField = document.querySelector(`#edit-field-${id}`);
    const saveButton = document.querySelector(`#save-button-${id}`);

    if (patient && editField && saveButton) {
      editField.style.display = 'block';
      editField.value = patient.name;
      saveButton.style.display = 'inline-block';
    }
  };

  const handleSave = async (id) => {
    const patient = patients.find((patient) => patient.id === id);
    const editField = document.querySelector(`#edit-field-${id}`);
    const saveButton = document.querySelector(`#save-button-${id}`);
    const departmentField = document.querySelector(`#department-field-${id}`);
    const testField = document.querySelector(`#test-field-${id}`);
    const doctorField = document.querySelector(`#doctor-field-${id}`);

    if (patient && editField && saveButton && departmentField && testField && doctorField) {
      patient.name = editField.value;
      patient.department_name = departmentField.value;
      patient.test = testField.value;
      patient.doctor_id = doctorField.value;
      saveButton.innerText = 'Saving...';

      try {
        const response = await axios.post(`/patients/${id}`, {
          name: patient.name,
          email: patient.email,
          illness: patient.illness,
          department_name: patient.department_name,
          test: patient.test,
          doctor_id: patient.doctor_id,
          _token: csrf_token,
        });

        console.log(response);
      } catch (error) {
        console.error('Error:', error);
        console.log(error.response.data); // Access the error response data
      }
    }
  };

  
  const handleDelete = async (id) => {
    if (window.confirm('Are you sure you want to delete this patient?')) {
      try {
        const response = await axios.delete(`/patients/${id}`, {
          headers: {
            'X-CSRF-TOKEN': csrf_token,
            'X-Requested-With': 'XMLHttpRequest',
          },
        });
  
        console.log(response);
        // Perform any necessary actions after successful deletion
        Inertia.reload(); // Reload the current page
      } catch (error) {
        console.error('Error:', error);
        if (error.response) {
          console.log(error.response.data); // Access the error response data
        }
      }
    }
  };

  return (
    <div className="overflow-x-auto">
      <Navbar />
      <h1>Patient Management</h1>

      {patients.length > 0 ? (
        <table className="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Illness</th>
              <th>Department</th>
              <th>Test</th>
              <th>Doctor ID</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {patients.map((patient) => (
              <tr key={patient.id}>
                <td>{patient.id}</td>
                <td>
                  <span>{patient.name}</span>
                  <input
                    type="text"
                    className="edit-field"
                    id={`edit-field-${patient.id}`}
                    style={{ display: 'none' }}
                    defaultValue={patient.name}
                  />
                </td>
                <td>{patient.email}</td>
                <td>{patient.illness}</td>
                <td>
                  <input
                    type="text"
                    className="edit-field"
                    id={`department-field-${patient.id}`}
                    style={{ display: 'none' }}
                    defaultValue={patient.department_name}
                  />
                </td>
                <td>
                  <input
                    type="text"
                    className="edit-field"
                    id={`test-field-${patient.id}`}
                    style={{ display: 'none' }}
                    defaultValue={patient.test}
                  />
                </td>
                <td>
                  <input
                    type="text"
                    className="edit-field"
                    id={`doctor-field-${patient.id}`}
                    style={{ display: 'none' }}
                    defaultValue={patient.doctor_id}
                  />
                </td>
                <td>
                  <button className="edit-button" onClick={() => handleEdit(patient.id)}>
                    Edit
                  </button>
                  <button
                    className="save-button"
                    id={`save-button-${patient.id}`}
                    style={{ display: 'none' }}
                    onClick={() => handleSave(patient.id)}
                  >
                    Save
                  </button>
                  <button className="delete-button" onClick={() => handleDelete(patient.id)}>
                    Delete
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      ) : (
        <p>No patients found.</p>
      )}
    </div>
  );
};

export default Patients;
