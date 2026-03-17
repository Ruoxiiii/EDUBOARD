document.addEventListener('DOMContentLoaded', () => {
    const viewPlansBtn  = document.getElementById('viewPlansBtn');
    const plansOverlay  = document.getElementById('plansOverlay');
    const closePlansBtn = document.getElementById('closePlansBtn');

    if (viewPlansBtn) {
        viewPlansBtn.addEventListener('click', () => {
            plansOverlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    }

    if (closePlansBtn) {
        closePlansBtn.addEventListener('click', () => {
            plansOverlay.classList.remove('show');
            document.body.style.overflow = '';
        });
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && plansOverlay.classList.contains('show')) {
            plansOverlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
});
