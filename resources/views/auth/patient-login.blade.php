@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 450px; padding: 5rem 0;">
    <div class="card" style="padding: 2.5rem;">
        <h2 style="font-family: 'Playfair Display', serif; margin-bottom: 0.5rem; text-align: center;">Patient Login</h2>
        <p style="text-align: center; color: var(--muted); margin-bottom: 2rem; font-size: 0.9rem;">Access your medical dashboard</p>
        
        <form action="{{ route('patient.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 1rem;">
                Sign In
            </button>
        </form>
    </div>
</div>
@endsection