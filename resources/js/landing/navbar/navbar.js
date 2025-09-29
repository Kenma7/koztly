        document.querySelectorAll('.nav-menu a').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId.startsWith('#')) {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Add button click animations
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                console.log('Button clicked:', this.textContent);
            });
        });