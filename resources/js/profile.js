// ── Delete Modal ──
const deleteAccountBtn = document.getElementById('deleteAccountBtn');
const deleteModal = document.getElementById('deleteModal');
const deleteModalOverlay = document.getElementById('deleteModalOverlay');
const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

deleteAccountBtn.addEventListener('click', () => deleteModal.classList.add('show'));
cancelDeleteBtn.addEventListener('click', () => deleteModal.classList.remove('show'));
deleteModalOverlay.addEventListener('click', () => deleteModal.classList.remove('show'));
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') deleteModal.classList.remove('show');
});