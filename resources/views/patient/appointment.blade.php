@extends('layouts.app')

@section('title', 'Запись')

@section('content')
<div class="container">
    <h2>Детали записи</h2>

    <p><strong>Врач:</strong> {{ $appointment->doctor->name }}</p>
    <p><strong>Дата:</strong> {{ $appointment->appointment_date->format('d.m.Y') }}</p>
    <p><strong>Время:</strong> {{ substr($appointment->appointment_time, 0, 5) }}</p>
    <p>Ваша запись подтверждена! Ждём вас в назначенное время.</p>
</div>

@if($appointment->status === 'completed')
    @if($appointment->review)
        <div style="margin-top: 2rem; padding: 1.5rem; background: #f0fdf4; border-radius: 12px; border: 1px solid #86efac;">
            <h3 style="margin-bottom: .5rem;">Ваш отзыв</h3>
            <div style="color: #f59e0b; font-size: 1.4rem;">
                @for($i = 1; $i <= 5; $i++)
                    {{ $i <= $appointment->review->rating ? '★' : '☆' }}
                @endfor
            </div>
            @if($appointment->review->comment)
                <p style="margin-top: .5rem; color: #374151;">{{ $appointment->review->comment }}</p>
            @endif
        </div>
    @else
        <div style="margin-top: 2rem; padding: 1.5rem; background: #fff; border-radius: 12px; border: 1px solid #e5e7eb;">
            <h3 style="margin-bottom: 1rem;">Оценить врача</h3>
            <form method="POST" action="{{ route('review.store', $appointment) }}">
                @csrf

                {{-- Star rating --}}
                <div style="display: flex; gap: .3rem; flex-direction: row-reverse; justify-content: flex-end; margin-bottom: 1rem;">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}"
                               style="display:none">
                        <label for="star{{ $i }}" style="font-size: 2rem; cursor: pointer; color: #d1d5db;"
                               onmouseover="highlightStars({{ $i }})"
                               onmouseout="resetStars()"
                               onclick="selectStar({{ $i }})">★</label>
                    @endfor
                </div>

                <div class="form-group">
                    <label>Комментарий (необязательно)</label>
                    <textarea name="comment" rows="3" placeholder="Ваш отзыв о враче..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Отправить отзыв</button>
            </form>
        </div>
    @endif
@endif

@push('scripts')
<script>
    let selected = 0;
    const labels = document.querySelectorAll('label[for^="star"]');

    function highlightStars(n) {
        labels.forEach((l, i) => {
            l.style.color = (5 - i) <= n ? '#f59e0b' : '#d1d5db';
        });
    }

    function resetStars() {
        labels.forEach((l, i) => {
            l.style.color = (5 - i) <= selected ? '#f59e0b' : '#d1d5db';
        });
    }

    function selectStar(n) {
        selected = n;
        document.getElementById('star' + n).checked = true;
    }
</script>
@endpush
@endsection