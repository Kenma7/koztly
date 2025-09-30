<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koztly - Loading</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            overflow: hidden;
            background: #FFE5E2;
        }

        .loading-container {
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .logo-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .logo-wrapper:hover {
            transform: scale(1.05);
        }

        .k-logo {
            width: 160px;
            height: 160px;
            opacity: 0;
            transform: translateY(100px);
            animation: slideUpFromShadow 1s ease-out 0.5s forwards,
                slideToLeft 0.8s ease-out 2s forwards;
            z-index: 2;
        }

        .koztly-logo {
            width: 170px;
            height: 170px;
            position: absolute;
            opacity: 0;
            transform: translateX(-30px);
            /* Start from K position after it moves left */
            animation: slideOutFromK 1s ease-out 3s forwards;
            z-index: 1;
        }

        .expand-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: white;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            animation: expandCircle 1.5s ease-out 5s forwards;
        }

        @keyframes slideUpFromShadow {
            0% {
                opacity: 0;
                transform: translateY(100px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideToLeft {
            0% {
                transform: translateY(0) translateX(0);
            }

            100% {
                transform: translateY(0) translateX(-70px);
            }
        }

        @keyframes slideOutFromK {
            0% {
                opacity: 0;
                transform: translateX(-50px);
            }

            100% {
                opacity: 1;
                transform: translateX(70px);
            }
        }

        @keyframes expandCircle {
            0% {
                width: 0;
                height: 0;
                opacity: 1;
            }

            50% {
                opacity: 1;
            }

            100% {
                width: 300vw;
                height: 300vw;
                opacity: 1;
            }
        }

        @keyframes showLandingPage {
            to {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .k-logo {
                width: 60px;
                height: 60px;
            }

            .koztly-logo {
                width: 150px;
                height: 45px;
                transform: translateX(-30px);
                /* Adjust for mobile */
            }

            @keyframes slideOutFromK {
                0% {
                    opacity: 0;
                    transform: translateX(-15px);
                }

                100% {
                    opacity: 1;
                    transform: translateX(50px);
                }
            }

            .landing-content h1 {
                font-size: 2rem;
            }

            .landing-content p {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="loading-container">
        <!-- Logo Wrapper for interaction -->
        <div class="logo-wrapper" onclick="skipToLandingPage()">
            <!-- K Logo -->
            <div class="k-logo">
                <img src="images/k.png" alt="K Logo" style="width: 100%; height: 100%; object-fit: contain;">
            </div>

            <!-- Koztly Logo - positioned absolutely to slide out from K -->
            <div class="koztly-logo">
                <img src="images/koztly.png" alt="Koztly Logo" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
        </div>

        <!-- Expanding circle -->
        <div class="expand-circle"></div>
    </div>

    <script>
        // Prevent scrolling during loading
        document.body.style.overflow = 'hidden';

        let animationCompleted = false;

        // Function to skip to landing page
        function skipToLandingPage() {
            if (!animationCompleted && document.querySelector('.koztly-logo').style.opacity !== '0') {
                // Redirect to landing.blade.php
                window.location.href = 'landing';
            }
        }

        // Auto redirect after animation completes
        setTimeout(() => {
            if (!animationCompleted) {
                window.location.href = 'landing';
            }
        }, 6500);

        // Add click handler for CTA button
        document.querySelector('.cta-button').addEventListener('click', function () {
            window.location.href = 'landing';
        });

        // Optional: Add some interactive particles or additional effects
        function createParticle() {
            const particle = document.createElement('div');
            particle.style.cssText = `
                position: absolute;
                width: 4px;
                height: 4px;
                background: rgba(255,255,255,0.6);
                border-radius: 50%;
                pointer-events: none;
                animation: float 3s linear infinite;
            `;

            particle.style.left = Math.random() * window.innerWidth + 'px';
            particle.style.top = window.innerHeight + 'px';

            document.body.appendChild(particle);

            setTimeout(() => {
                particle.remove();
            }, 1000);
        }

        // Create floating particles after landing page appears
        setTimeout(() => {
            setInterval(createParticle, 500);
        }, 1000);

        // Add floating animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                to {
                    transform: translateY(-${window.innerHeight + 50}px) rotate(360deg);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>