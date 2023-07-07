import React, { useEffect, useState } from "react";
import { Inertia } from "@inertiajs/inertia";
import Navbar from "./Navbar";

const Department = ({ departments }) => {
    const [doctors, setDoctors] = useState([]);

    const fetchDoctorsByDepartment = async (departmentName) => {
        const response = await Inertia.get(
            `/departments/${departmentName}/doctors`
        );

        if (response && response.department && response.doctors) {
            const { department, doctors } = response;
            console.log(department); // For debugging
            console.log(doctors); // For debugging
            setDoctors(doctors);
        }
    };

    return (
        <div>
            <Navbar />
            <h1>Ece Hospital Departments</h1>
            {Array.isArray(departments) && departments.length > 0 ? (
                <table>
                    <thead>
                        <tr>
                            <th>Department </th>
                            <th>Department Head </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {departments.map((department) => (
                            <tr key={department.id}>
                                <td>{department.department_name}</td>
                                <td>{department.department_head}</td>
                                <td>
                                    <a href={`/departments/${department.department_name}/doctors`}
                                    >View</a>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            ) : (
                <p>No departments found.</p>
            )}

            {doctors.length > 0 && (
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        {doctors.map((doctor) => (
                            <tr key={doctor.id}>
                                <td>{doctor.name}</td>
                                <td>{doctor.email}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}
        </div>
    );
};

export default Department;
