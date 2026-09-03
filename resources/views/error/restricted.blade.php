@extends('main')

@section('content')
<style>
    .error-container {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .error-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05), 0 5px 15px rgba(0,0,0,0.03);
        padding: 50px 40px;
        text-align: center;
        max-width: 500px;
        width: 100%;
        border-top: 5px solid #ef4444;
        transition: transform 0.3s ease;
    }
    .error-card:hover {
        transform: translateY(-5px);
    }
    .error-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 25px;
        background: #fee2e2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .error-icon img {
        width: 60px;
        opacity: 0.8;
    }
    .error-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 15px;
        letter-spacing: -0.5px;
    }
    .error-desc {
        color: #6b7280;
        font-size: 1.1rem;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    .btn-back {
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-size: 0.9rem;
    }
    .btn-back:hover {
        box-shadow: 0 8px 15px rgba(79, 70, 229, 0.3);
        transform: translateY(-2px);
        color: white;
    }
</style>

<div class="container-fluid error-container">
    <div class="error-card">
        <div class="error-icon">
            <img src="https://cdn-icons-png.flaticon.com/512/3064/3064197.png" alt="Restricted">
        </div>
        <h1 class="error-title">Akses Ditolak!</h1>
        <p class="error-desc">Maaf, halaman ini dibatasi dan khusus hanya dapat diakses oleh pengguna dengan hak akses <strong>Administrator</strong>.</p>
        <a href="{{ url('/') }}" class="btn btn-back">
            <i class="fa fa-arrow-left mr-2"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
