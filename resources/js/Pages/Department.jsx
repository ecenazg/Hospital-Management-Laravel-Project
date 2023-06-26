import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

const Department = () => {
  const [departments, setDepartments] = useState([]);

  useEffect(() => {
    fetchDepartments();
  }, []);

  const fetchDepartments = async () => {
    try {
      const response = await axios.get('/departments');
      setDepartments(response.data.departments);
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <div>
      <h1>Guven Hospital Departments</h1>
      {departments.map((department) => (
        <div key={department.id}>
          <h2>{department.department_name}</h2>
          <p>{department.description}</p>
          <Link to={`/departments/${department.department_name}`}>View Doctors</Link>
        </div>
      ))}
    </div>
  );
};

export default Department;
