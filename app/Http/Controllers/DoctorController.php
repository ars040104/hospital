<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function dashboard(Request $request)
    {
        $doctor = Auth::guard('doctor')->user();

        $query = $doctor->appointments()->with(['patient', 'department']);

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $appointments = $query->orderBy('appointment_date')
                              ->orderBy('appointment_time')
                              ->paginate(15);

        $todayCount = $doctor->appointments()
                             ->whereDate('appointment_date', today())
                             ->whereIn('status', ['pending', 'confirmed'])
                             ->count();

        $pendingCount = $doctor->appointments()
                               ->where('status', 'pending')
                               ->count();

        return view('doctor.dashboard', compact(
            'doctor', 'appointments', 'todayCount', 'pendingCount'
        ));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate(['status' => 'required|in:confirmed,cancelled,completed']);

        // Ensure this appointment belongs to the auth doctor
        if ($appointment->doctor_id !== Auth::guard('doctor')->id()) {
            abort(403);
        }

        $appointment->update(['status' => $request->status]);

        return back()->with('success', 'Appointment status updated.');
    }
}