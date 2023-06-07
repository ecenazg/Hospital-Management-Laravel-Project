import React, { useEffect } from 'react';

const DoctorManagement = ({ doctors }) => {
  useEffect(() => {
    const editButtons = document.querySelectorAll('.edit-button');
    const saveButtons = document.querySelectorAll('.save-button');
    const editFields = document.querySelectorAll('.edit-field');
    const spans = document.querySelectorAll('td span');
    const sendButtons = document.querySelectorAll('.send-patients-button');

    const handleEdit = (index) => {
      spans[index].style.display = 'none';
      editFields[index * 3].style.display = 'inline-block';
      editFields[index * 3 + 1].style.display = 'inline-block';
      editFields[index * 3 + 2].style.display = 'inline-block';
      editButtons[index].style.display = 'none';
      saveButtons[index].style.display = 'inline-block';
    };

    const handleSave = (doctorId, index) => {
      const formData = new FormData();
      const name = editFields[index * 3].value;
      const email = editFields[index * 3 + 1].value;
      const specialization = editFields[index * 3 + 2].value;

      formData.append('name', name);
      formData.append('email', email);
      formData.append('specialization', specialization);

      fetch(`/doctors/${doctorId}`, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
      })
        .then((response) => {
          if (response.ok) {
            location.reload(); // Refresh the page
            throw new Error('Failed to save changes.');
          }
        })
        .catch((error) => {
          console.error('An error occurred while saving changes:', error);
        });
    };

    const handleInputChange = (event) => {
      // Input changes tracking
    };

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

    sendButtons.forEach((button) => {
      button.addEventListener('click', (event) => {
        event.preventDefault();
        const form = button.parentElement;
        const doctorId = form.querySelector('input[name="doctor_id"]').value;
        form.setAttribute('action', `/doctors/${doctorId}/send-to-patients`);
        form.submit();
      });
    });

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
            {doctors.map((doctor) => (
              <tr key={`doctor-row-${doctor.id}`}>
                <td>{doctor.id}</td>
                <td>
                  <span>{doctor.name}</span>
                  <input
                    type="text"
                    className="edit-field"
                    value={doctor.name}
                    style={{ display: 'none' }}
                  />
                </td>
                <td>
                  <span>{doctor.email}</span>
                  <input
                    type="text"
                    className="edit-field"
                    value={doctor.email}
                    style={{ display: 'none' }}
                  />
                </td>
                <td>
                  <span>{doctor.specialization}</span>
                  <input
                    type="text"
                    className="edit-field"
                    value={doctor.specialization}
                    style={{ display: 'none' }}
                  />
                </td>
                <td>
                  <button className="edit-button">Edit</button>
                  <button
                    className="save-button"
                    style={{ display: 'none' }}
                  >
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

export default DoctorManagement;
