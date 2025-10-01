<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Koztly</title>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&family=Dancing+Script&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Navigation Styles */
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
            animation: slideDown 1s ease 0.2s forwards;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 1;
        }

        /* Navbar saat di luar hero section - HIDDEN */
        .navbar.hidden {
            opacity: 0;
            transform: translateY(-100%);
            pointer-events: none;
        }

        /* Navbar saat di-hover - VISIBLE */
        .navbar.hidden:hover {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        /* Area trigger untuk navbar */
        .navbar-trigger {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 30px;
            z-index: 999;
            background: transparent;
        }

        .navbar-trigger:hover ~ .navbar.hidden {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .nav-menu {
            display: flex;
            gap: 25px;
            list-style: none;
        }

        .nav-menu li {
            position: relative;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeInUp 0.6s ease forwards;
        }

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

        .auth-buttons {
            display: flex;
            gap: 18px;
            align-items: center;
            margin-left: -100px;
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
            margin-right: -3px;
            opacity: 0;
            transform: translateX(30px);
            animation: slideInRight 0.6s ease forwards;
            text-decoration: none;
            display: inline-block;
            text-align: center;
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

        .logo {
            width: 120px;
            height: auto;
            opacity: 0;
            transform: scale(0.8);
            animation: zoomIn 0.8s ease 0.3s forwards;
        }

        /* Animations */
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

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

        /* Ripple Effect */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }
            
            .nav-menu {
                gap: 15px;
            }
            
            .nav-menu a {
                padding: 10px 20px;
                font-size: 14px;
            }
            
            .auth-buttons {
                margin-left: 0;
                gap: 10px;
            }
            
            .btn {
                padding: 12px 18px;
                font-size: 14px;
            }
            
            .logo {
                width: 100px;
            }

            .navbar-trigger {
                height: 20px;
            }
        }

        @media (max-width: 480px) {
            .nav-menu {
                display: none;
            }
            
            .auth-buttons {
                margin-left: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Area trigger untuk navbar -->
    <div class="navbar-trigger" id="navbarTrigger"></div>

    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="logo-container">
            <img src="images/logo.png" alt="Koztly Logo" class="logo">
        </div>

        <div class="nav-menu">
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="#testimoni">Testimoni</a></li>
            <li><a href="#kontak">Kontak</a></li>
        </div>

        <div class="auth-buttons">
            <a href="/login" class="btn btn-glass">Masuk</a>
            <a href="/register" class="btn btn-glass">Daftar</a>
        </div>
    </nav>

    <script>
        // Navbar Scroll Behavior - Standalone version
        class NavbarController {
            constructor() {
                this.navbar = document.getElementById('navbar');
                this.navbarTrigger = document.getElementById('navbarTrigger');
                this.heroSection = this.findHeroSection();
                this.isInHeroSection = true;
                
                this.init();
            }

            // Mencari hero section dari parent document
            findHeroSection() {
                // Cari section dengan ID 'beranda' atau class 'hero-section'
                let heroSection = document.getElementById('beranda');
                
                if (!heroSection) {
                    // Fallback: cari section pertama yang ada
                    const sections = document.querySelectorAll('section');
                    if (sections.length > 0) {
                        heroSection = sections[0];
                    }
                }
                
                return heroSection;
            }

            init() {
                // Add scroll event listener
                window.addEventListener('scroll', this.handleScroll.bind(this));
                
                // Add click event for smooth scrolling
                this.addSmoothScrolling();
                
                // Add button click animations
                this.addButtonAnimations();
                
                // Initial check
                this.handleScroll();
            }

            handleScroll() {
                if (!this.heroSection) {
                    console.warn('Hero section tidak ditemukan, navbar akan selalu visible');
                    this.showNavbar();
                    return;
                }

                const currentScrollY = window.scrollY;
                const heroHeight = this.heroSection.offsetHeight;
                const heroTop = this.heroSection.offsetTop;
                
                // Cek apakah masih di hero section
                const isInHero = currentScrollY >= heroTop && 
                                currentScrollY <= (heroTop + heroHeight - 100); // -100 untuk threshold
                
                if (isInHero) {
                    // Masih di hero section - navbar visible
                    if (!this.isInHeroSection) {
                        this.showNavbar();
                        this.isInHeroSection = true;
                    }
                } else {
                    // Di luar hero section - navbar hidden
                    if (this.isInHeroSection) {
                        this.hideNavbar();
                        this.isInHeroSection = false;
                    }
                }
            }

            hideNavbar() {
                this.navbar.classList.add('hidden');
            }

            showNavbar() {
                this.navbar.classList.remove('hidden');
            }

            addSmoothScrolling() {
                document.querySelectorAll('.nav-menu a').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const targetId = this.getAttribute('href');
                        if (targetId.startsWith('#')) {
                            const targetElement = document.querySelector(targetId);
                            if (targetElement) {
                                // Tampilkan navbar dulu sebelum scroll jika target adalah beranda
                                if (targetId === '#beranda') {
                                    this.showNavbar();
                                    this.isInHeroSection = true;
                                }
                                
                                targetElement.scrollIntoView({
                                    behavior: 'smooth'
                                });
                            }
                        }
                    }.bind(this));
                });
            }

            addButtonAnimations() {
                document.querySelectorAll('.btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        // Add ripple effect
                        const ripple = document.createElement('span');
                        const rect = btn.getBoundingClientRect();
                        const size = Math.max(rect.width, rect.height);
                        const x = e.clientX - rect.left - size / 2;
                        const y = e.clientY - rect.top - size / 2;
                        
                        ripple.style.width = ripple.style.height = size + 'px';
                        ripple.style.left = x + 'px';
                        ripple.style.top = y + 'px';
                        ripple.classList.add('ripple');
                        
                        btn.appendChild(ripple);
                        
                        setTimeout(() => {
                            ripple.remove();
                        }, 600);
                    });
                });
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            new NavbarController();
        });
    </script>
</body>
</html>