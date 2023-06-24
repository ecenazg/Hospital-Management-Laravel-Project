import React from 'react';
import { Link } from 'inertia-react';

const Laboratory = ({ laboratory, patientTests }) => {
  return (
    <div>
      <h1>Laboratory: {laboratory.name}</h1>
      <h2>Tests</h2>
      <ul>
        {patientTests.map((patientTest, index) => (
          <li key={index}>
            <strong>Test:</strong> {patientTest.test}<br />
            <strong>Patient:</strong> {patientTest.patient}<br />
            <strong>Status:</strong> {patientTest.status}
          </li>
        ))}
      </ul>
      <Link href="/laboratory">Back to Laboratories</Link>
    </div>
  );
};

export default Laboratory;
