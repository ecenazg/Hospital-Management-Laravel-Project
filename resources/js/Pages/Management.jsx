import React, { useState } from 'react';
import { useForm } from 'react-hook-form';
import { Inertia } from '@inertiajs/inertia';
import Navbar from './Navbar';

const Management = () => {
  const { register, handleSubmit, formState: { errors } } = useForm();
  const [selectedStaff, setSelectedStaff] = useState('');

  const handleCreateDoctor = (data) => {
    Inertia.post('/create-doctor', data); // Assuming you have a route '/create-doctor' in your backend to handle the creation of a doctor record
  };

  const handleCreateNurse = (data) => {
    Inertia.post('/create-nurse', data); // Assuming you have a route '/create-nurse' in your backend to handle the creation of a nurse record
  };

  const handleCreatePatient = (data) => {
    Inertia.post('/create-patient', data); // Assuming you have a route '/create-patient' in your backend to handle the creation of a patient record
  };

  const handleSelectionChange = (e) => {
    setSelectedStaff(e.target.value);
  };

  return (
    <div>
      <Navbar />
      <h1>Management</h1>

      <div className="flex">
        <div className="w-full">
          <div className="md:col-span-5">
            <select className="select select-bordered w-full max-w-xs" value={selectedStaff} onChange={handleSelectionChange}>
              <option disabled value="">Which staff do you want to add employees to?</option>
              <option value="doctors">Doctors</option>
              <option value="nurses">Nurses</option>
              <option value="patients">Patients</option>
            </select>
          </div>
          {selectedStaff === 'doctors' && (
            <div className="w-1/3">
              <h2>Create Doctor</h2>
              <div className="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <form onSubmit={handleSubmit(handleCreateDoctor)}>
                  <div className="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    <div className="md:col-span-5">
                      <label htmlFor="doctor_name">Name:</label>
                      <input type="text" {...register('doctor_name', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.doctor_name && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <label htmlFor="doctor_email">Email:</label>
                      <input type="text" {...register('doctor_email', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.doctor_email && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <label htmlFor="specialization">Specialization:</label>
                      <input type="text" {...register('specialization', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.specialization && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <button type="submit" className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Doctor</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          )}
          {selectedStaff === 'nurses' && (
            <div className="w-1/3">
              <h2>Create Nurse</h2>
              <div className="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <form onSubmit={handleSubmit(handleCreateNurse)}>
                  <div className="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    <div className="md:col-span-5">
                      <label htmlFor="nurse_name">Name:</label>
                      <input type="text" {...register('nurse_name', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.nurse_name && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <label htmlFor="nurse_email">Email:</label>
                      <input type="text" {...register('nurse_email', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.nurse_email && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <label htmlFor="department">Department:</label>
                      <input type="text" {...register('department', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.department && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <button type="submit" className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Nurse</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          )}
          {selectedStaff === 'patients' && (
            <div className="w-1/3">
              <h2>Create Patient</h2>
              <div className="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <form onSubmit={handleSubmit(handleCreatePatient)}>
                  <div className="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    <div className="md:col-span-5">
                      <label htmlFor="patient_name">Name:</label>
                      <input type="text" {...register('patient_name', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.patient_name && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <label htmlFor="patient_email">Email:</label>
                      <input type="text" {...register('patient_email', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.patient_email && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <label htmlFor="phone_number">Phone Number:</label>
                      <input type="text" {...register('phone_number', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.phone_number && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <button type="submit" className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Patient</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default Management;
