@extends('layouts.app')

@section('title', 'Врачи')

@section('content')
<div class="container">
    <h2>Врачи</h2>

    @foreach($doctors as $doctor)
        <div class="card" style="margin-bottom: 1rem; padding: 1rem;">
            <h3>{{ $doctor->name }}</h3>
            <p><strong>Специализация:</strong> {{ $doctor->specialization }}</p>
            <p>{{ $doctor->bio }}</p>

            <a href="{{ route('patient.book.form', $doctor) }}" class="btn btn-primary">
                Записаться
            </a>
        </div>

        @php $avg = $doctor->averageRating(); $count = $doctor->reviewCount(); @endphp
        <div style="color: #f59e0b; font-size: 1.1rem;">
            @for($i = 1; $i <= 5; $i++)
                {{ $i <= round($avg) ? '★' : '☆' }}
            @endfor
            <span style="color: #6b7280; font-size: .85rem; margin-left: .3rem;">
                {{ $avg > 0 ? $avg . ' (' . $count . ' отзывов)' : 'Нет отзывов' }}
            </span>
        </div>
    @endforeach
</div>
@endsection