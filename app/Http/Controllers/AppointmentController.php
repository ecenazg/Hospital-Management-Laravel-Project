<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctors;
use App\Models\Patients;
use App\Models\TimeSchedule;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /*public function getAppointmentsByDate(Request $request)   
    {
        if ($request->date) {
            $appointments = Appointment::where('date', $request->date)->get();
            $json = $appointments->toJson();
        }
        return response()->json(['html' => $json]);
    }*/

    public function getDoctorsByDepartment(Request $request)
    {
        if ($request->id) {
            $html = '<option value="">Please Select Doctor</option>';
            $department = Department::find($request->id);
            $doctors = $department->doctors;
            foreach ($doctors as $doctor) {
                $html .= '<option value="' . $doctor->id . '">' . $doctor->name . '</option>';
            }
        }
        return response()->json(['html' => $html]);
    }

    public function index()
    {
        Appointment::where('status', 'confirmed')
            ->where('date', '<', now())
            ->update(['status' => 'Treated']);

        Appointment::where('status', 'pending')
            ->where('date', '<', now())
            ->update(['status' => 'cancelled']);

        $pendingAppointments = Appointment::where('status', 'pending')->get();
        $confirmedAppointments = Appointment::where('status', 'confirmed')->get();
        $cancelledAppointments = Appointment::where('status', 'cancelled')->get();
        $treatedAppointments = Appointment::where('status', 'Treated')->get();
        $appointments = Appointment::all();

        return view('appointments.list', compact('pendingAppointments', 'confirmedAppointments', 'cancelledAppointments', 'treatedAppointments', 'appointments'));
    }

    public function create()
    {
        return view('appointments.create')
            ->with('doctors', Doctors::all())
            ->with('patients', Patients::all())
            ->with('departments', Department::all())
            ->with('timeschedules', TimeSchedule::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient' => 'required_without:first_name,last_name',
            'name' => 'required_without:patient',
        
            'doctor' => 'required',
            'department' => 'required',
            'date' => 'required',
            'timeSlots' => 'required',
            'status' => 'required',
        ]);

        if ($request->patient != 0) {
            $patient = Patients::find($request->patient);
        } else {
            $patient = Patients::create([
                'name' => $request->name,
                'email' => 'default@clinic.com',
            ]);
        }

        $appointment = new Appointment;
        $appointment->patient_id = $patient->id;
        $appointment->doctor_id = $request->doctor;
        $appointment->department_id = $request->department;
        $appointment->date = $request->date;
        $appointment->time = $request->timeSlots;
        $appointment->status = $request->status;
        $appointment->notes = $request->notes;
        $appointment->save();

        // Flash message
        session()->flash('success', 'New Appointment Added Successfully.');

        return redirect(route('appointments.index'));
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        return view('appointments.create')
            ->with('doctors', Doctors::all())
            ->with('patients', Patients::all())
            ->with('departments', Department::all())
            ->with('timeschedules', TimeSchedule::all())
            ->with('appointment', $appointment);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'doctor' => 'required',
            'department' => 'required',
            'date' => 'required',
            'timeSlots' => 'required',
            'status' => 'required',
        ]);

        $appointment->patient_id = $request->patient;
        $appointment->doctor_id = $request->doctor;
        $appointment->department_id = $request->department;
        $appointment->date = $request->date;
        $appointment->time = $request->timeSlots;
        $appointment->status = $request->status;
        $appointment->notes = $request->notes;
        $appointment->save();

        // Flash message
        session()->flash('success', 'Appointment Updated Successfully.');

        return redirect(route('appointments.index'));
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        // Flash message
        session()->flash('success', 'Appointment Deleted Successfully.');

        return redirect(route('appointments.index'));
    }

    public function createAppointmentForDoctor(Doctors $doctor)
    {
        return view('appointments.create', compact('doctor'));
    }

    public function appointmentsForDoctor(Doctors $doctor)
    {
        return view('appointments.list', compact('doctor'));
    }
}
?>