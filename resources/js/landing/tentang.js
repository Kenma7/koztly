/**
 * SECTION TENTANG ANIMATIONS
 * Parallax & scroll-triggered animations untuk section "Tentang"
 * Digunakan di: Landing page - Section Tentang
 */

// Animasi parallax yang mengikuti progress scroll
function handleScrollAnimations() {
    const scrolled = window.pageYOffset;
    const tentangSection = document.getElementById('tentang');
    
    // Validasi section exists
    if (!tentangSection) return;
    
    const tentangImage = document.querySelector('.tentang-image');
    const tentangContent = document.querySelector('.tentang-content');
    const tentangBadge = document.querySelector('.tentang-badge');
    const tentangTitle = document.querySelector('.tentang-title');
    const tentangDescription = document.querySelector('.tentang-description');
    const tentangAngka = document.querySelector('.tentang-angka');
    const tentangLine = document.querySelector('.tentang-line');
    
    const sectionTop = tentangSection.offsetTop;
    const sectionHeight = tentangSection.offsetHeight;
    const windowHeight = window.innerHeight;
    
    // Hitung progress scroll (-0.2 sampai 1.5)
    const scrollStart = sectionTop - windowHeight * 1.2;
    const scrollEnd = sectionTop + sectionHeight;
    const totalDistance = scrollEnd - scrollStart;
    const scrollProgress = (scrolled - scrollStart) / totalDistance;
    
    // Progress untuk animasi masuk (0-1)
    const inProgress = Math.max(0, Math.min(1, scrollProgress * 1.8));
    // Progress untuk animasi keluar (0-1)
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
    
    if (tentangImage) {
        tentangImage.style.transform = `translateY(${imageTranslate}px)`;
    }
    
    // === ANIMASI CONTENT ===
    const contentStartProgress = 0.5;
    const contentProgress = Math.max(0, Math.min(1, (inProgress - contentStartProgress) / (1 - contentStartProgress)));
    
    const contentOpacity = Math.max(0, contentProgress - outProgress);
    const contentTranslateX = -50 + (50 * contentProgress) - (100 * outProgress);
    
    if (tentangContent) {
        tentangContent.style.opacity = contentOpacity;
        tentangContent.style.transform = `translateX(${contentTranslateX}px)`;
    }
    
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

    // === ANIMASI TENTANG-ANGKA ===
    if (tentangAngka) {
        const angkaProgress = Math.max(0, Math.min(1, (contentProgress - 0.3) / 0.3));
        
        const angkaOpacity = Math.max(0, angkaProgress - outProgress);
        const angkaTranslateY = 30 - (30 * angkaProgress) + (50 * outProgress);
        tentangAngka.style.opacity = angkaOpacity;
        tentangAngka.style.transform = `translateY(${angkaTranslateY}px)`;
        
        // Gambar angka.png
        const angkaImage = document.querySelector('.tentang-angka .placeholder-img');
        if (angkaImage) {
            const angkaImageOpacity = Math.max(0, angkaProgress - outProgress);
            const angkaImageTranslateX = -30 + (30 * angkaProgress) - (80 * outProgress);
            angkaImage.style.opacity = angkaImageOpacity;
            angkaImage.style.transform = `translateX(${angkaImageTranslateX}px)`;
        }
        
        // Text "Kota Tersedia"
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

// Fungsi animasi counting untuk stats
function animateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16);
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

// Intersection Observer untuk stats counter
const statsObserverOptions = {
    threshold: 0.5,
    rootMargin: '0px 0px -50px 0px'
};

const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        const statsContainer = entry.target;
        const statItems = statsContainer.querySelectorAll('.stat-item');
        
        if (entry.isIntersecting) {
            // Animasi masuk viewport
            statItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('animate');
                    
                    const counter = item.querySelector('h3');
                    const target = parseInt(counter.dataset.target);
                    
                    if (target) {
                        animateCounter(counter, target, 2000);
                    }
                }, index * 200);
            });
        } else {
            // Reset saat keluar viewport
            statItems.forEach(item => {
                item.classList.remove('animate');
                const counter = item.querySelector('h3');
                const target = parseInt(counter.dataset.target);
                
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
}, statsObserverOptions);

// Event listeners
window.addEventListener('scroll', handleScrollAnimations);
window.addEventListener('resize', handleScrollAnimations);

// Inisialisasi
document.addEventListener('DOMContentLoaded', () => {
    handleScrollAnimations();
    
    setTimeout(() => {
        const stats = document.getElementById('stats');
        if (stats) {
            statsObserver.observe(stats);
        }
    }, 100);
});