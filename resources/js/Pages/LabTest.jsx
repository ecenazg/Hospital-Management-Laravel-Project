import React from "react";
import Navbar from "./Navbar";
const LabTest = ({ labTest, bloodResults }) => {
    return (
        <div>
            <Navbar />
            <h1>Lab Test: {labTest.name}</h1>
            <h2>Lab Test Result</h2>
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Patient Value</th>
                        <th>Reference Interval</th>
                    </tr>
                </thead>
                <tbody>
                    {bloodResults.map((result) => (
                        <tr key={result.id}>
                            <td>{result.name}</td>
                            <td>{labTest.percentage}</td>
                            <td>
                                {result.min} - {result.max}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default LabTest;
