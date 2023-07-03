import React, { useState, useEffect } from 'react';
import Navbar from './Navbar';
import { useForm } from '@inertiajs/inertia-react';
import axios from 'axios';



const Doctors = ({ doctors, csrf_token }) => {
  const { post, delete: destroy } = useForm();

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

  const handleSave = async (id) => {
    const doctor = doctors.find((doctor) => doctor.id === id);
    const editField = document.querySelector(`#edit-field-${id}`);
    const saveButton = document.querySelector(`#save-button-${id}`);
  
    if (doctor && editField && saveButton) {
      doctor.name = editField.value;
      saveButton.innerText = 'Saving...';
  
      try {
        const response = await axios.post(`/doctors/${id}`, {
          name: doctor.name,
          email: doctor.email,
          department_name: doctor.department_name,
          _token: csrf_token,
        });
      
        console.log(response);
      } catch (error) {
        console.error('Error:', error);
        console.log(error.response.data); // Access the error response data
      }
    }
  };
  
  
  const handleDelete = (id) => {
    if (window.confirm('Are you sure you want to delete this doctor?')) {
      Inertia.delete(`/doctors/${id}`)
        .then(() => {
          // Handle success
        })
        .catch((error) => {
          console.error('Error:', error);
        });
    }
  };
  

  /*useEffect(() => {
    // Add CSRF token to Inertia requests
    Inertia.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf_token;
  }, [csrf_token]);
*/
  return (
    <div className="overflow-x-auto">
      <Navbar />
      
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
