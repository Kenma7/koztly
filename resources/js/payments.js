let currentBookingId = null;

function openUploadModal(bookingId) {
    currentBookingId = bookingId;
    const form = document.getElementById('upload-form');
    form.action = `/booking/${bookingId}/upload-bukti`;
    document.getElementById('upload-modal').classList.remove('hidden');
}

function closeUploadModal() {
    document.getElementById('upload-modal').classList.add('hidden');
    currentBookingId = null;
}

// Close modal ketika klik outside
document.getElementById('upload-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeUploadModal();
    }
});