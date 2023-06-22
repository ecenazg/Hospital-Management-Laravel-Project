import React, { useState, useEffect } from 'react';

const Patient = () => {
  const [patients, setPatients] = useState([]);

  return (
    <div>
      <h1>Patient Management</h1>

      {patients.length > 0 ? (
        <table>
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
            {patients.map((patient, index) => (
              <tr key={patient.id}>
                <td>{patient.id}</td>
                <td>
                  <span>{patient.name}</span>
                  <input
                    type="text"
                    className="edit-field"
                    value={patient.name}
                    style={{ display: 'none' }}
                  />
                </td>
                <td>
                  <span>{patient.email}</span>
                  <input
                    type="text"
                    className="edit-field"
                    value={patient.email}
                    style={{ display: 'none' }}
                  />
                </td>
                <td>
                  <span>{patient.illness}</span>
                  <input
                    type="text"
                    className="edit-field"
                    value={patient.illness}
                    style={{ display: 'none' }}
                  />
                </td>
                <td>
                  <button
                    className="edit-button"
                    onClick={() => handleEdit(index)}
                  >
                    Edit
                  </button>
                  <button
                    className="save-button"
                    style={{ display: 'none' }}
                  >
                    Save
                  </button>
                  <form
                    className="delete-form"
                    action={`/patients/${patient.id}`}
                    method="POST"
                  >
                    {/* CSRF token ve DELETE isteği için gerekli diğer alanları buraya ekleyin */}
                    <button type="submit">Delete</button>
                  </form>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      ) : (
        <p>No patients found.</p>
      )}

      {}
    </div>
  );
};

export default Patient;
