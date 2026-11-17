@extends('layouts.app')

@section('title', 'Отделения')

@section('content')
<div class="container">
    <h2>Отделения</h2>

    @foreach($departments as $department)
        <div class="card" style="margin-bottom: rem; padding: 2rem;">
            <h3>{{ $department->icon }} {{ $department->name }}</h3>
            <p>{{ $department->description }}</p>

            <a href="{{ route('patient.doctors', $department) }}" class="btn btn-secondary" >
                Посмотреть врачей
            </a>
        </div>

        @php $avg = $department->averageRating(); @endphp
        <div style="color: #f59e0b;">
            @for($i = 1; $i <= 5; $i++)
                {{ $i <= round($avg) ? '★' : '☆' }}
            @endfor
            <span style="color: #6b7280; font-size: .85rem;">
                {{ $avg > 0 ? $avg : 'Нет отзывов' }}
            </span>
        </div>
    @endforeach
</div>
@endsection