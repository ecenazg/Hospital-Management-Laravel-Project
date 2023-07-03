import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import Navbar from './Navbar';
import axios from 'axios';


const Patients = ({ patients }) => {
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

    if (patient && editField && saveButton) {
      patient.name = editField.value;
      saveButton.innerText = 'Saving...';

      try {
        // Make an Inertia POST request to update the doctor
        const response = await post(`/patients/${id}`, {
          name: patient.name,
          _token: csrf_token,
        });
  
        console.log(response); // Add this line to inspect the response
  
        saveButton.innerText = 'Save';
        editField.style.display = 'none';
        saveButton.style.display = 'none';
      } catch (error) {
        console.error('Error:', error);
      }
    }
  };

  const handleDelete = (id) => {
    if (window.confirm('Are you sure you want to delete this patient?')) {
      Inertia.delete(`/patients/${id}`)
        .then(() => {
          // Handle success
        })
        .catch((error) => {
          console.error('Error:', error);
        });
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
                  />
                </td>
                <td>{patient.email}</td>
                <td>{patient.illness}</td>
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
