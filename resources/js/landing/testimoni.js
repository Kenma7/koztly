/**
 * TESTIMONI
 * Auto-scroll infinite carousel dengan animasi masuk/keluar
 * Digunakan di: Landing page - Section Testimoni
 */

document.addEventListener('DOMContentLoaded', function() {
    const testimoniSection = document.querySelector('.section-testimoni');
    const testimoniGrid = document.querySelector('.testimoni-grid');
    const testimoniContainer = document.querySelector('.testimoni-container');
    const testimoniCards = document.querySelectorAll('.testimoni-card');
    const sectionTitle = document.querySelector('.section-title');
    const sectionSubtitle = document.querySelector('.section-subtitle');
    
    // Validasi elemen exists
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
    
    // Clone cards untuk infinite scroll
    function cloneCardsForInfiniteScroll() {
        if (cardsCloned) return;
        
        testimoniCards.forEach(card => {
            const clone = card.cloneNode(true);
            testimoniGrid.appendChild(clone);
        });
        
        cardsCloned = true;
    }
    
    // Intersection Observer untuk trigger animasi
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
                
                setTimeout(() => {
                    animateIn();
                }, 100);
                
                // Mulai auto scroll sekali
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
    
    // ANIMATE IN - Masuk viewport
    function animateIn() {
        isAnimatingOut = false;
        resetToInitialState();
        
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
        setTimeout(() => {
            cloneCardsForInfiniteScroll();
        }, lastCardDelay);
        
        // Pulse effect
        setTimeout(() => {
            testimoniSection.classList.add('pulse');
            setTimeout(() => {
                testimoniSection.classList.remove('pulse');
            }, 2000);
        }, 2500);
    }
    
    // ANIMATE OUT - Keluar viewport
    function animateOut() {
        const allCards = document.querySelectorAll('.testimoni-card');
        allCards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.remove('animate-in');
                card.classList.add('animate-out');
            }, index * 100);
        });
        
        setTimeout(() => testimoniContainer.classList.remove('animate-in') && testimoniContainer.classList.add('animate-out'), 600);
        setTimeout(() => sectionSubtitle.classList.remove('animate-in') && sectionSubtitle.classList.add('animate-out'), 800);
        setTimeout(() => sectionTitle.classList.remove('animate-in') && sectionTitle.classList.add('animate-out'), 1000);
        setTimeout(() => testimoniSection.classList.remove('animate-in', 'pulse') && testimoniSection.classList.add('animate-out'), 1200);
        
        window.animationTimeout = setTimeout(() => {
            cleanupAfterAnimateOut();
        }, 1800);
    }
    
    // Reset state
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
    
    // Cleanup setelah animate out
    function cleanupAfterAnimateOut() {
        resetToInitialState();
        
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
    
    // Auto scroll function
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
    
    // Pause/resume functions
    function pauseAutoScroll() {
        userInteracting = true;
    }
    
    function resumeAutoScroll() {
        userInteracting = false;
    }
    
    // Event listeners - Hover
    testimoniGrid.addEventListener('mouseenter', pauseAutoScroll);
    testimoniGrid.addEventListener('mouseleave', resumeAutoScroll);
    
    testimoniCards.forEach(card => {
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
    
    // Touch support
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
});