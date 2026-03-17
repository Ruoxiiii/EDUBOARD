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
                history.replaceState(null, '', window.location.pathname);
            }, 300);
        }
    }
});

// ── Theme Toggle ──
const themeBtn = document.getElementById('themeBtn');
const html = document.documentElement;

function updateThemeIcon(isDark) {
    themeBtn.innerHTML = isDark
        ? `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
           </svg>`
        : `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
           </svg>`;
}

if (localStorage.getItem('theme') === 'dark') {
    updateThemeIcon(true);
}

themeBtn.addEventListener('click', () => {
    const isDark = html.getAttribute('data-theme') === 'dark';
    if (isDark) {
        html.removeAttribute('data-theme');
        localStorage.setItem('theme', 'light');
        updateThemeIcon(false);
    } else {
        html.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
        updateThemeIcon(true);
    }
});

// ── Notifications Dropdown ──
const notifBtn = document.getElementById('notifBtn');
const notifMenu = document.getElementById('notifMenu');

notifBtn.addEventListener('click', e => {
    e.stopPropagation();
    accountMenu.classList.remove('show');
    notifMenu.classList.toggle('show');
});

// ── Account Dropdown ──
const accountBtn = document.getElementById('accountBtn');
const accountMenu = document.getElementById('accountMenu');

accountBtn.addEventListener('click', e => {
    e.stopPropagation();
    notifMenu.classList.remove('show');
    accountMenu.classList.toggle('show');
});

document.addEventListener('click', () => {
    accountMenu.classList.remove('show');
    notifMenu.classList.remove('show');
});

// ── Notification Click → Scroll or Redirect to Card ──
document.querySelectorAll('.notif-item[data-target]').forEach(item => {
    item.addEventListener('click', () => {
        const targetId   = item.dataset.target;
        const targetCard = document.getElementById(targetId);

        // Close dropdown
        notifMenu.classList.remove('show');

        if (targetCard) {
            // On the dashboard — scroll smoothly to card
            setTimeout(() => {
                targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                targetCard.classList.add('highlight');
                setTimeout(() => targetCard.classList.remove('highlight'), 2000);
            }, 100);
        } else {
            // On a different admin page — redirect to dashboard with anchor
            const dashboardUrl = document.querySelector('.admin-topbar').dataset.dashboardUrl;
            window.location.href = `${dashboardUrl}#${targetId}`;
        }

        // Mark as read
        item.classList.remove('unread');
        const dot = item.querySelector('.notif-unread-dot');
        if (dot) dot.remove();

        // Update badge count
        const unreadCount = document.querySelectorAll('.notif-item.unread').length;
        const countBadge  = document.querySelector('.notif-count');
        const notifDot    = document.querySelector('.topbar-notif-dot');

        if (countBadge) {
            if (unreadCount === 0) {
                countBadge.style.display = 'none';
                if (notifDot) notifDot.style.display = 'none';
            } else {
                countBadge.textContent = `${unreadCount} new`;
            }
        }
    });
});

// ── Gallery ──
document.querySelectorAll('.ann-gallery').forEach(gallery => {
    const track   = gallery.querySelector('.gallery-track');
    const prevBtn = gallery.querySelector('.gallery-prev');
    const nextBtn = gallery.querySelector('.gallery-next');
    const counter = gallery.querySelector('.gallery-counter');
    const items   = gallery.querySelectorAll('.gallery-item');
    const total   = items.length;
    let current   = 0;

    function goTo(index) {
        current = index;
        track.style.transform = `translateX(-${current * 100}%)`;
        counter.textContent   = `${current + 1} / ${total}`;
        prevBtn.disabled      = current === 0;
        nextBtn.disabled      = current === total - 1;
    }

    prevBtn.addEventListener('click', e => { e.stopPropagation(); if (current > 0) goTo(current - 1); });
    nextBtn.addEventListener('click', e => { e.stopPropagation(); if (current < total - 1) goTo(current + 1); });

    goTo(0);
});

