import React, { useEffect, useState } from 'react';

const Laboratory = () => {
  const [laboratory, setLaboratory] = useState(null);
  const [patientTests, setPatientTests] = useState([]);

  useEffect(() => {
    const fetchLaboratoryData = async () => {
      // Fetch laboratory data from the server
      const response = await fetch('/api/laboratory');
      const data = await response.json();

      setLaboratory(data.laboratory);
      setPatientTests(data.patientTests);
    };

    fetchLaboratoryData();
  }, []);

  return (
    <div>
      {laboratory && (
        <div>
          <h1>Laboratory: {laboratory.name}</h1>
          <table>
            <thead>
              <tr>
                <th>Test</th>
                <th>Patient</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              {patientTests.map((patientTest, index) => (
                <tr key={index}>
                  <td>{patientTest.test}</td>
                  <td>{patientTest.patient}</td>
                  <td>{patientTest.status}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      )}
      <a href="/laboratory">Back to Laboratories</a>
    </div>
  );
};

export default Laboratory;
