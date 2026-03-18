// ── Handle notification redirect with anchor on page load ──
window.addEventListener('load', () => {
    const hash = window.location.hash;
    if (hash) {
        const targetCard = document.querySelector(hash);
        if (targetCard) {
            setTimeout(() => {
                targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                targetCard.classList.add('highlight');
                setTimeout(() => targetCard.classList.remove('highlight'), 2000);
            }, 300);
        }
    }
});

// ── Tabs & Category Filter ──
const tabs = document.querySelectorAll('.user-tab');
const pills = document.querySelectorAll('.ann-filter-pill');
const cards = document.querySelectorAll('.ann-card');
const announcementsContainer = document.querySelector('.ann-list');

const emptyState = document.createElement('div');
emptyState.classList.add('empty-state');
emptyState.innerHTML = `
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
    </svg>
    <p>No announcements found.</p>
`;
emptyState.style.display = 'none';
announcementsContainer.appendChild(emptyState);

let currentTab = 'General';

// ── Tabs ──
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        currentTab = tab.textContent.trim();

        pills.forEach(p => p.classList.remove('active'));
        document.querySelector('.ann-filter-pill[data-category="all"]').classList.add('active');

        applyFilter('all');
    });
});

// ── Category Pills ──
pills.forEach(pill => {
    pill.addEventListener('click', () => {
        pills.forEach(p => p.classList.remove('active'));
        pill.classList.add('active');

        const filter = pill.dataset.category;
        applyFilter(filter);
    });
});

