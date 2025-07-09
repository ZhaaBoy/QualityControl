@extends('layouts.base.app')

@section('title', 'Default')

@push('css')
<style>
    .undercontruction {
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .icon {
        font-size: 80px;
        animation: bounce 1.5s infinite;
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .btn-custom {
        background: white;
        color: #007bff;
        font-weight: bold;
        border-radius: 30px;
        padding: 10px 20px;
    }
    .btn-custom:hover {
        background: #b3cdff;
    }
</style>
@endpush

@section('content')
<div class="container undercontruction">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <span class="icon">🚧</span>
            <h1 class="mt-3">Situs Sedang Dalam Pengerjaan</h1>
            <p class="lead">Kami sedang melakukan beberapa peningkatan. Harap kembali lagi nanti.</p>
            <a href="#" class="btn btn-custom mt-3">Hubungi Kami</a>
        </div>
    </div>
</div>
@endsection
