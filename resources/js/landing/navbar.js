/**
 * NAVBAR CONTROLLER
 * Mengatur behavior navbar: transparansi, sticky, smooth scroll
 * Digunakan di: Semua halaman dengan navbar
 */

class NavbarController {
    constructor() {
        this.navbar = document.getElementById('navbar');
        this.heroSection = this.findHeroSection();
        this.init();
    }

    // Cari hero section atau section pertama
    findHeroSection() {
        let heroSection = document.getElementById('beranda');
        if (!heroSection) {
            const sections = document.querySelectorAll('section');
            if (sections.length > 0) heroSection = sections[0];
        }
        return heroSection;
    }

    init() {
        window.addEventListener('scroll', this.handleScroll.bind(this));
        this.addSmoothScrolling();
        this.handleScroll(); // Cek posisi awal
    }

    handleScroll() {
        if (!this.heroSection) {
            this.showNavbar(false);
            return;
        }

        const scrollY = window.scrollY;

        // Begitu scroll > 0, navbar dapat background
        if (scrollY > 0) {
            this.showNavbar(false); // Dengan background
        } else {
            this.showNavbar(true); // Transparan
        }
    }

    hideNavbar() {
        this.navbar.classList.add('navbar-hidden');
    }

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

    addSmoothScrolling() {
        // Smooth scroll untuk semua anchor links
        document.querySelectorAll('.nav-menu a, .btn-outlined, .footer-column a').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                const targetId = anchor.getAttribute('href');
                if (targetId && targetId.startsWith('#')) {
                    e.preventDefault();
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        this.showNavbar(false);

                        const yOffset = -this.navbar.offsetHeight;
                        const y = targetElement.getBoundingClientRect().top + window.pageYOffset + yOffset;

                        window.scrollTo({ top: y, behavior: 'smooth' });
                    }
                }
            });
        });
    }
}

// Inisialisasi setelah DOM ready
document.addEventListener('DOMContentLoaded', () => {
    new NavbarController();
});