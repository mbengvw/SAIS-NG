<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIS-MAN 2 | Login</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(-45deg, #4f46e5, #3b82f6, #06b6d4, #10b981);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating Orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            animation: float 10s infinite ease-in-out alternate;
        }
        .orb-1 {
            width: 400px; height: 400px;
            background: rgba(255, 255, 255, 0.2);
            top: -100px; left: -100px;
        }
        .orb-2 {
            width: 300px; height: 300px;
            background: rgba(236, 72, 153, 0.3);
            bottom: -50px; right: -50px;
            animation-delay: -5s;
        }

        @keyframes float {
            0% { transform: translateY(0px) translateX(0px) scale(1); }
            100% { transform: translateY(40px) translateX(40px) scale(1.1); }
        }

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 420px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            text-align: center;
            color: white;
            transform: translateY(20px);
            opacity: 0;
            animation: slideUp 0.8s ease forwards;
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .login-header {
            margin-bottom: 35px;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transform: rotate(-10deg);
            transition: transform 0.3s;
        }
        
        .login-container:hover .login-logo {
            transform: rotate(0deg) scale(1.05);
        }
        
        .login-logo i {
            font-size: 40px;
            color: #4f46e5;
        }

        .login-header h2 {
            font-weight: 800;
            font-size: 2rem;
            margin: 0 0 5px;
            letter-spacing: -0.5px;
        }

        .login-header p {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 8px;
            padding-left: 5px;
            color: rgba(255, 255, 255, 0.9);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .form-control {
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            padding: 16px 20px;
            border-radius: 16px;
            color: white;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            outline: none;
            box-sizing: border-box;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
        }

        .btn-login {
            width: 100%;
            background: white;
            color: #4f46e5;
            border: none;
            padding: 16px;
            border-radius: 16px;
            font-size: 1.1rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(0,0,0,0.2);
            background: #f8fafc;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.5);
            color: #fca5a5;
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .alert-info {
            background: rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.5);
            color: #a7f3d0;
        }

        .error-text {
            font-size: 0.8rem;
            color: #fca5a5;
            margin-top: 6px;
            display: block;
            padding-left: 5px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">
                <i class="fa fa-graduation-cap"></i>
            </div>
            <h2>SAIS-NG</h2>
            <p>Sistem Informasi Akademik Siswa<br>MAN 2 Kuningan</p>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-info">
                {{ $message }}
            </div>
        @endif
        
        @if ($message = Session::get('error'))
            <div class="alert">
                {{ $message }}
            </div>
        @endif

        <form action="{{ route('login.validate_login') }}" method="post">
            @csrf
            <div class="input-group">
                <label>Email Address</label>
                <input type="text" name="email" class="form-control" placeholder="admin@example.com" value="{{ old('email') }}" />
                @if ($errors->has('email'))
                    <span class="error-text">{{ $errors->first('email') }}</span>
                @endif
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" />
                @if ($errors->has('password'))
                    <span class="error-text">{{ $errors->first('password') }}</span>
                @endif
            </div>
            
            <button type="submit" class="btn-login">Sign In</button>
        </form>
    </div>
</body>
</html>
