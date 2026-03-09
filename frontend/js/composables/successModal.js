export function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
}

export function initSuccessModal() {
    window.closeSuccessModal = closeSuccessModal;

    window.addEventListener('click', (event) => {
        const modal = document.getElementById('successModal');
        if (modal && event.target === modal) closeSuccessModal();
    });
}
