import React, { useState, useEffect } from 'react';

const Nurses = () => {
  const [nurses, setNurses] = useState([]);

  return (
    <div className="overflow-x-auto">
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
            {nurses.map((nurse, index) => (
              <tr key={nurse.id}>
                <td>{nurse.id}</td>
                <td>
                  <span>{nurse.name}</span>
                  <input
                    type="text"
                    className="edit-field"
                    value={nurse.name}
                    style={{ display: 'none' }}
                  />
                </td>
                <td>
                  <span>{nurse.email}</span>
                  <input
                    type="text"
                    className="edit-field"
                    value={nurse.email}
                    style={{ display: 'none' }}
                  />
                </td>
                <td>
                  <span>{nurse.department_name}</span>
                  <input
                    type="text"
                    className="edit-field"
                    value={nurse.department_name}
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
        <p>No nurse found.</p>
      )}

      {}
    </div>
  );
};

export default Nurses;
