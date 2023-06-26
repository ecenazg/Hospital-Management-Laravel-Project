import React from 'react';
import { useForm } from 'react-hook-form';
import { Inertia } from '@inertiajs/inertia';

const Management = () => {
  const { register, handleSubmit, formState: { errors } } = useForm();

  const handleCreateDoctor = (data) => {
    Inertia.post('/create-doctor', data);
  };

  const handleCreateNurse = (data) => {
    Inertia.post('/create-nurse', data);
  };

  const handleCreatePatient = (data) => {
    Inertia.post('/create-patient', data);
  };

  return (
    <div>
      <h1>Management</h1>

      <h2>Create Doctor</h2>
      <form onSubmit={handleSubmit(handleCreateDoctor)}>
        <div>
          <label>Name:</label>
          <input type="text" {...register('name', { required: true })} />
          {errors.name && <span>This field is required</span>}
        </div>
        <div>
          <label>Email:</label>
          <input type="text" {...register('email', { required: true })} />
          {errors.email && <span>This field is required</span>}
        </div>
        <div>
          <label>Specialization:</label>
          <input type="text" {...register('specialization', { required: true })} />
          {errors.specialization && <span>This field is required</span>}
        </div>
        <button type="submit">Create Doctor</button>
      </form>

      <h2>Create Nurse</h2>
      <form onSubmit={handleSubmit(handleCreateNurse)}>
        <div>
          <label>Name:</label>
          <input type="text" {...register('name', { required: true })} />
          {errors.name && <span>This field is required</span>}
        </div>
        <div>
          <label>Email:</label>
          <input type="text" {...register('email', { required: true })} />
          {errors.email && <span>This field is required</span>}
        </div>
        <div>
          <label>Department:</label>
          <input type="text" {...register('department', { required: true })} />
          {errors.department && <span>This field is required</span>}
        </div>
        <button type="submit">Create Nurse</button>
      </form>

      <h2>Create Patient</h2>
      <form onSubmit={handleSubmit(handleCreatePatient)}>
        <div>
          <label>Name:</label>
          <input type="text" {...register('name', { required: true })} />
          {errors.name && <span>This field is required</span>}
        </div>
        <div>
          <label>Email:</label>
          <input type="text" {...register('email', { required: true })} />
          {errors.email && <span>This field is required</span>}
        </div>
        <div>
          <label>Illness:</label>
          <input type="text" {...register('illness', { required: true })} />
          {errors.illness && <span>This field is required</span>}
        </div>
        <button type="submit">Create Patient</button>
      </form>
    </div>
  );
};

export default Management;
