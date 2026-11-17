<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Appointment $appointment)
    {
        // Make sure patient owns this appointment
        if ($appointment->patient_id !== Auth::guard('patient')->id()) {
            abort(403);
        }

        // Only allow review if appointment is completed
        if ($appointment->status !== 'completed') {
            return back()->with('error', 'Вы можете оставить отзыв только после завершения приёма.');
        }

        // Prevent duplicate review
        if ($appointment->review) {
            return back()->with('error', 'Вы уже оставили отзыв для этой записи.');
        }

        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'appointment_id' => $appointment->id,
            'patient_id'     => $appointment->patient_id,
            'doctor_id'      => $appointment->doctor_id,
            'department_id'  => $appointment->department_id,
            'rating'         => $request->rating,
            'comment'        => $request->comment,
        ]);

        return back()->with('success', 'Спасибо за ваш отзыв!');
    }
}