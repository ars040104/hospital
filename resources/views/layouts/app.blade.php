<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MediCore Hospital')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
/* ── RESET ── */
*, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* ── COLORS ── */
:root {
    --primary: #2563eb;      /* blue */
    --primary-dark: #1e40af;
    --accent: #06b6d4;       /* cyan */
    --bg: #f8fafc;
    --card: #ffffff;
    --text: #0f172a;
    --muted: #64748b;
    --border: #e2e8f0;
    --success: #16a34a;
    --danger: #dc2626;
    --radius: 14px;
}

/* ── BODY ── */
body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* ── NAVBAR ── */
nav {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--border);
    padding: 0 5%;
    height: 70px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    position: sticky;
    top: 0;
    z-index: 1000;
}

.nav-logo {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    font-weight: 700;
    text-decoration: none;
    color: var(--text);
}

.nav-logo span {
    color: var(--primary);
}

/* LINKS */
.nav-links {
    display: flex;
    gap: 1.2rem;
    align-items: center;
}

.nav-links a {
    text-decoration: none;
    color: var(--muted);
    font-weight: 500;
    transition: 0.2s;
}

.nav-links a:hover {
    color: var(--primary);
}

/* BUTTON */
.nav-btn {
    background: var(--primary);
    color: white !important;
    padding: 0.5rem 1.2rem;
    border-radius: 8px;
}

.nav-btn:hover {
    background: var(--primary-dark);
}

/* ── CONTAINER ── */
.container {
    max-width: 1100px;
    margin: auto;
    padding: 0 1.5rem;
}

/* ── HEADER ── */
.page-header {
    padding: 3rem 0 2rem;
}

.page-header h1 {
    font-size: 2.4rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.page-header p {
    color: var(--muted);
}

/* ── CARD ── */
.card {
    background: var(--card);
    border-radius: var(--radius);
    padding: 1.8rem;
    border: 1px solid var(--border);
    box-shadow: 0 8px 20px rgba(0,0,0,0.04);
    transition: 0.2s;
}

.card:hover {
    transform: translateY(-4px);
}

/* ── BUTTONS ── */
.btn {
    padding: 0.7rem 1.5rem;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s;
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-dark);
}

.btn-outline {
    border: 2px solid var(--primary);
    color: var(--primary);
    background: transparent;
}

.btn-outline:hover {
    background: var(--primary);
    color: white;
}

/* ── FORMS ── */
.form-group {
    margin-bottom: 1.2rem;
}

.form-group label {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 0.4rem;
    display: block;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 0.7rem 1rem;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: #f9fafb;
}

.form-group input:focus {
    outline: none;
    border-color: var(--primary);
    background: white;
}

/* ── ALERTS ── */
.flash {
    padding: 0.9rem 1.2rem;
    border-radius: 8px;
    margin: 1rem 0;
}

.flash-success {
    background: #ecfdf5;
    color: #065f46;
}

.flash-error {
    background: #fef2f2;
    color: #7f1d1d;
}

/* ── FOOTER ── */
footer {
    margin-top: auto;
    text-align: center;
    padding: 2rem;
    color: var(--muted);
    font-size: 0.85rem;
}

/* ── MOBILE ── */
@media (max-width: 768px) {
    .nav-links {
        display: none;
    }
}
    </style>
</head>
<body>
<nav>
    <a href="{{ route('home') }}" class="nav-logo">Врач Урмат</span></a>
    <div class="nav-links">
        @auth('patient')
            <a href="{{ route('patient.dashboard') }}">Экран для пациента</a>
            <a href="{{ route('patient.departments') }}">Бронь приема</a>
            <form method="POST" action="{{ route('patient.logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn-sm" style="background:rgba(255,255,255,.1); color:#fff; border:none; cursor:pointer;">Выйти</button>
            </form>
        @elseauth('doctor')
            <a href="{{ route('doctor.dashboard') }}">Экран для доктора</a>
            <form method="POST" action="{{ route('doctor.logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn-sm" style="background:rgba(255,255,255,.1); color:#fff; border:none; cursor:pointer;">Выйти</button>
            </form>
        @else
            <a href="{{ route('login') }}">Вход</a>

            <a href="{{ route('register') }}" class="nav-btn">Регистрация</a>
        @endauth
    </div>
</nav>

<main>
    <div class="container">
        @if(session('success'))
            <div class="flash flash-success">✓ {{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="flash flash-error">
                <strong>Please fix the following:</strong>
                <ul style="margin-top: 0.5rem; margin-left: 1.2rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    @yield('content')
</main>

<footer>
    <p>© {{ date('Y') }} Omurkulov Urmat. PHP. Laravel</p>
</footer>
</body>
</html>