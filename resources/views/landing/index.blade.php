<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koztly</title>
    <!-- Import Font -->
    <link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
    /* ============================================================================
    RESET GLOBAL & BASE STYLES
    ============================================================================ */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Mulish', sans-serif;
        background: white;
        min-height: 100vh;
    }


    /* ============================================================================
    SECTION: NAVIGATION (NAVBAR)
    Navbar dengan animasi, state transparent/colored, dan smooth transitions
    ============================================================================ */

    /* Container Navbar */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 50px;
        z-index: 1000;
        background: transparent;
        transition: transform 0.3s ease, background-color 0.3s ease, opacity 0.3s ease;
    }

    /* State Navbar */
    .navbar-hidden {
        transform: translateY(-100%);
    }

    .navbar-transparent {
        background-color: transparent;
    }

    .navbar-colored {
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }

    /* Logo */
    .logo {
        width: 120px;
        height: auto;
        margin-left: -12px;
        opacity: 0;
        transform: scale(0.8);
        animation: zoomIn 0.8s ease 0.3s forwards;
    }

    /* Menu Navigasi */
    .nav-menu {
        display: flex;
        gap: 25px;
        list-style: none;
        margin-left: 50px;
    }

    .nav-menu li {
        position: relative;
        opacity: 0;
        transform: translateY(-20px);
        animation: fadeInUp 0.6s ease forwards;
    }

    /* Delay animasi untuk setiap menu item */
    .nav-menu li:nth-child(1) { animation-delay: 0.4s; }
    .nav-menu li:nth-child(2) { animation-delay: 0.5s; }
    .nav-menu li:nth-child(3) { animation-delay: 0.6s; }
    .nav-menu li:nth-child(4) { animation-delay: 0.7s; }

    .nav-menu a {
        text-decoration: none;
        color: #E93B81;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        padding: 12px 40px;
        border-radius: 25px;
        background: rgba(255, 255, 255, 0.8);
    }

    .nav-menu a:hover {
        background: #F5ABC9;
        color: #ffffff;
    }

    /* Tombol Auth (Login & Register) */
    .auth-buttons {
        display: flex;
        gap: 18px;
        align-items: center;
    }

    .btn {
        font-family: 'Mulish', sans-serif;
        padding: 18px 24px;
        border: none;
        border-radius: 25px;
        font-weight: 200;
        font-size: 17px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        opacity: 0;
        transform: translateX(30px);
        animation: slideInRight 0.6s ease forwards;
    }

    .btn:nth-child(1) { animation-delay: 0.8s; }
    .btn:nth-child(2) { animation-delay: 0.9s; }

    .btn-glass {
        background: rgba(182, 201, 240, 0.1);
        backdrop-filter: blur(20px);
        border: 2px solid #E93B81;
        color: #E93B81;
    }

    .btn-glass:hover {
        background: #F5ABC9;
        color: #ffffff;
        border-color: #F5ABC9;
    }

    /* Efek Ripple untuk Button */
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
    }


    /* ============================================================================
    SECTION: BERANDA (HERO)
    Hero section dengan vector image dan text overlay
    ============================================================================ */

    .hero-container {
        min-height: 100vh;
        padding-top: 125px;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    /* Layout Main Content */
    .main-content {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 50px;
        position: relative;
    }

    .content-left {
        flex: 1;
        max-width: 600px;
        z-index: 5;
    }

    .content-right {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    /* Gambar Vector */
    .vector-image {
        position: absolute;
        bottom: -280px;
        right: -35px;
        width: 163%;
        z-index: 1;
        pointer-events: none;
        opacity: 0;
        transform: translateX(100px);
        animation: slideInFromRight 1.2s ease 0.8s forwards;
    }

    /* Text Overlay di Atas Gambar Vector */
    .vector-text-overlay {
        position: absolute;
        left: -47%;
        bottom: -50%;
        transform: translate(-50%, -50%);
        text-align: left;
        z-index: 3;
        color: #E93B81;
        font-family: 'Mulish', sans-serif;
        pointer-events: none;
        opacity: 0;
        animation: fadeInUp 1s ease 1.2s forwards;
    }

    .overlay-main-text {
        font-size: 2.3rem;
        font-weight: 900;
        margin-bottom: 8px;
        background: linear-gradient(135deg, #E93B81, #ff6ba8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .overlay-sub-text {
        font-size: 1.5rem;
        font-weight: 700;
        color: #E93B81;
        margin-bottom: 10px;
    }

    .overlay-description {
        font-size: 1rem;
        color: #643843;
        font-weight: 400;
        max-width: 350px;
        margin: 0 auto;
    }

    /* Tombol "Cari Kos" di Pojok Kiri Bawah */
    .bottom-left-button {
        position: absolute;
        bottom: 18px;
        left: 33px;
        z-index: 10;
        opacity: 0;
        transform: translateY(50px);
        animation: slideUp 1s ease 1.5s forwards;
    }

    .btn-outlined {
        display: inline-flex;
        align-items: center;
        padding: 17px 227px;
        background: transparent;
        border: 2px solid #E93B81;
        border-radius: 22px;
        color: #E93B81;
        text-decoration: none;
        font-family: 'Mulish', sans-serif;
        font-weight: 500;
        font-size: 16px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-outlined:hover {
        background: #F5ABC9;
        color: white;
        border-color: #F5ABC9;
    }


    /* ============================================================================
    SECTION: KOS (DAFTAR KOSAN)
    Grid layout untuk menampilkan card kosan
    ============================================================================ */

    .section-kos {
        background-color: white;
        padding: 60px 20px;
    }

    .container-kos {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Header Section Kos */
    .header-text {
        text-align: center;
        margin-bottom: 20px;
    }

    .header-text h1 {
        font-size: 2.5rem;
        color: #E93B81;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .header-text p {
        font-size: 1.1rem;
        color: #643843;
    }

    /* Link "Lihat Lainnya" */
    .text-right-container {
        text-align: right;
        margin-bottom: 30px;
    }

    .link-lihat-lainnya {
        color: #E93B81;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .link-lihat-lainnya:hover {
        color: #d63370;
        text-decoration: underline;
    }

    /* Grid Layout untuk Card Kosan (3 kolom) */
    .kos-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-top: 20px;
    }

    /* Card Kosan */
    .kos-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .kos-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    /* Section Gambar (fixed height) */
    .kos-image-wrapper {
        position: relative;
        width: 100%;
        height: 220px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .kos-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .kos-card:hover .kos-image {
        transform: scale(1.05);
    }

    /* Badge (Kategori & Type) */
    .kos-badges {
        position: absolute;
        bottom: 12px;
        left: 12px;
        display: flex;
        gap: 8px;
    }

    .badge-kategori,
    .badge-type {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .badge-pria {
        background: #3b82f6;
        color: white;
    }

    .badge-wanita {
        background: #E93B81;
        color: white;
    }

    .badge-campur {
        background: #f97316;
        color: white;
    }

    .badge-type {
        background: #10b981;
        color: white;
    }

    /* Tombol Favorite */
    .btn-favorite {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(4px);
        z-index: 10;
    }

    .btn-favorite:hover {
        background: white;
        transform: scale(1.1);
    }

    .btn-favorite i {
        color: #E93B81;
        font-size: 1rem;
    }

    /* Section Content Card */
    .kos-content {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    /* Harga */
    .kos-price {
        display: flex;
        align-items: baseline;
        gap: 4px;
        margin-bottom: 12px;
    }

    .price-amount {
        font-size: 1.5rem;
        font-weight: 700;
        color: #3b82f6;
    }

    .price-period {
        font-size: 0.875rem;
        color: #6b7280;
    }

    /* Judul Kos (maksimal 2 baris) */
    .kos-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 8px;
        line-height: 1.4;
        min-height: 3em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    /* Lokasi */
    .kos-location {
        display: flex;
        align-items: flex-start;
        gap: 6px;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 16px;
        min-height: 2.5em;
    }

    .kos-location i {
        color: #E93B81;
        font-size: 0.875rem;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .kos-location span {
        line-height: 1.4;
    }

    /* Info Kamar Tersisa */
    .kos-info {
        display: flex;
        gap: 16px;
        margin-bottom: 16px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.875rem;
        color: #4b5563;
    }

    .info-item i {
        color: #3b82f6;
        font-size: 1rem;
    }

    /* Garis Pembatas */
    .kos-divider {
        height: 1px;
        background: #e5e7eb;
        margin: 16px 0;
        margin-top: auto;
    }

    /* Footer: Icon Fasilitas */
    .kos-footer {
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .kos-facilities {
        display: flex;
        gap: 12px;
    }

    .kos-facilities i {
        color: #6b7280;
        font-size: 1rem;
        transition: color 0.2s ease;
    }

    .kos-facilities i:hover {
        color: #E93B81;
    }


    /* ============================================================================
    SECTION: TENTANG (ABOUT)
    Section dengan parallax animation dan statistik
    ============================================================================ */

    .section-tentang {
        background: white;
        padding: 100px 0;
        overflow: hidden;
        position: relative;
    }

    /* Container Layout (2 kolom) */
    .tentang-container {
        max-width: 1250px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    /* Content Kiri (Text) */
    .tentang-content {
        order: 1;
        padding: 20px 0;
        margin-bottom: 20px;
        margin-left: 25px;
    }

    .tentang-badge {
        display: inline-block;
        color: #643843;
        font-size: 16px;
        font-weight: 200;
        margin-bottom: 20px;
        position: relative;
        padding: 8px 0;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease 0.2s;
    }

    .tentang-content.animate .tentang-badge {
        opacity: 1;
        transform: translateY(0);
    }

    /* Garis atas dan bawah pada badge */
    .tentang-badge::before,
    .tentang-badge::after {
        content: '';
        position: absolute;
        width: 40px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #E93B81;
    }

    .tentang-badge::before { top: 0; }
    .tentang-badge::after { bottom: 0; }

    .tentang-title {
        font-size: 30px;
        font-weight: 900;
        color: #E93B81;
        margin-bottom: 20px;
        line-height: 1.3;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease 0.4s;
    }

    .tentang-content.animate .tentang-title {
        opacity: 1;
        transform: translateY(0);
    }

    .tentang-description {
        font-size: 15px;
        font-weight: 600;
        color: #643843;
        line-height: 1.6;
        text-align: justify;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease 0.6s;
    }

    .tentang-content.animate .tentang-description {
        opacity: 1;
        transform: translateY(0);
    }

    /* Info Angka Kota Tersedia */
    .tentang-angka {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 25px;
        text-align: left;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease 0.8s;
    }

    .tentang-content.animate .tentang-angka {
        transform: translateY(0);
    }

    .tentang-angka img {
        width: 200px;
        max-width: 100%;
        height: auto;
        display: inline-block;
        margin-left: -25px;
    }

    .tentang-angka-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
        margin-left: -15px;
        margin-bottom: -5px;
    }

    .kota {
        font-size: 70px;
        font-weight: 900;
        color: #E93B81;
    }

    .tersedia {
        font-size: 35px;
        font-weight: 900;
        color: #E93B81;
    }

    /* Gambar Kanan (dengan efek parallax) */
    .tentang-image {
        order: 1;
        margin-left: 90px;
        margin-bottom: 50px;
        transform: translateY(-200px);
        transition: transform 0.1s linear;
    }

    .tentang-image img {
        width: 120%;
        max-width: 600px;
    }

    /* Placeholder untuk gambar */
    .placeholder-img {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }

    .tentang-image .placeholder-img {
        width: 90%;
        max-width: 540px;
    }

    .tentang-angka .placeholder-img {
        width: 200px;
        height: 100px;
        margin-left: -25px;
    }

    /* Garis Pemisah */
    .tentang-line {
        border-bottom: 0.1px solid #E93B81;
        max-width: 600px;
        margin: 30px auto;
        margin-top: -25px;
        margin-left: 135px;
    }

    /* Statistik dengan Counter Animation (4 kolom) */
    .tentang-stats {
        max-width: 500px;
        margin: 35px auto 0;
        display: grid;
        grid-template-columns: repeat(4, 1.5fr);
        gap: 90px;
        text-align: center;
        margin-left: 140px;
    }

    .stat-item {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .stat-item.animate {
        opacity: 1;
        transform: translateY(0);
    }

    .stat-item h3 {
        font-size: 2rem;
        font-weight: bold;
        color: #E93B81;
        margin-bottom: 10px;
        transition: transform 0.3s ease;
    }

    .stat-item:hover h3 {
        transform: scale(1.1);
    }

    .stat-item p {
        font-size: 1rem;
        color: #555;
    }


    /* ============================================================================
    SECTION: TESTIMONI
    Infinite horizontal scroll carousel dengan animasi masuk/keluar
    ============================================================================ */

    .section-testimoni {
        padding: 100px 0;
        background: white;
        min-height: 100vh;
        overflow: hidden;
        opacity: 0;
        transform: translateY(100px) scale(0.9);
        transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* State Animasi Section */
    .section-testimoni.animate-in {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .section-testimoni.animate-out {
        opacity: 0;
        transform: translateY(-100px) scale(0.9);
        transition: all 0.8s cubic-bezier(0.55, 0.06, 0.68, 0.19);
    }

    .section-testimoni.pulse {
        animation: sectionPulse 2s ease-in-out;
    }

    .container {
        max-width: 100vw;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        overflow-y: visible;
    }

    /* Header Testimoni */
    .testimoni-header {
        text-align: center;
        margin-bottom: 120px;
        padding: 0 20px;
    }

    .section-title {
        font-family: 'Lobster', cursive;
        font-size: 4rem;
        font-weight: 500;
        color: #643843;
        margin-bottom: 5px;
        opacity: 0;
        transform: translateY(50px) rotateX(90deg);
        transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.2s;
    }

    .section-title.animate-in {
        opacity: 1;
        transform: translateY(0) rotateX(0deg);
    }

    .section-title.animate-out {
        opacity: 0;
        transform: translateY(-50px) rotateX(-90deg);
        transition: all 0.6s cubic-bezier(0.55, 0.06, 0.68, 0.19);
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #643843;
        max-width: 900px;
        margin: 0 auto;
        line-height: 1.5;
        opacity: 0;
        transform: translateY(30px) scale(0.8);
        transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.4s;
    }

    .section-subtitle.animate-in {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .section-subtitle.animate-out {
        opacity: 0;
        transform: translateY(-30px) scale(0.8);
        transition: all 0.6s cubic-bezier(0.55, 0.06, 0.68, 0.19);
    }

    /* Container untuk Carousel (hide scrollbar) */
    .testimoni-container {
        overflow: hidden !important;
        overflow-x: hidden !important;
        overflow-y: hidden !important;
        width: 100%;
        cursor: grab;
        user-select: none;
        opacity: 0;
        transform: translateY(60px) rotateY(45deg);
        transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.6s;
        perspective: 1000px;
    }

    .testimoni-container.animate-in {
        opacity: 1;
        transform: translateY(0) rotateY(0deg);
    }

    .testimoni-container.animate-out {
        opacity: 0;
        transform: translateY(-60px) rotateY(-45deg);
        transition: all 0.8s cubic-bezier(0.55, 0.06, 0.68, 0.19);
    }

    .testimoni-container:active {
        cursor: grabbing;
    }

    /* Sembunyikan Scrollbar untuk semua browser */
    .testimoni-container::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
    }

    .testimoni-container {
        -ms-overflow-style: none !important;
        scrollbar-width: none !important;
    }

    /* Grid untuk Carousel (horizontal flex) */
    .testimoni-grid {
        display: flex;
        gap: 20px;
        padding: 0;
        margin: 0;
        width: fit-content;
        justify-content: flex-start;
        transition: transform 0.1s linear;
        will-change: transform;
        overflow: visible;
    }

    /* Card Testimoni */
    .testimoni-card {
        flex: 0 0 300px;
        scroll-snap-align: start;
        background-color: rgba(140, 160, 200, 0.1);
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
        min-height: 280px;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        user-select: none;
        opacity: 0;
        transform: translateX(100px) translateY(50px) rotateY(45deg) scale(0.8);
        transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .testimoni-card.animate-in {
        opacity: 1;
        transform: translateX(0) translateY(0) rotateY(0deg) scale(1);
    }

    .testimoni-card.animate-out {
        opacity: 0;
        transform: translateX(-100px) translateY(-50px) rotateY(-45deg) scale(0.8);
        transition: all 0.6s cubic-bezier(0.55, 0.06, 0.68, 0.19);
    }

    /* Delay Animasi Stagger untuk setiap card */
    .testimoni-card:nth-child(1).animate-in { transition-delay: 0.8s; }
    .testimoni-card:nth-child(2).animate-in { transition-delay: 0.95s; }
    .testimoni-card:nth-child(3).animate-in { transition-delay: 1.1s; }
    .testimoni-card:nth-child(4).animate-in { transition-delay: 1.25s; }
    .testimoni-card:nth-child(5).animate-in { transition-delay: 1.4s; }
    .testimoni-card:nth-child(6).animate-in { transition-delay: 1.55s; }

    .testimoni-card:nth-child(1).animate-out { transition-delay: 0s; }
    .testimoni-card:nth-child(2).animate-out { transition-delay: 0.1s; }
    .testimoni-card:nth-child(3).animate-out { transition-delay: 0.2s; }
    .testimoni-card:nth-child(4).animate-out { transition-delay: 0.3s; }
    .testimoni-card:nth-child(5).animate-out { transition-delay: 0.4s; }
    .testimoni-card:nth-child(6).animate-out { transition-delay: 0.5s; }

    .testimoni-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 35px rgba(233, 59, 129, 0.3);
        z-index: 10;
        background-color: rgba(233, 59, 129, 0.05);
        border: 2px solid rgba(233, 59, 129, 0.2);
    }

    /* Efek Gradient Border saat Hover */
    .testimoni-card::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #E93B81, #ff6ba8, #ff9bcb, #E93B81);
        border-radius: 10px;
        opacity: 0;
        z-index: -1;
        transition: opacity 0.3s ease;
        background-size: 300% 300%;
        animation: gradientShift 3s linear infinite;
    }

    .testimoni-card:hover::before {
        opacity: 0.6;
    }

    /* Content Card Testimoni */
    .testimoni-content {
        position: relative;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Bintang Rating */
    .stars {
        color: #FFD700;
        font-size: 1.5rem;
        margin-bottom: 15px;
        letter-spacing: 1px;
        opacity: 0;
        transform: scale(0);
        transition: all 0.5s ease-out;
    }

    .testimoni-card.animate-in .stars {
        opacity: 1;
        transform: scale(1);
        transition-delay: 0.2s;
    }

    /* Text Testimoni */
    .testimoni-text {
        font-size: 0.90rem;
        color: #643843;
        line-height: 1.6;
        margin-bottom: 10px;
        font-style: italic;
        flex: 1;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.5s ease-out;
    }

    .testimoni-card.animate-in .testimoni-text {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.3s;
    }

    /* Author Info */
    .testimoni-author {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: auto;
        opacity: 0;
        transform: translateX(-20px);
        transition: all 0.5s ease-out;
    }

    .testimoni-card.animate-in .testimoni-author {
        opacity: 1;
        transform: translateX(0);
        transition-delay: 0.4s;
    }

    .author-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #E93B81, #ff6ba8);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        flex-shrink: 0;
        transform: scale(0);
        transition: transform 0.3s ease-out;
    }

    .testimoni-card.animate-in .author-icon {
        transform: scale(1);
        transition-delay: 0.5s;
    }

    .author-info h4 {
        font-size: 1rem;
        font-weight: 600;
        color: #643843;
        margin: 0 0 3px 0;
    }

    .author-info p {
        font-size: 0.85rem;
        color: #643843;
        margin: 0;
    }


    /* ============================================================================
    SECTION: KONTAK
    Form kontak, info kontak, dan Google Maps
    ============================================================================ */

    .section-kontak {
        margin: 0 auto;
    }

    /* Hero Section dengan Gradient Background */
    .hero-section {
        background: linear-gradient(125deg, #F5ABC9 0%, #FFE5E2 100%);
        padding: 60px;
        position: relative;
        min-height: 200px;
    }

    .hero-content {
        max-width: 100%;
        position: relative;
        z-index: 1;
    }

    .hero-content h1 {
        color: #E93B81;
        font-size: 48px;
        margin-bottom: 5px;
        margin-left: 100px;
    }

    .hero-content p {
        color: #643843;
        font-size: 14px;
        line-height: 1.6;
        max-width: 600px;
        margin-left: 100px;
    }

    /* Gambar di Hero Section */
    .hero-image {
        position: absolute;
        right: 200px;
        top: 50px;
        width: 300px;
        height: 550px;
        z-index: 2;
    }

    .hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 200px 200px 0 0;
        display: block;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    /* Info Cards (Telepon, Email, Alamat) */
    .info-cards {
        background: white;
        padding: 60px 40px 60px 40px;
        display: flex;
        align-items: flex-start;
        gap: 30px;
        position: relative;
        margin-left: 120px;
        margin-top: 10px;
    }

    .info-content {
        flex: 1;
        max-width: 50%;
    }

    .info-cards h2 {
        color: #E93B81;
        font-size: 24px;
        margin-bottom: 5px;
        margin-top: -30px;
    }

    .info-cards p {
        color: #643843;
        font-size: 14px;
        margin-bottom: 40px;
        line-height: 1.6;
    }

    .info-content p {
        color: #643843;
        font-size: 14px;
        margin-bottom: 25px;
        line-height: 1.6;
    }

    /* Container Cards Kontak */
    .cards-container {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* Card Individual (Telepon, Email, Lokasi) */
    .card {
        flex: 1;
        min-width: 200px;
        text-align: center;
        margin-left: -70px;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    /* Icon Card dengan Animasi */
    .card-icon {
        width: 50px;
        height: 50px;
        background: #B6C9F0;
        border-radius: 200px 200px 0 0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    /* Efek Ripple pada Icon */
    .card-icon::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(233, 59, 129, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.4s ease, height 0.4s ease;
    }

    .card-icon:hover::before {
        width: 100px;
        height: 100px;
    }

    .card-icon i {
        color: #E93B81;
        font-size: 14px;
        background: white;
        padding: 8px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .card:hover .card-icon {
        background: #E93B81;
        box-shadow: 0 8px 16px rgba(233, 59, 129, 0.3);
    }

    .card:hover .card-icon i {
        transform: scale(1.1) rotate(5deg);
    }

    .card h3 {
        color: #643843;
        font-size: 16px;
        margin-bottom: 2px;
        font-weight: 800;
    }

    .card p {
        color: #643843;
        font-size: 13px;
    }

    /* Section Form & Lokasi */
    .bottom-section {
        display: flex;
        gap: 40px;
        padding: 35px 150px;
        background: white;
        flex-wrap: wrap;
        margin-top: 70px;
    }

    /* Form Kontak */
    .form-section {
        flex: 1;
        min-width: 300px;
        background: linear-gradient(125deg, #F5ABC9 0%, #FFE5E2 100%);
        padding: 40px;
        border-radius: 8px;
    }

    .form-section h2 {
        color: #E93B81;
        font-size: 24px;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .form-section p {
        color: #643843;
        font-size: 13px;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 15px;
        border: 1.5px solid #643843;
        border-radius: 20px;
        background: transparent;
        color: #643843;
        font-size: 14px;
        outline: none;
        transition: all 0.3s;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #643843;
        font-family: 'Mulish', sans-serif;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #E93B81;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(233, 59, 129, 0.2);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    /* Tombol Submit */
    .submit-btn {
        background: #E93B81;
        font-family: 'Mulish', sans-serif;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
    }

    .submit-btn:hover {
        background: #d63571;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(233, 59, 129, 0.3);
    }

    /* Section Lokasi & Maps */
    .location-section {
        flex: 1;
        min-width: 300px;
    }

    .location-section h2 {
        color: #E93B81;
        font-size: 24px;
        margin-bottom: 15px;
    }

    .location-section p {
        color: #643843;
        font-size: 13px;
        margin-bottom: 25px;
        line-height: 1.6;
    }

    /* Container Google Maps */
    .map-container {
        width: 100%;
        height: 250px;
        background: #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 30px;
        position: relative;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    /* Social Media Icons */
    .social-media h3 {
        color: #E93B81;
        font-size: 20px;
        margin-bottom: 20px;
        margin-top: 15px;
    }

    .social-icons {
        display: flex;
        gap: 17px;
    }

    .social-icon {
        width: 50px;
        height: 50px;
        background: #B6C9F0;
        border-radius: 250px 250px 0 0;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
    }

    .social-icon:hover {
        background: #E93B81;
        transform: translateY(-5px) rotate(5deg);
    }

    .social-icon i {
        color: #E93B81;
        font-size: 14px;
        background: white;
        padding: 8px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }


    /* ============================================================================
    SECTION: FOOTER
    Footer dengan logo, navigasi, link cepat, dan jam kerja
    ============================================================================ */

    .footer-section {
        background: 
            linear-gradient(125deg, rgba(255,255,255,0.7), rgba(255,255,255,0.7)),
            url('images/gambar.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin-top: 50px;
        color: white;
    }

    .footer-container {
        margin: 0 auto;
    }

    /* Garis Atas Footer */
    .footer-line {
        background: linear-gradient(125deg, #F5ABC9 0%, #FFE5E2 100%);
        padding: 10px 0;
        margin-bottom: 50px;
        box-shadow: 0 5px 20px rgba(233, 59, 129, 0.1);
    }

    /* Grid Layout Footer (4 kolom) */
    .footer-content {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.5fr;
        gap: 40px;
        margin-bottom: 40px;
        padding: 10px 90px;
    }

    .footer-column h4 {
        color: #E93B81;
        font-size: 20px;
        margin-bottom: 20px;
        font-weight: 700;
    }

    /* Kolom Brand (Logo & Deskripsi) */
    .footer-brand {
        max-width: 350px;
    }

    .footer-logo {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 10px;
        margin-top: -5px;
    }

    .footer-logo img {
        width: 150px;
        height: 50px;
        margin-left: -15px;
        object-fit: cover;
    }

    .footer-logo h3 {
        color: #E93B81;
        font-size: 28px;
        font-weight: 800;
        margin: 0;
    }

    .footer-brand p {
        color: #E93B81;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 25px;
        font-weight: 600;
    }

    /* Social Media Icons di Footer */
    .footer-social-icons {
        display: flex;
        gap: 16px;
    }

    .footer-social-icons .social-icon-footer {
        width: 45px;
        height: 45px;
        background: #E93B81;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        margin-left: -5px;
    }

    .footer-social .social-icon:hover {
        background: #E93B81;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(233, 59, 129, 0.3);
    }

    .footer-social-icons .social-icon-footer i {
        color: white;
        font-size: 16px;
        background: transparent;
        padding: 0;
    }

    .footer-social .social-icon:hover i {
        color: white;
    }

    /* Link Footer */
    .footer-column ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-column ul li {
        margin-bottom: 12px;
    }

    .footer-column ul li a {
        color: #E93B81;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-block;
    }

    .footer-column ul li a:hover {
        color: #E93B81;
    }

    /* Jam Kerja */
    .working-hours {
        color: #E93B81;
        font-size: 14px;
        line-height: 1.6;
        font-weight: 600;
    }

    .working-hours li {
        margin-bottom: 8px;
    }

    /* Footer Bottom (Copyright) */
    .footer-bottom {
        text-align: center;
        padding: 30px;
        border-top: 2px solid rgba(233, 59, 129, 0.3);
    }

    .footer-bottom p {
        color: #E93B81;
        font-size: 15px;
        margin: 0;
        font-weight: 800;
    }


    /* ============================================================================
    ANIMASI SCROLL
    Base styles untuk elemen dengan animasi saat scroll
    ============================================================================ */

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(50px);
        transition: opacity 1s cubic-bezier(0.4, 0, 0.2, 1),
                    transform 1s cubic-bezier(0.4, 0, 0.2, 1);
        will-change: opacity, transform;
    }

    .animate-on-scroll.animated {
        opacity: 1;
        transform: translateY(0);
    }

    /* Variasi Animasi */
    .animate-on-scroll.fade-in-left.animated {
        transform: translateX(0);
    }

    .animate-on-scroll.fade-in-left:not(.animated) {
        transform: translateX(-50px);
    }

    .animate-on-scroll.fade-in-right.animated {
        transform: translateX(0);
    }

    .animate-on-scroll.fade-in-right:not(.animated) {
        transform: translateX(50px);
    }

    .animate-on-scroll.scale-in.animated {
        transform: scale(1) translateY(0);
    }

    .animate-on-scroll.scale-in:not(.animated) {
        transform: scale(0.8) translateY(20px);
    }


    /* ============================================================================
    KEYFRAME ANIMATIONS
    Definisi animasi yang digunakan di berbagai section
    ============================================================================ */

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes slideInFromRight {
        from {
            opacity: 0;
            transform: translateX(100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    @keyframes sectionPulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.005);
        }
    }

    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
    </style>
</head>
<body>
<!--------------------------- SECTION NAVIGATION (NAVBAR) ----------------------------------->
<!-- Navbar dengan logo, menu navigasi, dan tombol autentikasi -->
<nav class="navbar" id="navbar">
    <div class="logo-container">
        <img src="images/logo.png" alt="Koztly Logo" class="logo">
    </div>

    <!-- Menu Navigasi -->
    <ul class="nav-menu">
        <li><a href="#beranda">Beranda</a></li>
        <li><a href="#tentang">Tentang</a></li>
        <li><a href="#testimoni">Testimoni</a></li>
        <li><a href="#kontak">Kontak</a></li>
    </ul>

    <!-- Tombol Login & Register -->
    <div class="auth-buttons">
        <a href="/login" class="btn btn-glass">Masuk</a>
        <a href="/register" class="btn btn-glass">Daftar</a>
    </div>
</nav>


<!--------------------------- SECTION BERANDA (HERO) ----------------------------------->
<!-- Hero section dengan gambar vector dan text overlay -->
<section id="beranda" class="hero-container">
    <main class="main-content">
        <div class="content-left"></div>

        <!-- Konten Kanan: Gambar Vector dengan Text Overlay -->
        <div class="content-right">
            <img src="images/vector.png" alt="Hero Vector" class="vector-image">
            
            <!-- Text Overlay di atas gambar vector -->
            <div class="vector-text-overlay">
                <div class="overlay-main-text">Booking & Cari Kos</div>
                <div class="overlay-sub-text">Mudah & Terpercaya</div>
                <div class="overlay-description">Temukan kos impian dengan fasilitas lengkap di lokasi strategis</div>
            </div>
        </div>
    </main>

    <!-- Tombol CTA di posisi bawah kiri -->
    <div class="bottom-left-button">
        <a href="#kos" class="btn-outlined">
            <span>Cari Kos</span>
        </a>
    </div>
</section>


<!--------------------------- SECTION KOS (REKOMENDASI KOSAN) ----------------------------------->
<!-- Menampilkan grid card kosan yang tersedia -->
<section id="kos" class="section-kos">
    <div class="container-kos">
        
        <!-- Header Section Kos -->
        <div class="header-text">
            <h1>Temukan Kos Impianmu</h1>
            <p>Cari kos nyaman sesuai kebutuhan dan budget kamu</p>
        </div>

        <!-- Tombol Lihat Lainnya (dengan auth check) -->
        <div class="text-right-container">
            <a href="javascript:void(0)" class="link-lihat-lainnya" onclick="checkLoginLainnya(event)">
                Lihat Lainnya
            </a>
        </div>

        <!-- Grid Card Kosan (Loop dari database) -->
        <div class="kos-grid">
            @foreach ($kosan as $kos)
            <a href="javascript:void(0)" class="kos-card" onclick="checkLoginCard(event, '{{ $kos->id_kos }}')">
                
                <!-- Gambar Kosan dengan Badge dan Icon Love -->
                <div class="kos-image-wrapper">
                    <!-- Gambar Utama -->
                    <img src="{{ $kos->gambar_kos 
                          ? (filter_var($kos->gambar_kos, FILTER_VALIDATE_URL) 
                                ? $kos->gambar_kos 
                                : asset('storage/'.$kos->gambar_kos)) 
                          : 'https://via.placeholder.com/800x400' }}"  
                        class="kos-image" 
                        alt="{{ $kos->nama_kos }}">
                    
                    <!-- Badge Kategori (Pria/Wanita/Campur) & Type -->
                    <div class="kos-badges">
                        <span class="badge-kategori 
                            @if(strtoupper($kos->kategori) == 'PRIA') badge-pria
                            @elseif(strtoupper($kos->kategori) == 'WANITA') badge-wanita 
                            @else badge-campur @endif">
                            {{ $kos->kategori }}
                        </span>
                        <span class="badge-type">Kost</span>
                    </div>

                    <!-- Icon Love untuk Favorite -->
                    <button class="btn-favorite" onclick="event.preventDefault(); event.stopPropagation();">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>

                <!-- Konten Card: Info Kosan -->
                <div class="kos-content">
                    
                    <!-- Harga per Bulan -->
                    <div class="kos-price">
                        <span class="price-amount">Rp {{ number_format($kos->harga, 0, ',', '.') }}</span>
                        <span class="price-period">/bulan</span>
                    </div>

                    <!-- Nama Kos -->
                    <h3 class="kos-title">{{ Str::limit($kos->nama_kos, 35) }}</h3>

                    <!-- Lokasi Kos -->
                    <p class="kos-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ Str::limit($kos->lokasi_kos, 40) }}</span>
                    </p>

                    <!-- Info Jumlah Kamar Tersisa -->
                    <div class="kos-info">
                        <div class="info-item">
                            <i class="fas fa-bed"></i>
                            <span>{{ $kos->sisaKamar() }} Kamar Tersisa</span>
                        </div>
                    </div>

                    <!-- Divider Line -->
                    <div class="kos-divider"></div>

                    <!-- Footer: Icon Fasilitas -->
                    <div class="kos-footer">
                        <div class="kos-facilities">
                            <i class="fas fa-wifi" title="WiFi"></i>
                            <i class="fas fa-snowflake" title="AC"></i>
                            <i class="fas fa-motorcycle" title="Parkir Motor"></i>
                            <i class="fas fa-utensils" title="Dapur"></i>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>


<!--------------------------- SECTION TENTANG (ABOUT) ----------------------------------->
<!-- Informasi tentang Koztly dengan animasi parallax -->
<section id="tentang" class="section-tentang">
    <div class="tentang-container">
        
        <!-- Konten Kiri: Text & Info -->
        <div class="tentang-content">
            <!-- Badge -->
            <div class="tentang-badge">Tentang Koztly</div>
            
            <!-- Judul -->
            <h2 class="tentang-title">
                Booking & Cari Kos Lebih Mudah, Tinggal Klik di Koztly
            </h2>
            
            <!-- Deskripsi -->
            <p class="tentang-description">
                Koztly adalah platform pencarian dan pemesanan kos-kosan yang memudahkan kamu menemukan tempat tinggal sesuai kebutuhan. Dengan informasi yang lengkap mengenai harga, fasilitas, dan lokasi, kamu bisa membandingkan berbagai pilihan kos secara praktis.
            </p>

            <!-- Info Jumlah Kota -->
            <div class="tentang-angka">
                <div class="placeholder-img">
                    <img src="images/angka.png" alt="Angka Kota">
                </div>
                <div class="tentang-angka-text">
                    <span class="kota">Kota</span>
                    <span class="tersedia">Tersedia</span>
                </div>
            </div>
        </div>
        
        <!-- Konten Kanan: Gambar Ilustrasi -->
        <div class="tentang-image">
            <div class="placeholder-img">
                <img src="images/tentang.png" alt="Tentang Koztly">
            </div>
        </div>
    </div>

    <!-- Garis Pemisah -->
    <div class="tentang-line"></div>

    <!-- Statistik dengan Animasi Counter -->
    <div class="tentang-stats" id="stats">
        <div class="stat-item">
            <h3 data-target="500">0+</h3>
            <p>Kos Terdaftar</p>
        </div>
        <div class="stat-item">
            <h3 data-target="25">0+</h3>
            <p>Wilayah Terjangkau</p>
        </div>
        <div class="stat-item">
            <h3 data-target="10000">0K+</h3>
            <p>Pengguna Aktif</p>
        </div>
        <div class="stat-item">
            <h3 data-target="24">0/7</h3>
            <p>Dukungan Pelanggan</p>
        </div>
    </div>
</section>


<!--------------------------- SECTION TESTIMONI (TESTIMONIALS) ----------------------------------->
<!-- Carousel testimoni dengan infinite scroll horizontal -->
<section id="testimoni" class="section-testimoni">
    <div class="container">
        
        <!-- Header Testimoni -->
        <div class="testimoni-header">
            <h2 class="section-title">Testimoni</h2>
            <p class="section-subtitle">
                Apa kata mereka yang sudah merasakan kemudahan booking kos di Koztly
            </p>
        </div>
        
        <!-- Container Carousel (overflow hidden) -->
        <div class="testimoni-container">
            <div class="testimoni-grid" id="testimoniGrid">
                
                <!-- Card Testimoni 1 -->
                <div class="testimoni-card">
                    <div class="testimoni-content">
                        <div class="stars">★★★★★</div>
                        <p class="testimoni-text">
                            "Sangat mudah mencari kos di Koztly! Prosesnya cepat dan fasilitas sesuai dengan deskripsi. Highly recommended!"
                        </p>
                        <div class="testimoni-author">
                            <div class="author-icon">
                                <span>SP</span>
                            </div>
                            <div class="author-info">
                                <h4>Sarah Putri</h4>
                                <p>Mahasiswa UI</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Testimoni 2 -->
                <div class="testimoni-card">
                    <div class="testimoni-content">
                        <div class="stars">★★★★★</div>
                        <p class="testimoni-text">
                            "Aplikasi yang sangat membantu untuk cari kos! Interface nya user-friendly dan banyak pilihan kos dengan harga terjangkau."
                        </p>
                        <div class="testimoni-author">
                            <div class="author-icon">
                                <span>AR</span>
                            </div>
                            <div class="author-info">
                                <h4>Ahmad Rahman</h4>
                                <p>Fresh Graduate</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Testimoni 3 -->
                <div class="testimoni-card">
                    <div class="testimoni-content">
                        <div class="stars">★★★★☆</div>
                        <p class="testimoni-text">
                            "Booking kos jadi praktis banget! Ga perlu repot survey satu-satu, semua info lengkap ada di aplikasi."
                        </p>
                        <div class="testimoni-author">
                            <div class="author-icon">
                                <span>MS</span>
                            </div>
                            <div class="author-info">
                                <h4>Maya Sari</h4>
                                <p>Karyawan Swasta</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Testimoni 4 -->
                <div class="testimoni-card">
                    <div class="testimoni-content">
                        <div class="stars">★★★★★</div>
                        <p class="testimoni-text">
                            "Pelayanan customer service yang responsif dan proses pembayaran yang aman. Terima kasih Koztly!"
                        </p>
                        <div class="testimoni-author">
                            <div class="author-icon">
                                <span>BS</span>
                            </div>
                            <div class="author-info">
                                <h4>Budi Santoso</h4>
                                <p>Mahasiswa ITB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Testimoni 5 -->
                <div class="testimoni-card">
                    <div class="testimoni-content">
                        <div class="stars">★★★★★</div>
                        <p class="testimoni-text">
                            "Fitur virtual tour nya keren! Bisa lihat kondisi kos dengan jelas sebelum booking. Innovation yang bagus!"
                        </p>
                        <div class="testimoni-author">
                            <div class="author-icon">
                                <span>LW</span>
                            </div>
                            <div class="author-info">
                                <h4>Linda Wijaya</h4>
                                <p>Digital Marketer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Testimoni 6 -->
                <div class="testimoni-card">
                    <div class="testimoni-content">
                        <div class="stars">★★★★☆</div>
                        <p class="testimoni-text">
                            "Harga transparan, tidak ada biaya tersembunyi. Sangat membantu mahasiswa seperti saya yang budget terbatas."
                        </p>
                        <div class="testimoni-author">
                            <div class="author-icon">
                                <span>RP</span>
                            </div>
                            <div class="author-info">
                                <h4>Rizky Pratama</h4>
                                <p>Mahasiswa UGM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--------------------------- SECTION KONTAK ----------------------------------->
<!-- Section kontak dengan form dan informasi kontak -->
<section id="kontak" class="section-kontak">
    
    <!-- Hero Section: Judul & Gambar -->
    <div class="hero-section">
        <div class="hero-content animate-on-scroll">
            <h1>Hubungi Kita</h1>
            <p>
                Kami siap membantu menjawab pertanyaan Anda seputar Koztly. 
                Silakan hubungi kami melalui informasi di bawah ini.
            </p>
        </div>
        <div class="hero-image animate-on-scroll">
            <img src="images/gambar.jpg" alt="Modern Kitchen">
        </div>
    </div>

    <!-- Info Cards: Telepon, Email, Alamat -->
    <div class="info-cards">
        <div class="info-content">
            <h2 class="animate-on-scroll">Informasi Kontak</h2>
            <p class="animate-on-scroll">
                Butuh bantuan atau informasi lebih lanjut? Tim Koztly siap memberikan solusi terbaik untuk kebutuhan
            </p>
            
            <!-- Grid Card Kontak -->
            <div class="cards-container">
                <!-- Card Telepon -->
                <div class="card animate-on-scroll">
                    <div class="card-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3>(+62) 5464 55</h3>
                    <p>Layanan pelanggan</p>
                </div>

                <!-- Card Email -->
                <div class="card animate-on-scroll">
                    <div class="card-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>koztly@gmail.com</h3>
                    <p>Kirim pesan</p>
                </div>

                <!-- Card Alamat -->
                <div class="card animate-on-scroll">
                    <div class="card-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Karawang, Indonesia</h3>
                    <p>Kantor pusat Koztly</p>
                </div>
            </div>
        </div>
        <div style="flex: 1; min-width: 40%;"></div>
    </div>

    <!-- Form dan Lokasi Section -->
    <div class="bottom-section">
        
        <!-- Form Kontak -->
        <div class="form-section animate-on-scroll">
            <h2>Punya pertanyaan seputar Koztly?</h2>
            <p>
                Butuh bantuan cari kos impianmu atau ingin kerja sama dengan kami? 
                tinggalkan pesanmu disini!
            </p>
            
            <form id="contactForm">
                <div class="form-group">
                    <input type="text" placeholder="Nama" required>
                </div>
                <div class="form-group">
                    <input type="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <textarea placeholder="Pesan" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Kirim Pesan</button>
            </form>
        </div>

        <!-- Lokasi & Peta -->
        <div class="location-section animate-on-scroll">
            <h2>Lokasi Kami</h2>
            <p>
                Jika kamu ingin bertemu secara langsung, silakan datang ke kantor kami pada alamat berikut.
            </p>
            
            <!-- Google Maps Embed -->
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps?q=Jl.%20HS.%20Ronggo%20Waluyo,%20Puseurjaya,%20Telukjambe%20Timur,%20Karawang,%20Jawa%20Barat%2041361&output=embed"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>

            <!-- Social Media Icons -->
            <div class="social-media">
                <h3>Sosial Media</h3>
                <div class="social-icons">
                    <div class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--------------------------- SECTION FOOTER ----------------------------------->
<!-- Footer dengan logo, navigasi, dan informasi kontak -->
<footer class="footer-section">
    <div class="footer-container">
        
        <!-- Garis Pemisah Atas -->
        <div class="footer-line"></div>

        <!-- Konten Footer -->
        <div class="footer-content">
            
            <!-- Kolom 1: Logo & Deskripsi -->
            <div class="footer-column footer-brand">
                <div class="footer-logo">
                    <img src="images/logo.png" alt="Koztly Logo">
                </div>
                <p>
                    Platform pencarian kos terpercaya yang membantu kamu menemukan hunian nyaman 
                    dan sesuai kebutuhan dengan mudah
                </p>
                <!-- Social Media Icons di Footer -->
                <div class="footer-social-icons">
                    <div class="social-icon-footer">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="social-icon-footer">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <div class="social-icon-footer">
                        <i class="fab fa-linkedin-in"></i>
                    </div>
                </div>
            </div>

            <!-- Kolom 2: Navigasi -->
            <div class="footer-column">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="#beranda">Home</a></li>
                    <li><a href="#tentang">Tentang</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Link Cepat -->
            <div class="footer-column">
                <h4>Link Cepat</h4>
                <ul>
                    <li><a href="#kontak">Hubungi Kami</a></li>
                    <li><a href="#kos">Kos</a></li>
                    <li><a href="#testimoni">Testimoni</a></li>
                </ul>
            </div>

            <!-- Kolom 4: Jam Kerja -->
            <div class="footer-column">
                <h4>Jam Kerja</h4>
                <ul class="working-hours">
                    <li>Senin - Jumat: 08.00 - 17.00</li>
                    <li>Sabtu: 09.00 - 15.00</li>
                    <li>Minggu & Libur Nasional: Tutup</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-bottom">
        <p>&copy 2025 Koztly Indonesia - Hak Cipta Dilindungi</p>
    </div>
</footer>

    <!-- Import Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    // ============================================================================
    // SECTION: NAVBAR CONTROLLER
    // Mengatur behavior navbar (transparent/colored, show/hide, smooth scroll)
    // ============================================================================
    class NavbarController {
        constructor() {
            this.navbar = document.getElementById('navbar');
            this.heroSection = this.findHeroSection();
            this.init();
        }

        // Mencari hero section (biasanya section 'beranda' atau section pertama)
        findHeroSection() {
            let heroSection = document.getElementById('beranda');
            if (!heroSection) {
                const sections = document.querySelectorAll('section');
                if (sections.length > 0) heroSection = sections[0];
            }
            return heroSection;
        }

        // Inisialisasi event listeners
        init() {
            window.addEventListener('scroll', this.handleScroll.bind(this));
            this.addSmoothScrolling();
            this.handleScroll(); // Cek posisi awal saat load
        }

        // Handle perubahan navbar saat scroll
        handleScroll() {
            if (!this.heroSection) {
                this.showNavbar(false); // Beri background jika hero tidak ada
                return;
            }

            const scrollY = window.scrollY;

            // Begitu scroll > 0, langsung beri background
            if (scrollY > 0) {
                this.showNavbar(false); // Navbar dengan background
            } else {
                this.showNavbar(true); // Navbar transparent
            }
        }

        // Sembunyikan navbar (tidak dipakai saat ini, bisa untuk future use)
        hideNavbar() {
            this.navbar.classList.add('navbar-hidden');
        }

        // Tampilkan navbar dengan style transparent atau colored
        showNavbar(isTransparent = false) {
            this.navbar.classList.remove('navbar-hidden');
            if (isTransparent) {
                this.navbar.classList.add('navbar-transparent');
                this.navbar.classList.remove('navbar-colored');
            } else {
                this.navbar.classList.remove('navbar-transparent');
                this.navbar.classList.add('navbar-colored');
            }
        }

        // Tambahkan smooth scrolling untuk semua link internal
        addSmoothScrolling() {
            const links = document.querySelectorAll('.nav-menu a, .btn-outlined, .footer-column a');
            
            links.forEach(anchor => {
                anchor.addEventListener('click', (e) => {
                    const targetId = anchor.getAttribute('href');
                    
                    // Cek apakah link adalah internal anchor (#)
                    if (targetId && targetId.startsWith('#')) {
                        e.preventDefault();
                        const targetElement = document.querySelector(targetId);
                        
                        if (targetElement) {
                            // Beri background navbar agar konsisten
                            this.showNavbar(false);

                            // Hitung posisi dengan offset navbar
                            const yOffset = -this.navbar.offsetHeight;
                            const y = targetElement.getBoundingClientRect().top + window.pageYOffset + yOffset;

                            // Smooth scroll ke target
                            window.scrollTo({ top: y, behavior: 'smooth' });
                        }
                    }
                });
            });
        }
    }


    // ============================================================================
    // SECTION: GENERAL SCROLL ANIMATIONS
    // Animasi umum untuk berbagai elemen saat scroll (fade in, scale, dll)
    // Berlaku untuk: Hero, Cards, Form Section, Location Section
    // ============================================================================
    function initGeneralScrollAnimations() {
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Animasi masuk berdasarkan class elemen
                    const element = entry.target;
                    element.classList.add('animated');
                    
                    // Tentukan jenis animasi berdasarkan class
                    if (element.classList.contains('hero-content')) {
                        element.classList.add('fade-in-left');
                    } else if (element.classList.contains('hero-image')) {
                        element.classList.add('fade-in-right');
                    } else if (element.classList.contains('card')) {
                        element.classList.add('scale-in');
                    } else if (element.classList.contains('form-section')) {
                        element.classList.add('fade-in-left');
                    } else if (element.classList.contains('location-section')) {
                        element.classList.add('fade-in-right');
                    } else {
                        element.classList.add('slide-up-fade');
                    }
                } else {
                    // Reset animasi saat keluar viewport (smooth transition)
                    const element = entry.target;
                    element.classList.remove(
                        'animated', 
                        'fade-in-up', 
                        'fade-in-left', 
                        'fade-in-right', 
                        'fade-in-down', 
                        'scale-in', 
                        'slide-up-fade'
                    );
                }
            });
        }, observerOptions);

        // Observe semua elemen dengan class animate-on-scroll
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        animatedElements.forEach(el => {
            if (el) observer.observe(el);
        });
    }


    // ============================================================================
    // SECTION: CONTACT FORM HANDLER
    // Handle submit form kontak dengan animasi button
    // ============================================================================
    function initContactForm() {
        const contactForm = document.getElementById('contactForm');
        
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Animasi button saat submit
                const submitBtn = this.querySelector('.submit-btn');
                if (submitBtn) {
                    submitBtn.style.transform = 'scale(0.95)';
                    
                    setTimeout(() => {
                        submitBtn.style.transform = 'scale(1)';
                        alert('Terima kasih! Pesan Anda telah terkirim.');
                        this.reset();
                    }, 200);
                }
            });
        }
    }


    // ============================================================================
    // SECTION: SOCIAL MEDIA INTERACTIONS
    // Handle click pada social media icons dengan animasi
    // ============================================================================
    function initSocialMediaIcons() {
        const socialIcons = document.querySelectorAll('.social-icon');
        
        socialIcons.forEach(icon => {
            icon.addEventListener('click', function(e) {
                const iconElement = this.querySelector('i');
                if (!iconElement) return;
                
                const iconClass = iconElement.className;
                let platform = '';
                
                // Deteksi platform berdasarkan class
                if (iconClass.includes('facebook')) platform = 'Facebook';
                else if (iconClass.includes('twitter')) platform = 'Twitter';
                else if (iconClass.includes('instagram')) platform = 'Instagram';
                else if (iconClass.includes('linkedin')) platform = 'LinkedIn';
                
                // Pulse animation saat klik
                this.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
                
                console.log(`Clicked ${platform} icon`);
            });
        });
    }


    // ============================================================================
    // SECTION: TENTANG (ABOUT) - SCROLL PARALLAX ANIMATION
    // Animasi parallax kompleks untuk section "Tentang"
    // Elemen: gambar, content, badge, title, description, angka, stats
    // ============================================================================
    function handleTentangScrollAnimations() {
        const tentangSection = document.getElementById('tentang');
        if (!tentangSection) return;

        const scrolled = window.pageYOffset;
        const tentangImage = document.querySelector('.tentang-image');
        const tentangContent = document.querySelector('.tentang-content');
        const tentangBadge = document.querySelector('.tentang-badge');
        const tentangTitle = document.querySelector('.tentang-title');
        const tentangDescription = document.querySelector('.tentang-description');
        const tentangAngka = document.querySelector('.tentang-angka');
        const tentangLine = document.querySelector('.tentang-line');
        
        // Validasi elemen ada
        if (!tentangImage || !tentangContent) return;
        
        const sectionTop = tentangSection.offsetTop;
        const sectionHeight = tentangSection.offsetHeight;
        const windowHeight = window.innerHeight;
        
        // Hitung progress scroll untuk section (-0.2 sampai 1.5 untuk range yang luas)
        const scrollStart = sectionTop - windowHeight * 1.2;
        const scrollEnd = sectionTop + sectionHeight;
        const totalDistance = scrollEnd - scrollStart;
        const scrollProgress = (scrolled - scrollStart) / totalDistance;
        
        // Progress untuk animasi masuk (0-1)
        const inProgress = Math.max(0, Math.min(1, scrollProgress * 1.8));
        // Progress untuk animasi keluar (0-1) saat scroll melewati section
        const outProgress = Math.max(0, Math.min(1, (scrollProgress - 0.7) * 3));
        
        // === ANIMASI GAMBAR PARALLAX ===
        const imageStart = -1000;
        const imageMiddle = 350;
        const imageEnd = 1000;
        
        let imageTranslate;
        if (scrollProgress <= 0.7) {
            // Fase masuk: dari atas ke posisi normal
            imageTranslate = imageStart + (imageMiddle - imageStart) * (scrollProgress / 0.7);
        } else {
            // Fase keluar: dari posisi normal turun terus
            imageTranslate = imageMiddle + (imageEnd - imageMiddle) * outProgress;
        }
        
        tentangImage.style.transform = `translateY(${imageTranslate}px)`;
        
        // === ANIMASI CONTENT (mulai setelah gambar 50% sampai) ===
        const contentStartProgress = 0.5;
        const contentProgress = Math.max(0, Math.min(1, (inProgress - contentStartProgress) / (1 - contentStartProgress)));
        
        // Content container - keluar ke kiri saat scroll ke bawah
        const contentOpacity = Math.max(0, contentProgress - outProgress);
        const contentTranslateX = -50 + (50 * contentProgress) - (100 * outProgress);
        tentangContent.style.opacity = contentOpacity;
        tentangContent.style.transform = `translateX(${contentTranslateX}px)`;
        
        // === ANIMASI INDIVIDUAL ELEMENTS ===
        const elements = [
            { el: tentangBadge, delay: 0.0 },
            { el: tentangTitle, delay: 0.1 },
            { el: tentangDescription, delay: 0.2 }
        ];
        
        elements.forEach(({ el, delay }) => {
            if (!el) return;
            const elementProgress = Math.max(0, Math.min(1, (contentProgress - delay) / 0.3));
            const elementOpacity = Math.max(0, elementProgress - outProgress);
            const elementTranslateY = 30 - (30 * elementProgress) + (50 * outProgress);
            
            el.style.opacity = elementOpacity;
            el.style.transform = `translateY(${elementTranslateY}px)`;
        });

        // === ANIMASI KHUSUS UNTUK TENTANG-ANGKA ===
        if (tentangAngka) {
            const angkaProgress = Math.max(0, Math.min(1, (contentProgress - 0.3) / 0.3));
            
            // Container tentang-angka
            const angkaOpacity = Math.max(0, angkaProgress - outProgress);
            const angkaTranslateY = 30 - (30 * angkaProgress) + (50 * outProgress);
            tentangAngka.style.opacity = angkaOpacity;
            tentangAngka.style.transform = `translateY(${angkaTranslateY}px)`;
            
            // Gambar angka.png (slide dari kiri)
            const angkaImage = document.querySelector('.tentang-angka .placeholder-img');
            if (angkaImage) {
                const angkaImageOpacity = Math.max(0, angkaProgress - outProgress);
                const angkaImageTranslateX = -30 + (30 * angkaProgress) - (80 * outProgress);
                angkaImage.style.opacity = angkaImageOpacity;
                angkaImage.style.transform = `translateX(${angkaImageTranslateX}px)`;
            }
            
            // Text "Kota Tersedia" (sedikit delay)
            const angkaText = document.querySelector('.tentang-angka-text');
            if (angkaText) {
                const textProgress = Math.max(0, Math.min(1, (contentProgress - 0.4) / 0.3));
                const textOpacity = Math.max(0, textProgress - outProgress);
                const textTranslateY = 30 - (30 * textProgress) + (50 * outProgress);
                angkaText.style.opacity = textOpacity;
                angkaText.style.transform = `translateY(${textTranslateY}px)`;
            }
        }
        
        // === ANIMASI LINE ===
        if (tentangLine) {
            const lineProgress = Math.max(0, Math.min(1, (contentProgress - 0.6) / 0.2));
            const lineOpacity = Math.max(0, lineProgress - outProgress);
            
            if (lineProgress > 0.1) {
                tentangLine.classList.add('animate');
                tentangLine.style.opacity = Math.max(0, lineOpacity);
            } else {
                tentangLine.classList.remove('animate');
                tentangLine.style.opacity = 0;
            }
        }
        
        // === ANIMASI STATS ===
        const statsContainer = document.getElementById('stats');
        if (statsContainer) {
            const statsProgress = Math.max(0, Math.min(1, (contentProgress - 0.2) / 0.2));
            const statsOpacity = Math.max(0, statsProgress - outProgress);
            const statsTranslateY = 50 - (50 * statsProgress) + (100 * outProgress);
            
            if (statsProgress > 0.1) {
                statsContainer.classList.add('animate');
                statsContainer.style.opacity = Math.max(0, statsOpacity);
                statsContainer.style.transform = `translateY(${statsTranslateY}px)`;
            } else {
                statsContainer.classList.remove('animate');
                statsContainer.style.opacity = 0;
                statsContainer.style.transform = `translateY(50px)`;
            }
        }
    }


    // ============================================================================
    // SECTION: STATS COUNTER ANIMATION
    // Animasi counting untuk angka statistik (10K+, 24/7, dll)
    // ============================================================================
    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const increment = target / (duration / 16); // 60fps
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            // Format angka untuk display
            if (target === 10000) {
                element.textContent = Math.floor(current / 1000) + 'K+';
            } else if (target === 24) {
                element.textContent = Math.floor(current) + '/7';
            } else {
                element.textContent = Math.floor(current) + '+';
            }
        }, 16);
    }

    function initStatsObserver() {
        const statsContainer = document.getElementById('stats');
        if (!statsContainer) return;

        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const statsContainer = entry.target;
                const statItems = statsContainer.querySelectorAll('.stat-item');
                
                if (entry.isIntersecting) {
                    // Animasi masuk viewport
                    statItems.forEach((item, index) => {
                        // Delay untuk efek berurutan
                        setTimeout(() => {
                            item.classList.add('animate');
                            
                            // Mulai animasi counter
                            const counter = item.querySelector('h3');
                            const target = parseInt(counter.dataset.target);
                            
                            if (target) {
                                animateCounter(counter, target, 2000);
                            }
                        }, index * 200);
                    });
                } else {
                    // Reset saat keluar dari viewport
                    statItems.forEach(item => {
                        item.classList.remove('animate');
                        const counter = item.querySelector('h3');
                        const target = parseInt(counter.dataset.target);
                        
                        // Reset counter ke nilai awal
                        if (target === 10000) {
                            counter.textContent = '0K+';
                        } else if (target === 24) {
                            counter.textContent = '0/7';
                        } else if (target) {
                            counter.textContent = '0+';
                        }
                    });
                }
            });
        }, observerOptions);

        observer.observe(statsContainer);
    }


    // ============================================================================
    // SECTION: TESTIMONI - INFINITE SCROLL CAROUSEL
    // Auto-scrolling horizontal carousel dengan animasi masuk/keluar
    // ============================================================================
    function initTestimoniCarousel() {
        const testimoniSection = document.querySelector('.section-testimoni');
        const testimoniGrid = document.querySelector('.testimoni-grid');
        const testimoniContainer = document.querySelector('.testimoni-container');
        const testimoniCards = document.querySelectorAll('.testimoni-card');
        const sectionTitle = document.querySelector('.section-title');
        const sectionSubtitle = document.querySelector('.section-subtitle');
        
        if (!testimoniGrid || testimoniCards.length === 0) return;
        
        // State variables
        let scrollPosition = 0;
        const cardWidth = 320;
        const totalWidth = cardWidth * testimoniCards.length;
        let isAutoScrolling = true;
        let userInteracting = false;
        let autoScrollStarted = false;
        let isAnimatingOut = false;
        let cardsCloned = false;
        
        // Sembunyikan scrollbar
        testimoniContainer.style.overflowX = 'hidden';
        
        // Clone cards untuk infinite scroll (dipanggil setelah animasi masuk selesai)
        function cloneCardsForInfiniteScroll() {
            if (cardsCloned) return;
            
            testimoniCards.forEach(card => {
                const clone = card.cloneNode(true);
                testimoniGrid.appendChild(clone);
            });
            
            cardsCloned = true;
        }
        
        // === INTERSECTION OBSERVER ===
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.2
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Masuk viewport - ANIMATE IN
                    if (isAnimatingOut) {
                        clearTimeout(window.animationTimeout);
                        isAnimatingOut = false;
                    }
                    
                    setTimeout(() => animateIn(), 100);
                    
                    // Mulai auto scroll hanya sekali
                    if (!autoScrollStarted) {
                        setTimeout(() => {
                            autoScroll();
                            autoScrollStarted = true;
                        }, 2500);
                    }
                    
                } else {
                    // Keluar viewport - ANIMATE OUT
                    if (!isAnimatingOut) {
                        isAnimatingOut = true;
                        animateOut();
                    }
                }
            });
        }, observerOptions);
        
        observer.observe(testimoniSection);
        
        // === ANIMATE IN ===
        function animateIn() {
            console.log('Testimoni: Animating IN');
            isAnimatingOut = false;
            resetToInitialState();
            
            // Sequence animasi masuk
            setTimeout(() => testimoniSection.classList.add('animate-in'), 50);
            setTimeout(() => sectionTitle.classList.add('animate-in'), 200);
            setTimeout(() => sectionSubtitle.classList.add('animate-in'), 400);
            setTimeout(() => testimoniContainer.classList.add('animate-in'), 600);
            
            // Animate cards berurutan
            const allCards = document.querySelectorAll('.testimoni-card');
            allCards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('animate-in');
                }, 800 + (index * 150));
            });
            
            // Clone cards setelah animasi selesai
            const lastCardDelay = 800 + (testimoniCards.length * 150) + 500;
            setTimeout(() => cloneCardsForInfiniteScroll(), lastCardDelay);
            
            // Pulse effect
            setTimeout(() => {
                testimoniSection.classList.add('pulse');
                setTimeout(() => testimoniSection.classList.remove('pulse'), 2000);
            }, 2500);
        }
        
        // === ANIMATE OUT ===
        function animateOut() {
            console.log('Testimoni: Animating OUT');
            
            // Sequence animasi keluar (reverse order)
            const allCards = document.querySelectorAll('.testimoni-card');
            allCards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.remove('animate-in');
                    card.classList.add('animate-out');
                }, index * 100);
            });
            
            setTimeout(() => {
                testimoniContainer.classList.remove('animate-in');
                testimoniContainer.classList.add('animate-out');
            }, 600);
            
            setTimeout(() => {
                sectionSubtitle.classList.remove('animate-in');
                sectionSubtitle.classList.add('animate-out');
            }, 800);
            
            setTimeout(() => {
                sectionTitle.classList.remove('animate-in');
                sectionTitle.classList.add('animate-out');
            }, 1000);
            
            setTimeout(() => {
                testimoniSection.classList.remove('animate-in', 'pulse');
                testimoniSection.classList.add('animate-out');
            }, 1200);
            
            window.animationTimeout = setTimeout(() => cleanupAfterAnimateOut(), 1800);
        }
        
        // === HELPER FUNCTIONS ===
        function resetToInitialState() {
            testimoniSection.classList.remove('animate-in', 'animate-out', 'pulse');
            sectionTitle.classList.remove('animate-in', 'animate-out');
            sectionSubtitle.classList.remove('animate-in', 'animate-out'); 
            testimoniContainer.classList.remove('animate-in', 'animate-out');
            
            const allCards = document.querySelectorAll('.testimoni-card');
            allCards.forEach(card => {
                card.classList.remove('animate-in', 'animate-out');
            });
        }
        
        function cleanupAfterAnimateOut() {
            resetToInitialState();
            
            // Hapus cloned cards
            if (cardsCloned) {
                const allCards = document.querySelectorAll('.testimoni-card');
                for (let i = testimoniCards.length; i < allCards.length; i++) {
                    allCards[i].remove();
                }
                cardsCloned = false;
                scrollPosition = 0;
                testimoniGrid.style.transform = 'translateX(0)';
            }
        }
        
        // === AUTO SCROLL ===
        function autoScroll() {
            if (isAutoScrolling && !userInteracting) {
                scrollPosition += 0.5;
                
                if (scrollPosition >= totalWidth) {
                    scrollPosition = 0;
                }
                
                testimoniGrid.style.transform = `translateX(-${scrollPosition}px)`;
            }
            
            requestAnimationFrame(autoScroll);
        }
        
        function pauseAutoScroll() {
            userInteracting = true;
        }
        
        function resumeAutoScroll() {
            userInteracting = false;
        }
        
        // === EVENT LISTENERS ===
        // Hover events
        testimoniGrid.addEventListener('mouseenter', pauseAutoScroll);
        testimoniGrid.addEventListener('mouseleave', resumeAutoScroll);
        
        document.querySelectorAll('.testimoni-card').forEach(card => {
            card.addEventListener('mouseenter', pauseAutoScroll);
            card.addEventListener('mouseleave', resumeAutoScroll);
        });
        
        // Mouse wheel scroll
        testimoniContainer.addEventListener('wheel', function(e) {
            e.preventDefault();
            pauseAutoScroll();
            
            const scrollSpeed = 2;
            scrollPosition += e.deltaY * scrollSpeed;
            
            if (scrollPosition < 0) {
                scrollPosition = totalWidth - Math.abs(scrollPosition % totalWidth);
            } else if (scrollPosition >= totalWidth) {
                scrollPosition = scrollPosition % totalWidth;
            }
            
            testimoniGrid.style.transform = `translateX(-${scrollPosition}px)`;
            setTimeout(resumeAutoScroll, 1000);
        });
        
        // Touch events untuk mobile
        let startX = 0;
        let isDragging = false;
        
        testimoniContainer.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            isDragging = true;
            pauseAutoScroll();
        }, { passive: true });
        
        testimoniContainer.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            
            const currentX = e.touches[0].clientX;
            const diff = startX - currentX;
            scrollPosition += diff * 0.5;
            
            if (scrollPosition < 0) {
                scrollPosition = totalWidth - Math.abs(scrollPosition % totalWidth);
            } else if (scrollPosition >= totalWidth) {
                scrollPosition = scrollPosition % totalWidth;
            }
            
            testimoniGrid.style.transform = `translateX(-${scrollPosition}px)`;
            startX = currentX;
        }, { passive: true });
        
        testimoniContainer.addEventListener('touchend', function() {
            isDragging = false;
            setTimeout(resumeAutoScroll, 1000);
        }, { passive: true });
        
        // Mouse drag support
        let mouseStartX = 0;
        let isMouseDragging = false;
        
        testimoniContainer.addEventListener('mousedown', function(e) {
            mouseStartX = e.clientX;
            isMouseDragging = true;
            pauseAutoScroll();
            testimoniContainer.style.cursor = 'grabbing';
        });
        
        document.addEventListener('mousemove', function(e) {
            if (!isMouseDragging) return;
            
            const currentX = e.clientX;
            const diff = mouseStartX - currentX;
            scrollPosition += diff * 0.8;
            
            if (scrollPosition < 0) {
                scrollPosition = totalWidth - Math.abs(scrollPosition % totalWidth);
            } else if (scrollPosition >= totalWidth) {
                scrollPosition = scrollPosition % totalWidth;
            }
            
            testimoniGrid.style.transform = `translateX(-${scrollPosition}px)`;
            mouseStartX = currentX;
        });
        
        document.addEventListener('mouseup', function() {
            if (isMouseDragging) {
                isMouseDragging = false;
                testimoniContainer.style.cursor = 'grab';
                setTimeout(resumeAutoScroll, 1000);
            }
        });
    }


    // ============================================================================
    // SECTION: AUTHENTICATION CHECK
    // Cek status login user dan handle redirect untuk protected actions
    // CATATAN: Menggunakan Laravel blade syntax untuk IS_LOGGED_IN
    // ============================================================================
    // Flag login dari Laravel (akan di-inject oleh blade)
    // const IS_LOGGED_IN = @json(auth()->check());

    function isUserLoggedIn() {
        // Return IS_LOGGED_IN jika sudah di-define oleh Laravel
        return typeof IS_LOGGED_IN !== 'undefined' ? IS_LOGGED_IN : false;
    }

    // Check login untuk button "Lihat Lainnya"
    function checkLoginLainnya(event) {
        event.preventDefault();
        
        if (!isUserLoggedIn()) {
            Swal.fire({
                icon: 'warning',
                title: 'Login Diperlukan',
                text: 'Silakan login terlebih dahulu untuk melihat daftar kosan lengkap',
                confirmButtonText: 'Login Sekarang',
                confirmButtonColor: '#E93B81',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                cancelButtonColor: '#6b7280'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke route login Laravel
                    // window.location.href = "{{ route('login') }}";
                    window.location.href = "/login";
                }
            });
        } else {
            // User sudah login, redirect ke daftar kosan
            // window.location.href = "{{ route('kosan.index') }}";
            window.location.href = "/kosan";
        }
    }

    // Check login untuk click pada card kosan
    function checkLoginCard(event, kosId) {
        event.preventDefault();
        
        if (!isUserLoggedIn()) {
            Swal.fire({
                icon: 'info',
                title: 'Login Diperlukan',
                text: 'Silakan login terlebih dahulu untuk melihat detail kosan',
                confirmButtonText: 'Login Sekarang',
                confirmButtonColor: '#E93B81',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                cancelButtonColor: '#6b7280'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke login dengan parameter redirect
                    // window.location.href = "{{ route('login') }}?redirect=" + encodeURIComponent(window.location.pathname);
                    window.location.href = "/login?redirect=" + encodeURIComponent(window.location.pathname);
                }
            });
        } else {
            // User sudah login, redirect ke detail kosan
            // window.location.href = "{{ url('kosan') }}/" + kosId;
            window.location.href = "/kosan/" + kosId;
        }
    }


    // ============================================================================
    // INITIALIZATION - DOMContentLoaded
    // Inisialisasi semua fungsi setelah DOM siap
    // ============================================================================
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Landing Page: Initializing...');
        
        // 1. Inisialisasi Navbar Controller
        new NavbarController();
        
        // 2. Inisialisasi General Scroll Animations
        initGeneralScrollAnimations();
        
        // 3. Inisialisasi Contact Form
        initContactForm();
        
        // 4. Inisialisasi Social Media Icons
        initSocialMediaIcons();
        
        // 5. Inisialisasi Stats Observer
        initStatsObserver();
        
        // 6. Inisialisasi Testimoni Carousel
        initTestimoniCarousel();
        
        // 7. Setup Tentang Section Scroll Listeners
        window.addEventListener('scroll', handleTentangScrollAnimations);
        window.addEventListener('resize', handleTentangScrollAnimations);
        
        // Inisial setup untuk Tentang section
        handleTentangScrollAnimations();
        
        console.log('Landing Page: All initialized successfully!');
    });


    // ============================================================================
    // EXPOSE GLOBAL FUNCTIONS
    // Fungsi yang perlu diakses dari HTML (onclick, etc)
    // ============================================================================
    window.checkLoginLainnya = checkLoginLainnya;
    window.checkLoginCard = checkLoginCard;
    </script>
</body>
</html>