<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'departments' => Department::count(),
            'doctors'     => Doctor::count(),
            'patients'    => \App\Models\Patient::count(),
        ];

        $departments    = Department::take(5)->get();
        $hospitalRating = round(\App\Models\Review::avg('rating') ?? 0, 1);
        $totalReviews   = \App\Models\Review::count();

        return view('home', compact('stats', 'departments', 'hospitalRating', 'totalReviews'));
    }
}