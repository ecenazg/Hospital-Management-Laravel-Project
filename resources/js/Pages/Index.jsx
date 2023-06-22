import React from 'react';

const Index = () => {
  return (
    <div>
      <nav className="navbar">
        <ul>
          <li><a href="/patients">Patients</a></li>
          <li><a href="/doctors">Doctors</a></li>
          <li><a href="/nurses">Nurses</a></li>
          <li><a href="/management">Management</a></li>
          <li><a href="/departments">Departments</a></li>
          <li><a href="/appointments">Appointments</a></li>
          <li><a href="/contact">Contact Us</a></li>
          <li><a href="/about">About</a></li>
        </ul>
      </nav>

      <h1>Welcome to ECE's Hospital</h1>
      <div className="content">
        <div className="image-container">
          <img src="https://i.pinimg.com/564x/ee/90/c5/ee90c5fc636bcc1e38f10c482b24c871.jpg" alt="Hospital Image" />
        </div>
        <h2 style={{ marginTop: '20px' }}>The #1 Hospital Service in Ankara</h2>
      </div>
    </div>
  );
};

export default Index;