// ── Filter Logic ──
function applyFilter(filter) {
    let visibleCount = 0;

    cards.forEach(card => {
        const matchesTab = currentTab === 'General' || card.dataset.forYou === 'true';
        const matchesFilter = filter === 'all' || card.dataset.category === filter;

        if (matchesTab && matchesFilter) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
}

// ── Reactions ──
document.querySelectorAll('.reaction-btn').forEach(btn => {
    const countText = btn.textContent.trim().split(' ').pop();
    btn.dataset.count = parseInt(countText);
    btn.dataset.reacted = 'false';

    btn.addEventListener('click', () => {
        const isReacted = btn.dataset.reacted === 'true';
        const currentCount = parseInt(btn.dataset.count);

        if (isReacted) {
            btn.dataset.count = currentCount - 1;
            btn.dataset.reacted = 'false';
            btn.classList.remove('reacted');
        } else {
            btn.dataset.count = currentCount + 1;
            btn.dataset.reacted = 'true';
            btn.classList.add('reacted');
        }

        const emoji = btn.querySelector('.emoji').outerHTML;
        btn.innerHTML = `${emoji} ${btn.dataset.count}`;
    });
});

// ── Media orientation helper ──
// Detects portrait/landscape after load and applies the correct frame class
function applyOrientation(mediaEl, frameEl) {
    function detect() {
        const w = mediaEl.naturalWidth  || mediaEl.videoWidth  || mediaEl.offsetWidth;
        const h = mediaEl.naturalHeight || mediaEl.videoHeight || mediaEl.offsetHeight;
        if (!w || !h) return;
        const isPortrait = h > w;
        frameEl.classList.remove('frame-landscape', 'frame-portrait');
        frameEl.classList.add(isPortrait ? 'frame-portrait' : 'frame-landscape');
    }

    if (mediaEl.tagName === 'IMG') {
        if (mediaEl.complete && mediaEl.naturalWidth) {
            detect();
        } else {
            mediaEl.addEventListener('load', detect, { once: true });
        }
    } else if (mediaEl.tagName === 'VIDEO') {
        if (mediaEl.readyState >= 1 && mediaEl.videoWidth) {
            detect();
        } else {
            mediaEl.addEventListener('loadedmetadata', detect, { once: true });
        }
    }
}

// ── Single Image/Video Modal (non-gallery media only) ──
const modal = document.createElement('div');
modal.classList.add('media-modal');
modal.innerHTML = `
    <div class="media-modal-overlay"></div>
    <div class="media-modal-content" style="flex-direction: column; align-items: center;">
        <button class="media-modal-close">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="media-modal-frame">
            <div class="media-modal-body"></div>
        </div>
    </div>
`;
document.body.appendChild(modal);

const modalFrame  = modal.querySelector('.media-modal-frame');
const modalBody   = modal.querySelector('.media-modal-body');
const modalClose  = modal.querySelector('.media-modal-close');
const modalOverlay = modal.querySelector('.media-modal-overlay');

// Wrap images/videos with hover overlay
// SKIP media inside .ann-gallery — those are handled by the gallery modal
document.querySelectorAll('.ann-image, .ann-video').forEach(media => {
    if (media.closest('.ann-gallery')) return;

    const wrapper = document.createElement('div');
    wrapper.classList.add('ann-media-wrapper');

    const overlay = document.createElement('div');
    overlay.classList.add('ann-media-overlay');
    overlay.innerHTML = `
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span>View</span>
    `;

    media.parentNode.insertBefore(wrapper, media);
    wrapper.appendChild(media);
    wrapper.appendChild(overlay);

    wrapper.addEventListener('click', () => {
        let el;
        if (media.tagName === 'IMG') {
            el = document.createElement('img');
            el.src = media.src;
            el.alt = media.alt;
        } else if (media.tagName === 'VIDEO') {
            const source = media.querySelector('source');
            const src = source ? source.src : media.src;
            el = document.createElement('video');
            el.src = src;
            el.controls = true;
            el.autoplay = true;
        }
        modalBody.innerHTML = '';
        modalBody.appendChild(el);
        applyOrientation(el, modalFrame);
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    });
});

// Close single modal
function closeModal() {
    modal.classList.remove('show');
    document.body.style.overflow = '';
    const video = modalBody.querySelector('video');
    if (video) video.pause();
    modalBody.innerHTML = '';
    modalFrame.classList.remove('frame-landscape', 'frame-portrait');
}

modalClose.addEventListener('click', closeModal);
modalOverlay.addEventListener('click', closeModal);

document.addEventListener('keydown', (e) => {
    // Only close single modal if gallery modal is NOT open
    if (e.key === 'Escape' && !galleryModal.classList.contains('show')) closeModal();
});

// ── Gallery (inline card slider) ──
document.querySelectorAll('.ann-gallery').forEach(gallery => {
    const track    = gallery.querySelector('.gallery-track');
    const prevBtn  = gallery.querySelector('.gallery-prev');
    const nextBtn  = gallery.querySelector('.gallery-next');
    const counter  = gallery.querySelector('.gallery-counter');
    const items    = gallery.querySelectorAll('.gallery-item');
    const total    = items.length;
    let current    = 0;

    function goTo(index) {
        current = index;
        track.style.transform = `translateX(-${current * 100}%)`;
        counter.textContent = `${current + 1} / ${total}`;
        prevBtn.disabled = current === 0;
        nextBtn.disabled = current === total - 1;
    }

    prevBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (current > 0) goTo(current - 1);
    });

    nextBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (current < total - 1) goTo(current + 1);
    });

    goTo(0);

    // Click gallery item to open gallery modal
    items.forEach((item, index) => {
        const media = item.querySelector('img, video');
        if (!media) return;

        item.style.cursor = 'zoom-in';
        item.addEventListener('click', (e) => {
            e.stopPropagation();
            const allMedia = [];
            items.forEach(i => {
                const m = i.querySelector('img, video');
                if (m) allMedia.push(m);
            });
            openGalleryModal(allMedia, index);
        });
    });
});

