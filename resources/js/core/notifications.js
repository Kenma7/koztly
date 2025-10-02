// Notifications System
class NotificationSystem {
    static initSweetAlerts() {
        if (window.sweetSuccess) {
            Swal.fire({
                icon: 'success',
                title: window.sweetSuccess,
                timer: 3000,
                showConfirmButton: false,
                position: 'top-end',
                toast: true
            });
            this.clearSessionData(); // CLEAR SESSION SETELAH DITAMPILKAN
        }

        if (window.sweetError) {
            Swal.fire({
                icon: 'error',
                title: window.sweetError,
                timer: 4000,
                showConfirmButton: true
            });
            this.clearSessionData();
        }

        if (window.sweetWarning) {
            Swal.fire({
                icon: 'warning',
                title: window.sweetWarning,
                timer: 4000,
                showConfirmButton: false,
                position: 'top-end',
                toast: true
            });
            this.clearSessionData();
        }
    }

    static initSimpleAlerts() {
        const alerts = document.querySelectorAll('.alert-auto-close');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s';
                setTimeout(() => alert.remove(), 500);
            }, 4000); // AUTO CLOSE AFTER 4 SECONDS
        });

        // Clear session data setelah alert hilang
        setTimeout(() => {
            this.clearSessionData();
        }, 4500);
    }

    // Clear session data dari window
    static clearSessionData() {
        // Hapus data dari window object
        window.sweetSuccess = undefined;
        window.sweetError = undefined; 
        window.sweetWarning = undefined;
        
        // Hapus dari sessionStorage juga
        sessionStorage.removeItem('sweetSuccess');
        sessionStorage.removeItem('sweetError');
        sessionStorage.removeItem('sweetWarning');
    }
}

// Auto initialize
document.addEventListener('DOMContentLoaded', function() {
    NotificationSystem.initSweetAlerts();
    NotificationSystem.initSimpleAlerts();
});

window.NotificationSystem = NotificationSystem;