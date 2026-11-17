@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="container">
        <div class="breadcrumb">Portal / Dashboard</div>
        <h1>Здраствуйте, {{ Auth::guard('patient')->user()->name }}</h1>
    </div>
</div>

<div class="container" style="margin-top: -2rem; margin-bottom: 4rem;">
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        
        {{-- Left: Appointments --}}
        <div class="card" style="padding: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3 style="font-family: 'Playfair Display', serif;">Ваши заявки:</h3>
                <a href="{{ route('patient.departments') }}" class="btn btn-sm btn-outline">Бронировать</a>
            </div>
            @if($appointments->isEmpty())
    <p style="color: var(--muted); text-align: center; padding: 2rem 0;">
        Не найдено.
    </p>
@else
    @foreach($appointments as $appointment)
        <div class="card" style="margin-bottom: 1rem; padding: 1rem;">
            
            <p><strong>Врач:</strong> {{ $appointment->doctor->name }}</p>
            <p><strong>Отдел:</strong> {{ $appointment->department->name }}</p>

            <p><strong>Дата:</strong> {{ $appointment->appointment_date->format('d.m.Y') }}</p>
            <p><strong>Время:</strong> {{ $appointment->formatted_time }}</p>

            <p>
                <strong>Номер:</strong> {{ $appointment->appointment_number }}
            </p>

            <p style="margin-top: .5rem; font-weight: 600;
                color:
                {{ $appointment->status === 'completed' ? '#16a34a' :
                   ($appointment->status === 'cancelled' ? '#dc2626' : '#2563eb') }}">
                
                @if($appointment->status === 'completed')
                    Завершено
                @elseif($appointment->status === 'cancelled')
                    Отменено
                @else
                    В ожидании
                @endif
            </p>

        </div>
    @endforeach
@endif
            <p style="color: var(--muted); text-align: center; padding: 2rem 0;">Не найдено.</p>
        </div>

        {{-- Right: Profile Sidebar --}}
        <div class="card" style="padding: 2rem; align-self: start;">
            <h4 style="margin-bottom: 1rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem;">Детали</h4>
            <p style="font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Почта:</strong> {{ Auth::guard('patient')->user()->email }}</p>
            <p style="font-size: 0.9rem;"><strong>Телефон:</strong> {{ Auth::guard('patient')->user()->phone ?? 'Not set' }}</p>
        </div>

    </div>
</div>
@endsection