// ── Gallery Modal ──
const adminGalleryModal = document.createElement('div');
adminGalleryModal.classList.add('media-modal', 'gallery-modal');
adminGalleryModal.innerHTML = `
    <div class="media-modal-overlay"></div>
    <div class="media-modal-content">
        <button class="media-modal-close">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="media-modal-body"></div>
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
document.body.appendChild(adminGalleryModal);

const adminModalBody    = adminGalleryModal.querySelector('.media-modal-body');
const adminModalClose   = adminGalleryModal.querySelector('.media-modal-close');
const adminModalOverlay = adminGalleryModal.querySelector('.media-modal-overlay');
const adminModalPrev    = adminGalleryModal.querySelector('.gallery-modal-prev');
const adminModalNext    = adminGalleryModal.querySelector('.gallery-modal-next');
const adminModalCounter = adminGalleryModal.querySelector('.gallery-modal-counter');

let adminMediaList    = [];
let adminCurrentIndex = 0;

function openAdminGalleryModal(mediaList, startIndex) {
    adminMediaList    = mediaList;
    adminCurrentIndex = startIndex;
    adminGalleryModal.classList.add('show');
    document.body.style.overflow = 'hidden';
    renderAdminModalItem();
}

function renderAdminModalItem() {
    const media = adminMediaList[adminCurrentIndex];
    const total = adminMediaList.length;

    const oldVideo = adminModalBody.querySelector('video');
    if (oldVideo) oldVideo.pause();

    if (media.tagName === 'IMG') {
        adminModalBody.innerHTML = `<img src="${media.src}" alt="${media.alt}">`;
    } else if (media.tagName === 'VIDEO') {
        const source = media.querySelector('source');
        const src    = source ? source.src : media.src;
        adminModalBody.innerHTML = `<video src="${src}" controls autoplay></video>`;
    }

    adminModalCounter.textContent = `${adminCurrentIndex + 1} / ${total}`;
    adminModalPrev.disabled       = adminCurrentIndex === 0;
    adminModalNext.disabled       = adminCurrentIndex === total - 1;
    adminGalleryModal.querySelector('.gallery-modal-nav').style.display = total > 1 ? 'flex' : 'none';
}

adminModalPrev.addEventListener('click', () => {
    if (adminCurrentIndex > 0) { adminCurrentIndex--; renderAdminModalItem(); }
});

adminModalNext.addEventListener('click', () => {
    if (adminCurrentIndex < adminMediaList.length - 1) { adminCurrentIndex++; renderAdminModalItem(); }
});

function closeAdminGalleryModal() {
    adminGalleryModal.classList.remove('show');
    document.body.style.overflow = '';
    const video = adminModalBody.querySelector('video');
    if (video) video.pause();
    adminModalBody.innerHTML = '';
}

adminModalClose.addEventListener('click', closeAdminGalleryModal);
adminModalOverlay.addEventListener('click', closeAdminGalleryModal);

document.addEventListener('keydown', e => {
    if (!adminGalleryModal.classList.contains('show')) return;
    if (e.key === 'ArrowLeft'  && adminCurrentIndex > 0) { adminCurrentIndex--; renderAdminModalItem(); }
    if (e.key === 'ArrowRight' && adminCurrentIndex < adminMediaList.length - 1) { adminCurrentIndex++; renderAdminModalItem(); }
    if (e.key === 'Escape') closeAdminGalleryModal();
});

// ── Eye Overlay on gallery items ──
document.querySelectorAll('.ann-gallery').forEach(gallery => {
    const items = gallery.querySelectorAll('.gallery-item');

    items.forEach((item, index) => {
        const media = item.querySelector('img, video');
        if (!media) return;

        const overlay = document.createElement('div');
        overlay.classList.add('ann-media-overlay');
        overlay.innerHTML = `
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>View</span>
        `;

        item.style.position = 'relative';
        item.style.cursor   = 'zoom-in';
        item.appendChild(overlay);

        item.addEventListener('click', () => {
            const allMedia = Array.from(
                gallery.querySelectorAll('.gallery-item img, .gallery-item video')
            );
            openAdminGalleryModal(allMedia, index);
        });
    });
});