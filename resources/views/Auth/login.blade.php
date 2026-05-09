<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login | Gym Membership System</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f1f5f9;
        }

        /* =========================
           LEFT SIDE
        ==========================*/
        .left-panel {
            width: 55%;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 70px;
            background:
                linear-gradient(rgba(7, 15, 30, 0.82),
                    rgba(7, 15, 30, 0.88)),
                url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        /* Overlay Grid Elegant */
        .left-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .left-content {
            position: relative;
            z-index: 2;
            max-width: 560px;
            color: white;
        }

        .badge-system {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            font-size: 14px;
            margin-bottom: 28px;
            backdrop-filter: blur(10px);
        }

        .left-content h1 {
            font-size: 52px;
            font-weight: 700;
            line-height: 1.15;
            margin-bottom: 24px;
        }

        .left-content h1 span {
            color: #f59e0b;
        }

        .left-content p {
            font-size: 17px;
            line-height: 1.9;
            color: rgba(255, 255, 255, 0.85);
        }

        .feature-list {
            margin-top: 40px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            font-size: 15px;
            color: rgba(255, 255, 255, 0.92);
        }

        .feature-item i {
            margin-right: 12px;
            color: #f59e0b;
            font-size: 18px;
        }

        /* =========================
           RIGHT SIDE
        ==========================*/
        .right-panel {
            width: 45%;
            position: relative;
            background:
                linear-gradient(135deg,
                    #f8fafc 0%,
                    #ffffff 45%,
                    #f1f5f9 100%);

            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;

            overflow: hidden;
        }

        .right-panel::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom,
                    rgba(245, 158, 11, 0.15),
                    rgba(255, 255, 255, 0.3),
                    rgba(245, 158, 11, 0.15));
        }

        .right-panel::after {
            content: '';
            position: absolute;
            width: 320px;
            height: 320px;
            background: rgba(245, 158, 11, 0.05);

            border-radius: 50%;

            top: -120px;
            right: -120px;

            filter: blur(10px);
        }

        .login-box {
            width: 100%;
            max-width: 420px;

            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(18px);

            border: 1px solid rgba(255, 255, 255, 0.6);

            border-radius: 28px;

            padding: 40px;

            box-shadow: 0 10px 40px rgba(15, 23, 42, 0.08);
        }

        /* Logo */
        .logo-wrapper {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-wrapper img {
            width: 92px;
            height: 92px;
            object-fit: contain;
            margin-bottom: 18px;

            padding: 10px;

            border-radius: 24px;

            background: rgba(255, 255, 255, 0.65);

            backdrop-filter: blur(10px);

            box-shadow:
                0 8px 24px rgba(15, 23, 42, 0.08);

            transition: all 0.3s ease;
        }

        .logo-wrapper h2 {
            font-size: 30px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .logo-wrapper p {
            color: #64748b;
            font-size: 14px;
        }

        .logo-wrapper img:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
        }

        /* Form */
        .form-title {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .form-subtitle {
            color: #64748b;
            margin-bottom: 30px;
            border-left: 4px solid #f59e0b;
            padding-left: 14px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            height: 54px;
            border-radius: 14px;
            border: 1px solid #dbe2ea;
            padding-left: 48px;
            padding-right: 15px;
            font-size: 15px;
            transition: all 0.25s ease;
            background: #f8fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: #f59e0b;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.12);
        }

        /* Remember */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #475569;
        }

        .remember-me input {
            accent-color: #f59e0b;
        }

        /* Button */
        .btn-login {
            width: 100%;
            height: 54px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.25);
        }

        /* Alerts */
        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border-left: 4px solid #22c55e;
        }

        /* Footer */
        .login-footer {
            margin-top: 35px;
            text-align: center;
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
        }

        /* Responsive */
        @media (max-width: 992px) {

            body {
                flex-direction: column;
            }

            .left-panel,
            .right-panel {
                width: 100%;
            }

            .left-panel {
                min-height: 380px;
                padding: 40px;
            }

            .left-content h1 {
                font-size: 36px;
            }
        }

        @media (max-width: 576px) {

            .left-panel {
                padding: 30px;
            }

            .right-panel {
                padding: 24px;
            }

            .left-content h1 {
                font-size: 30px;
            }
        }
    </style>
</head>

<body>

    <!-- LEFT -->
    <div class="left-panel">

        <div class="left-content">

            <div class="badge-system">
                Gym Management System
            </div>

            <h1>
                Transform Your
                <span>Fitness Journey</span>
            </h1>

            <p> Sistem Manajemen Gym Modern untuk Pengelolaan Data Member,
                Membership, Transaksi, Jadwal Latihan, serta Monitoring
                Aktivitas Kebugaran secara Profesional, Aman, dan Terintegrasi.
            </p>

            <div class="feature-list">

                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    Manajemen Membership, Paket, Infrastruktur, Alat dan Jadwal
                </div>

                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    Monitoring Transaksi dan Pembayaran
                </div>

            </div>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="right-panel">

        <div class="login-box">

            <!-- Logo -->
            <div class="logo-wrapper">

                <img src="{{ asset('images/foto logo.png') }}" alt="Logo Gym">

                <h2>GYM Membership</h2>

                <p>
                    Sistem Informasi Manajemen Gym
                </p>

            </div>

            <div class="form-title">
                Selamat Datang
            </div>

            <div class="form-subtitle">
                Silakan login menggunakan akun Anda
            </div>

            <!-- Alert -->
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login.post') }}">

                @csrf

                <!-- Email -->
                <div class="form-group">

                    <label>Email</label>

                    <div class="input-wrapper">

                        <i class="bi bi-envelope"></i>

                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email"
                            required>

                    </div>

                    @error('email')
                        <small style="color:red;">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <!-- Password -->
                <div class="form-group">

                    <label>Password</label>

                    <div class="input-wrapper">

                        <i class="bi bi-lock"></i>

                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password"
                            required>

                    </div>

                    @error('password')
                        <small style="color:red;">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <!-- Remember -->
                <div class="form-options">

                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        Ingat Saya
                    </label>

                </div>

                <!-- Button -->
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login
                </button>

            </form>

            <!-- Footer -->
            <div class="login-footer">

                © 2026 Gym Membership System
                <br>
                Professional Fitness Management Platform

            </div>

        </div>

    </div>

</body>

</html>