@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 500px; padding: 3rem 0;">
    <div class="card" style="padding: 2.5rem;">
        <h2 style="font-family: 'Playfair Display', serif; margin-bottom: 1.5rem; text-align: center;">Join MediCore</h2>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            @if($errors->any())
                <div class="flash flash-error" style="margin-bottom: 1rem;">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="form-group">
                <label>Имя</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="John Doe">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="john@example.com">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Повторите пароль</label>
                    <input type="password" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <label>Номер</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+123456789">
            </div>

            <div class="form-group">
                <label>День рождения</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
            </div>

            <div class="form-group">
                <label>Пол</label>
                <select name="gender">
                    <option value="">— Select —</option>
                    <option value="male"   {{ old('gender') === 'male'   ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other"  {{ old('gender') === 'other'  ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label>Адрес</label>
                <input type="text" name="address" value="{{ old('address') }}" placeholder="123 Main St, City">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 1rem;">
                Создать аккаунт пациента
            </button>
        </form>
    </div>
</div>
@endsection