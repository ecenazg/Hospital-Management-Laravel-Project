import React, { useState } from 'react';
import { useForm } from 'react-hook-form';
import { Inertia } from '@inertiajs/inertia';
import Navbar from './Navbar';

const Management = () => {
  const { register, handleSubmit, formState: { errors } } = useForm();
  const [selectedStaff, setSelectedStaff] = useState('');
  const [successMessage, setSuccessMessage] = useState('');

  const handleCreateDoctor = async (data) => {
    try {
      await Inertia.post('/create-doctor', data);
      setSuccessMessage('Doctor created successfully.');
    } catch (error) {
      console.error(error);
      setSuccessMessage('Failed to create doctor.');
    }
  };

  const handleCreateNurse = async (data) => {
    try {
      await Inertia.post('/create-nurse', data);
      setSuccessMessage('Nurse created successfully.');
    } catch (error) {
      console.error(error);
      setSuccessMessage('Failed to create nurse.');
    }
  };

  const handleCreatePatient = async (data) => {
    try {
      await Inertia.post('/create-patient', data);
      setSuccessMessage('Patient created successfully.');
    } catch (error) {
      console.error(error);
      setSuccessMessage('Failed to create patient.');
    }
  };

  const handleSelectionChange = (e) => {
    setSelectedStaff(e.target.value);
    setSuccessMessage(''); // Clear success message when staff selection changes
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
                      <label htmlFor="name">Name:</label>
                      <input type="text" {...register('name', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.name && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <label htmlFor="email">Email:</label>
                      <input type="text" {...register('email', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.email && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <label htmlFor="specialization">Specialization:</label>
                      <input type="text" {...register('specialization', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.specialization && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <label htmlFor="department_name">Department Name:</label>
                      <input type="text" {...register('department_name', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.department_name && <span>This field is required</span>}
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
                      <label htmlFor="name">Name:</label>
                      <input type="text" {...register('name', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.name && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <label htmlFor="email">Email:</label>
                      <input type="text" {...register('email', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.email && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <label htmlFor="department_name">Department Name:</label>
                      <input type="text" {...register('department_name', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.department_name && <span>This field is required</span>}
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
                      <label htmlFor="name">Name:</label>
                      <input type="text" {...register('name', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.name && <span>This field is required</span>}
                    </div>
                    <div className="md:col-span-5">
                      <label htmlFor="email">Email:</label>
                      <input type="text" {...register('email', { required: true })} className="input input-bordered input-primary rounded-lg" />
                      {errors.email && <span>This field is required</span>}
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

      {successMessage && (
        <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
          <span className="block sm:inline">{successMessage}</span>
        </div>
      )}
    </div>
  );
};

export default Management;
