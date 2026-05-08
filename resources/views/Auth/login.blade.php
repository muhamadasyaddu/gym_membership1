<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Gym Membership</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', 'Montserrat', sans-serif;
            min-height: 100vh;
            background: linear-gradient(112deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            position: relative;
            overflow-x: hidden;
        }
        
        /* Decorative Background Elements */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            background-repeat: repeat;
            opacity: 0.5;
            pointer-events: none;
        }
        
        /* Animated Gradient Orbs */
        .orb-1 {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(59,130,246,0.3) 0%, rgba(59,130,246,0) 70%);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite;
        }
        
        .orb-2 {
            position: absolute;
            bottom: -150px;
            left: -150px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(139,92,246,0.25) 0%, rgba(139,92,246,0) 70%);
            border-radius: 50%;
            animation: float 25s ease-in-out infinite reverse;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -30px) scale(1.05); }
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            z-index: 10;
        }
        
        .login-card {
            max-width: 480px;
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            backdrop-filter: blur(0px);
        }
        
        /* Brand Section */
        .brand-section {
            background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
            padding: 2rem;
            text-align: center;
            position: relative;
        }
        
        .brand-section::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 40px;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 50% 50% 0 0;
        }
        
        .logo-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }
        
        .logo-icon i {
            font-size: 2.5rem;
            color: white;
        }
        
        .brand-section h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            margin: 0;
            letter-spacing: -0.5px;
        }
        
        .brand-section p {
            color: rgba(255, 255, 255, 0.85);
            margin: 0.5rem 0 0;
            font-size: 0.85rem;
        }
        
        /* Form Section */
        .form-section {
            padding: 2.5rem;
        }
        
        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .form-subtitle {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 1.8rem;
            border-left: 3px solid #3b82f6;
            padding-left: 1rem;
        }
        
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #334155;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .input-group {
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            transition: all 0.2s ease;
            background: #ffffff;
        }
        
        .input-group:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
        }
        
        .input-group-text {
            background: transparent;
            border: none;
            color: #94a3b8;
            padding-left: 1rem;
            padding-right: 0.5rem;
        }
        
        .form-control {
            border: none;
            padding: 0.9rem 1rem 0.9rem 0;
            font-size: 1rem;
            background: transparent;
        }
        
        .form-control:focus {
            box-shadow: none;
            outline: none;
        }
        
        /* Remember Me & Forgot Password */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1rem 0 1.5rem;
        }
        
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #475569;
            cursor: pointer;
        }
        
        .checkbox-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            margin: 0;
            accent-color: #3b82f6;
        }
        
        .forgot-link {
            font-size: 0.85rem;
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }
        
        .forgot-link:hover {
            text-decoration: underline;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
            border: none;
            border-radius: 12px;
            padding: 0.9rem;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
        }
        
        /* Demo Credentials */
        .demo-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1rem;
            border: 1px solid #e2e8f0;
        }
        
        .demo-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .demo-title i {
            font-size: 0.9rem;
        }
        
        .demo-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .demo-row:last-child {
            border-bottom: none;
        }
        
        .demo-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #475569;
        }
        
        .demo-value {
            font-family: monospace;
            font-size: 0.85rem;
            background: #ffffff;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            color: #2563eb;
            border: 1px solid #e2e8f0;
        }
        
        /* Alert Styles */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 0.9rem 1.2rem;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
        }
        
        .alert-danger {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
        }
        
        .alert-success {
            background: #f0fdf4;
            border-left: 4px solid #22c55e;
            color: #166534;
        }
        
        .alert i {
            margin-right: 0.5rem;
        }
        
        .btn-close {
            font-size: 0.7rem;
        }
        
        .login-footer {
            text-align: center;
            padding: 1.5rem 2rem;
            background: #f1f5f9;
            font-size: 0.75rem;
            color: #64748b;
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .login-container {
                padding: 1rem;
            }
            
            .form-section {
                padding: 1.5rem;
            }
            
            .brand-section {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background Orbs -->
    <div class="orb-1"></div>
    <div class="orb-2"></div>
    
    <div class="login-container">
        <div class="login-card">
            <!-- Brand Section -->
            <div class="brand-section">
                <div class="logo-icon">
                    <i class="bi bi-lightning-charge-fill"></i>
                </div>
                <h1>GYM</h1>
                <p>Sistem Manajemen Gym Membership</p>
            </div>
            
            <!-- Form Section -->
            <div class="form-section">
                <h2 class="form-title">Selamat Datang</h2>
                <div class="form-subtitle">Login dengan akun Anda</div>
                
                <!-- Alert Messages -->
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                <!-- Login Form -->
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" placeholder="email@gmail.com" required>
                        </div>
                        @error('email')
                        <div class="text-danger mt-1 fs-7">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" placeholder="Masukkan password" required>
                        </div>
                        @error('password')
                        <div class="text-danger mt-1 fs-7">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-options">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember"> Ingat Saya
                        </label>
                    </div>
                    
                    <button type="submit" class="btn-login">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
                    </button>
                </form>
                
            
            <!-- Footer -->
            <div class="login-footer">
                <p>&copy; 2026 GYM Membership. All rights reserved. Empowering Fitness Excellence.</p>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>