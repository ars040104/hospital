@extends('layouts.app')

@section('title', 'Запись')

@section('content')
<div class="container" style="max-width: 500px;">
    <h2>Запись к врачу: {{ $doctor->name }}</h2>

    <form method="POST" action="{{ route('patient.book', $doctor) }}">
        @csrf

        <div class="form-group">
            <label>Дата:</label>
            <input type="date" name="date" value="{{ $date }}"
                   min="{{ $minDate }}" max="{{ $maxDate }}"
                   required class="form-control"
                   onchange="this.form.submit()">
        </div>

        <div class="form-group">
            <label>Выберите время:</label>
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: .5rem; margin-top: .5rem;">
                @foreach($slots as $slot)
                    @php $taken = in_array($slot, $booked); @endphp
                    <label style="
                        text-align: center;
                        padding: .6rem .3rem;
                        border-radius: 8px;
                        border: 2px solid {{ $taken ? '#e5e7eb' : '#0d9488' }};
                        background: {{ $taken ? '#f3f4f6' : '#fff' }};
                        color: {{ $taken ? '#9ca3af' : '#0d9488' }};
                        cursor: {{ $taken ? 'not-allowed' : 'pointer' }};
                        font-weight: 600;
                        font-size: .85rem;
                        position: relative;
                    ">
                        <input type="radio" name="time" value="{{ $slot }}"
                               {{ $taken ? 'disabled' : '' }}
                               required
                               style="display:none"
                               onchange="document.querySelectorAll('.slot-label').forEach(l => l.style.background = ''); this.parentElement.style.background = '#0d9488'; this.parentElement.style.color = '#fff';">
                        {{ $slot }}
                        @if($taken)
                            <span style="display:block; font-size:.7rem; color:#9ca3af;">Занято</span>
                        @endif
                    </label>
                @endforeach
            </div>
            @error('time')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <button class="btn btn-primary" style="margin-top: 1rem; width: 100%;">Записаться</button>
    </form>
</div>
@endsection