import React from "react";
import { Inertia } from "@inertiajs/inertia";
import Navbar from "./Navbar";
import axios from "axios";

const Nurses = ({ nurses }) => {
    const handleEdit = (id) => {
        const nurse = nurses.find((nurse) => nurse.id === id);
        const editField = document.querySelector(`#edit-field-${id}`);
        const departmentField = document.querySelector(
            `#department-field-${id}`
        );
        const saveButton = document.querySelector(`#save-button-${id}`);

        if (nurse && editField && departmentField && saveButton) {
            editField.style.display = "block";
            editField.value = nurse.name;
            departmentField.style.display = "block";
            departmentField.value = nurse.department;
            saveButton.style.display = "inline-block";
        }
    };

    const handleSave = async (id) => {
        const nurse = nurses.find((nurse) => nurse.id === id);
        const editField = document.querySelector(`#edit-field-${id}`);
        const departmentField = document.querySelector(
            `#department-field-${id}`
        );
        const saveButton = document.querySelector(`#save-button-${id}`);

        if (nurse && editField && departmentField && saveButton) {
            nurse.name = editField.value;
            nurse.department = departmentField.value;
            saveButton.innerText = "Saving...";

            try {
                const response = await axios.post(`/nurses/${id}`, {
                    name: nurse.name,
                    email: nurse.email,
                    department: nurse.department,
                });

                console.log(response);
                saveButton.innerText = "Save";
                editField.style.display = "none";
                departmentField.style.display = "none";
                saveButton.style.display = "none";
            } catch (error) {
                console.error("Error:", error);

                if (
                    error.response &&
                    error.response.data &&
                    error.response.data.errors
                ) {
                    // Handle the specific error messages returned by the server
                    const errorMessages = Object.values(
                        error.response.data.errors
                    );
                    console.log(errorMessages);
                }
            }
        }
    };

    const handleDelete = (id) => {
        if (window.confirm("Are you sure you want to delete this nurse?")) {
            Inertia.delete(`/nurses/${id}`)
                .then(() => {
                    // Handle success
                })
                .catch((error) => {
                    console.error("Error:", error);
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
                                        style={{ display: "none" }}
                                    />
                                </td>
                                <td>{nurse.email}</td>
                                <td>
                                    <span>{nurse.department}</span>
                                    <input
                                        type="text"
                                        className="edit-field"
                                        id={`department-field-${nurse.id}`}
                                        style={{ display: "none" }}
                                    />
                                </td>
                                <td>
                                    <button
                                        className="edit-button"
                                        onClick={() => handleEdit(nurse.id)}
                                    >
                                        Edit
                                    </button>
                                    <button
                                        className="save-button"
                                        id={`save-button-${nurse.id}`}
                                        style={{ display: "none" }}
                                        onClick={() => handleSave(nurse.id)}
                                    >
                                        Save
                                    </button>
                                    <button
                                        className="delete-button"
                                        onClick={() => handleDelete(nurse.id)}
                                    >
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
