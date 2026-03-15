// ── Date Filter ──
const dateFrom = document.getElementById('dateFrom');
const dateTo = document.getElementById('dateTo');
const applyBtn = document.getElementById('applyDateFilter');
const clearBtn = document.getElementById('clearDateFilter');
const allCards = document.querySelectorAll('.ann-card');
const emptyStateDateFilter = document.querySelector('.empty-state');

function getCardDate(card) {
    const dateEl = card.querySelector('.ann-author span:nth-child(2)');
    if (!dateEl) return null;
    const text = dateEl.textContent.trim();
    // Parse YYYY-MM-DD format
    const match = text.match(/\d{4}-\d{2}-\d{2}/);
    if (!match) return null;
    return match[0]; // return as string e.g. "2026-03-08"
}

function applyDateFilter() {
    const from = dateFrom.value; // "2026-03-01" or ""
    const to = dateTo.value;     // "2026-03-10" or ""

    if (!from && !to) return;

    let visibleCount = 0;

    allCards.forEach(card => {
        const cardDateStr = getCardDate(card);
        if (!cardDateStr) {
            card.style.display = 'none';
            return;
        }

        let show = true;

        // If only From is set — show only that exact day
        if (from && !to) {
            show = cardDateStr === from;
        }

        // If only To is set — show up to that day
        if (!from && to) {
            show = cardDateStr <= to;
        }

        // If both are set — show range
        if (from && to) {
            show = cardDateStr >= from && cardDateStr <= to;
        }

        card.style.display = show ? 'block' : 'none';
        if (show) visibleCount++;
    });

    if (emptyStateDateFilter) {
        emptyStateDateFilter.style.display = visibleCount === 0 ? 'flex' : 'none';
    }
}

function clearDateFilter() {
    dateFrom.value = '';
    dateTo.value = '';

    allCards.forEach(card => {
        card.style.display = 'block';
    });

    if (emptyStateDateFilter) {
        emptyStateDateFilter.style.display = 'none';
    }
}

applyBtn.addEventListener('click', applyDateFilter);
clearBtn.addEventListener('click', clearDateFilter);