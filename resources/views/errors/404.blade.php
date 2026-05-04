@extends('layouts.public')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<div class="min-h-screen flex items-center justify-center pt-20 relative overflow-hidden" style="background: linear-gradient(135deg, #083272 0%, #1565C0 50%, #0F4AA8 100%);">
    <!-- Dekorasi background -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gold-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-navy-600/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="text-center px-4 z-10 relative fade-in-up">
        <div class="text-[120px] md:text-[180px] font-black leading-none gradient-text mb-2 drop-shadow-2xl" style="font-family: 'Plus Jakarta Sans', sans-serif;">
            404
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Halaman Tidak Ditemukan</h1>
        <p class="text-blue-400 mb-8 max-w-md mx-auto text-lg leading-relaxed">Maaf, halaman yang Anda cari mungkin telah dihapus, diubah namanya, atau tidak tersedia untuk sementara waktu.</p>
        <a href="{{ route('beranda') }}" class="btn-primary inline-flex shadow-lg shadow-gold-500/20">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