// ── Gallery Modal ──
const galleryModal = document.createElement('div');
galleryModal.classList.add('media-modal', 'gallery-modal');
galleryModal.innerHTML = `
    <div class="media-modal-overlay"></div>
    <div class="media-modal-content" style="flex-direction: column; align-items: center;">
        <button class="media-modal-close">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="media-modal-frame">
            <div class="media-modal-body"></div>
        </div>
        <div class="gallery-modal-nav">
            <button class="gallery-btn gallery-modal-prev">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <span class="gallery-modal-counter"></span>
            <button class="gallery-btn gallery-modal-next">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
    </div>
`;
document.body.appendChild(galleryModal);

const galleryModalFrame   = galleryModal.querySelector('.media-modal-frame');
const galleryModalBody    = galleryModal.querySelector('.media-modal-body');
const galleryModalClose   = galleryModal.querySelector('.media-modal-close');
const galleryModalOverlay = galleryModal.querySelector('.media-modal-overlay');
const galleryModalPrev    = galleryModal.querySelector('.gallery-modal-prev');
const galleryModalNext    = galleryModal.querySelector('.gallery-modal-next');
const galleryModalCounter = galleryModal.querySelector('.gallery-modal-counter');

let galleryMediaList    = [];
let galleryCurrentIndex = 0;

function openGalleryModal(mediaList, startIndex) {
    galleryMediaList    = mediaList;
    galleryCurrentIndex = startIndex;
    galleryModal.classList.add('show');
    document.body.style.overflow = 'hidden';
    renderGalleryModalItem();
}

function renderGalleryModalItem() {
    const media = galleryMediaList[galleryCurrentIndex];
    const total = galleryMediaList.length;

    // Stop any playing video
    const oldVideo = galleryModalBody.querySelector('video');
    if (oldVideo) oldVideo.pause();

    // Clear frame orientation classes while loading new media
    galleryModalFrame.classList.remove('frame-landscape', 'frame-portrait');

    let el;
    if (media.tagName === 'IMG') {
        el = document.createElement('img');
        el.src = media.src;
        el.alt = media.alt;
    } else if (media.tagName === 'VIDEO') {
        const source = media.querySelector('source');
        const src = source ? source.src : media.src;
        el = document.createElement('video');
        el.src = src;
        el.controls = true;
        el.autoplay = true;
    }

    galleryModalBody.innerHTML = '';
    galleryModalBody.appendChild(el);
    applyOrientation(el, galleryModalFrame);

    galleryModalCounter.textContent = `${galleryCurrentIndex + 1} / ${total}`;
    galleryModalPrev.disabled = galleryCurrentIndex === 0;
    galleryModalNext.disabled = galleryCurrentIndex === total - 1;

    // Hide nav if only 1 item
    galleryModal.querySelector('.gallery-modal-nav').style.display = total > 1 ? 'flex' : 'none';
}

galleryModalPrev.addEventListener('click', () => {
    if (galleryCurrentIndex > 0) {
        galleryCurrentIndex--;
        renderGalleryModalItem();
    }
});

galleryModalNext.addEventListener('click', () => {
    if (galleryCurrentIndex < galleryMediaList.length - 1) {
        galleryCurrentIndex++;
        renderGalleryModalItem();
    }
});

function closeGalleryModal() {
    galleryModal.classList.remove('show');
    document.body.style.overflow = '';
    const video = galleryModalBody.querySelector('video');
    if (video) video.pause();
    galleryModalBody.innerHTML = '';
    galleryModalFrame.classList.remove('frame-landscape', 'frame-portrait');
}

galleryModalClose.addEventListener('click', closeGalleryModal);
galleryModalOverlay.addEventListener('click', closeGalleryModal);

document.addEventListener('keydown', (e) => {
    if (!galleryModal.classList.contains('show')) return;
    if (e.key === 'ArrowLeft'  && galleryCurrentIndex > 0)                            { galleryCurrentIndex--; renderGalleryModalItem(); }
    if (e.key === 'ArrowRight' && galleryCurrentIndex < galleryMediaList.length - 1)  { galleryCurrentIndex++; renderGalleryModalItem(); }
    if (e.key === 'Escape') closeGalleryModal();
});