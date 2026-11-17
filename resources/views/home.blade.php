@extends('layouts.app')

@section('title', 'Добро пожаловать в больницу MediCore')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Учебный проект</h1>
        <p>Запись к доктору.</p>
        <div style="margin-top: 2rem; display: flex; gap: 1rem;">
            <a href="{{ route('patient.departments') }}" class="btn btn-primary">Записаться на приём</a>
            <a href="{{ route('doctor.login') }}" class="btn btn-outline" style="border-color: white; color: white;">Портал врача</a>
        </div>
    </div>
</div>

<div style="font-size: 1.2rem; color: #f59e0b; padding-left: 120px">
    @for($i = 1; $i <= 5; $i++)
        {{ $i <= round($hospitalRating) ? '★' : '☆' }}
    @endfor
    <span style="color: #6b7280; font-size: .9rem; padding-left: 20px">
        {{ $hospitalRating > 0 ? $hospitalRating . '/5 (' . $totalReviews . ' отзывов)' : 'Отзывов пока нет' }}
    </span>
</div>


@endsection