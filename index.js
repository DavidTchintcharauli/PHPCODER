function confirmModal(message, onConfirm) {
    const modal = document.getElementById('modal');
    const messageBox = document.getElementById('modal-message');
    const confirmBtn = document.getElementById('modal-confirm');
    const cancelBtn = document.getElementById('modal-cancel');

    messageBox.textContent = message;
    modal.classList.remove('hidden');

    function cleanup() {
        modal.classList.add('hidden');
        confirmBtn.removeEventListener('click', handleConfirm);
        cancelBtn.removeEventListener('click', handleCancel);
    }

    function handleConfirm() {
        onConfirm();
        cleanup();
    }

    function handleCancel() {
        cleanup();
    }

    confirmBtn.addEventListener('click', handleConfirm);
    cancelBtn.addEventListener('click', handleCancel);
}


console.log("Hello World!");
