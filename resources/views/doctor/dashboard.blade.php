@extends('layouts.app')

@section('title', 'Панель врача')

@section('content')
<div class="container">
    <h2>Пациенты и записи</h2>

    @foreach($appointments as $appointment)
    <div class="card" style="margin-bottom: 1rem; padding: 1rem;">
        <p><strong>Пациент:</strong> {{ $appointment->patient->name }}</p>
        <p><strong>Дата:</strong> {{ $appointment->appointment_date->format('d.m.Y') }}</p>
        <p><strong>Время:</strong> {{ substr($appointment->appointment_time, 0, 5) }}</p>

        @if($appointment->status !== 'cancelled' && $appointment->status !== 'completed')
            <form method="POST" action="{{ route('doctor.appointment.status', $appointment) }}" style="display: flex; gap: .5rem; margin-top: .75rem;">
                @csrf
                @method('PATCH')
                <button type="submit" name="status" value="completed" class="btn btn-primary btn-sm">✔ Завершено</button>
                <button type="submit" name="status" value="cancelled" class="btn btn-danger btn-sm">✗ Отменить</button>
            </form>
        @else
            <p style="margin-top: .75rem; font-weight: 600; color: {{ $appointment->status === 'completed' ? '#16a34a' : '#dc2626' }}">
                {{ $appointment->status === 'completed' ? '✔ Завершено' : '✗ Отменено' }}
            </p>
        @endif
    </div>
@endforeach
</div>
@endsection