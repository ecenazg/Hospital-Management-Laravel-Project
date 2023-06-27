import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import Navbar from './Navbar';
const Nurses = ({ nurses }) => {
  const handleEdit = (id) => {
    const nurse = nurses.find((nurse) => nurse.id === id);
    const editField = document.querySelector(`#edit-field-${id}`);
    const saveButton = document.querySelector(`#save-button-${id}`);

    if (nurse && editField && saveButton) {
      editField.style.display = 'block';
      editField.value = nurse.name;
      saveButton.style.display = 'inline-block';
    }
  };

  const handleSave = (id) => {
    const nurse = nurses.find((nurse) => nurse.id === id);
    const editField = document.querySelector(`#edit-field-${id}`);
    const saveButton = document.querySelector(`#save-button-${id}`);

    if (nurse && editField && saveButton) {
      nurse.name = editField.value;
      saveButton.innerText = 'Saving...';

      Inertia.post(`/nurses/${id}`, { name: nurse.name })
        .then((response) => {
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

  const handleDelete = (id) => {
    if (window.confirm('Are you sure you want to delete this nurse?')) {
      Inertia.delete(`/nurses/${id}`)
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
      <h1>Nurse Management</h1>

      {nurses.length > 0 ? (
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
            {nurses.map((nurse) => (
              <tr key={nurse.id}>
                <td>{nurse.id}</td>
                <td>
                  <span>{nurse.name}</span>
                  <input
                    type="text"
                    className="edit-field"
                    id={`edit-field-${nurse.id}`}
                    style={{ display: 'none' }}
                  />
                </td>
                <td>{nurse.email}</td>
                <td>{nurse.department}</td>
                <td>
                  <button className="edit-button" onClick={() => handleEdit(nurse.id)}>
                    Edit
                  </button>
                  <button
                    className="save-button"
                    id={`save-button-${nurse.id}`}
                    style={{ display: 'none' }}
                    onClick={() => handleSave(nurse.id)}
                  >
                    Save
                  </button>
                  <button className="delete-button" onClick={() => handleDelete(nurse.id)}>
                    Delete
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      ) : (
        <p>No nurses found.</p>
      )}
    </div>
  );
};

export default Nurses;
