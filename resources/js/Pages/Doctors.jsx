import React, { useState, useEffect } from 'react';

const Doctors = ({ doctors }) => {
  useEffect(() => {
    const handleEdit = (index) => {
      const editForms = document.querySelectorAll('.edit-form');
      const spans = document.querySelectorAll('td span');

      spans[index].style.display = 'none';
      editForms[index].style.display = 'inline-block';
    };

    const handleSave = (doctorId, index) => {
      const editForms = document.querySelectorAll('.edit-form');
      const formData = new FormData(editForms[index]);
      
      fetch(`/doctors/${doctorId}`, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error('Failed to save changes.');
          } else {
            location.reload(); // Refresh the page
          }
        })
        .catch((error) => {
          console.error('An error occurred while saving changes:', error);
        });
    };

    const handleInputChange = (event) => {
      // Input changes tracking
    };

    const editButtons = document.querySelectorAll('.edit-button');
    const saveButtons = document.querySelectorAll('.save-button');

    editButtons.forEach((button, index) => {
      button.addEventListener('click', () => handleEdit(index));
    });

    saveButtons.forEach((button, index) => {
      button.addEventListener('click', () => {
        const doctorId = button.parentElement.parentElement.querySelector(
          'td:first-child'
        ).textContent;
        handleSave(doctorId, index);
      });
    });

    const editFields = document.querySelectorAll('.edit-field');
    editFields.forEach((field) => {
      field.addEventListener('input', handleInputChange);
    });
  }, []);

  const handleSendToPatients = (doctorId) => {
    fetch(`/doctors/${doctorId}/send-to-patients`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
      },
      body: JSON.stringify({
        doctor_id: doctorId,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.patients.length > 0) {
          let tableHtml = '<table>';
          tableHtml += '<tr><th>ID</th><th>Name</th><th>Email</th></tr>';
          data.patients.forEach((patient) => {
            tableHtml += '<tr>';
            tableHtml += '<td>' + patient.id + '</td>';
            tableHtml += '<td>' + patient.name + '</td>';
            tableHtml += '<td>' + patient.email + '</td>';
            tableHtml += '</tr>';
          });
          tableHtml += '</table>';

          const newWindow = window.open('', '_blank');
          newWindow.document.write(tableHtml);
          newWindow.document.close();
        } else {
          console.log('No patients found.');
        }
      })
      .catch((error) => {
        console.error('An error occurred while fetching patients:', error);
      });
  };

  return (
    <div>
      <h1>Doctor Management</h1>

      {doctors.length > 0 ? (
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Specialization</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {doctors.map((doctor, index) => (
              <tr key={`doctor-row-${doctor.id}`}>
                <td>{doctor.id}</td>
                <td>
                  <span>{doctor.name}</span>
                  <form className="edit-form" style={{ display: 'none' }}>
                    <input
                      type="text"
                      name="name"
                      className="edit-field"
                      value={doctor.name}
                    />
                  </form>
                </td>
                <td>
                  <span>{doctor.email}</span>
                  <form className="edit-form" style={{ display: 'none' }}>
                    <input
                      type="text"
                      name="email"
                      className="edit-field"
                      value={doctor.email}
                    />
                  </form>
                </td>
                <td>
                  <span>{doctor.specialization}</span>
                  <form className="edit-form" style={{ display: 'none' }}>
                    <input
                      type="text"
                      name="specialization"
                      className="edit-field"
                      value={doctor.specialization}
                    />
                  </form>
                </td>
                <td>
                  <button className="edit-button">Edit</button>
                  <button className="save-button" style={{ display: 'none' }}>
                    Save
                  </button>
                  <form
                    className="delete-form"
                    action={`/doctors/${doctor.id}`}
                    method="POST"
                  >
                    <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit">Delete</button>
                  </form>
                  <form
                    className="send-patients-form"
                    action={`/doctors/${doctor.id}/send-to-patients`}
                    method="POST"
                    target="_blank"
                  >
                    <input
                      type="hidden"
                      name="doctor_id"
                      value={doctor.id}
                    />
                    <button
                      type="submit"
                      className="send-patients-button"
                      onClick={() => handleSendToPatients(doctor.id)}
                    >
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
