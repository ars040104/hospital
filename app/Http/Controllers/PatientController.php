<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function dashboard()
    {
        $patient      = Auth::guard('patient')->user();
        $appointments = $patient->appointments()
                                ->with(['doctor', 'department'])
                                ->latest()
                                ->get();

        return view('patient.dashboard', compact('patient', 'appointments'));
    }

    public function departments()
    {
        $departments = Department::withCount('doctors')->get();
        return view('patient.departments', compact('departments'));
    }

    public function doctors(Department $department)
    {
        $doctors = $department->doctors()->get();
        return view('patient.doctors', compact('department', 'doctors'));
    }

    public function bookForm(Doctor $doctor, Request $request)
    {
        $date   = $request->get('date', now()->addDay()->toDateString());
        $booked = $doctor->bookedTimesForDate($date);

        // Generate time slots 08:00 – 17:30 every 30 min
        $slots = [];
        $start = strtotime('08:00');
        $end   = strtotime('17:30');
        while ($start <= $end) {
            $slots[] = date('H:i', $start);
            $start   += 1800;
        }

        $minDate = now()->addDay()->toDateString();
        $maxDate = now()->addDays(30)->toDateString();

        return view('patient.book', compact('doctor', 'date', 'booked', 'slots', 'minDate', 'maxDate'));
    }

    public function book(Request $request, Doctor $doctor)
    {
        $request->validate([
            'date' => 'required|date|after:today',
            'time' => 'required|date_format:H:i',
        ]);

        // Check slot is still free
        $exists = Appointment::where('doctor_id', $doctor->id)
                              ->where('appointment_date', $request->date)
                              ->where('appointment_time', $request->time . ':00')
                              ->whereIn('status', ['pending', 'confirmed'])
                              ->exists();

        if ($exists) {
            return back()->withErrors(['time' => 'This slot was just taken. Please choose another.']);
        }

        $appointment = Appointment::create([
            'patient_id'       => Auth::guard('patient')->id(),
            'doctor_id'        => $doctor->id,
            'department_id'    => $doctor->department_id,
            'appointment_date' => $request->date,
            'appointment_time' => $request->time . ':00',
            'status'           => 'pending',
            'appointment_number' => Appointment::generateNumber(),
        ]);

        return redirect()->route('patient.appointment', $appointment->id);
    }

    public function appointment(Appointment $appointment)
    {
        // Ensure the patient owns this appointment
        if ($appointment->patient_id !== Auth::guard('patient')->id()) {
            abort(403);
        }

        $appointment->load(['doctor.department', 'patient', 'department']);
        return view('patient.appointment', compact('appointment'));
    }
}