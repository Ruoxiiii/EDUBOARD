// ── Account Dropdown ──
const accountBtn = document.getElementById('accountBtn');
const accountMenu = document.getElementById('accountMenu');

accountBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    notifMenu.classList.remove('show');
    accountMenu.classList.toggle('show');
});

// ── Notifications Dropdown ──
const notifBtn = document.getElementById('notifBtn');
const notifMenu = document.getElementById('notifMenu');

notifBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    accountMenu.classList.remove('show');
    notifMenu.classList.toggle('show');
});

// Close both when clicking outside
document.addEventListener('click', function () {
    accountMenu.classList.remove('show');
    notifMenu.classList.remove('show');
});

// ── Notification Click → Navigate or Scroll to Card ──
document.querySelectorAll('.notif-item[data-target]').forEach(item => {
    item.addEventListener('click', () => {
        const targetId = item.dataset.target;

        // Close dropdown
        notifMenu.classList.remove('show');

        // Check if the target card exists on this page
        const targetCard = document.getElementById(targetId);

        if (targetCard) {
            // We're on the studentpage — scroll to it
            const tabs = document.querySelectorAll('.tab');
            const pills = document.querySelectorAll('.pill');

            if (tabs.length) {
                tabs.forEach(t => t.classList.remove('active'));
                document.querySelector('.tab').classList.add('active');
            }

            if (pills.length) {
                pills.forEach(p => p.classList.remove('active'));
                document.querySelector('.pill.all').classList.add('active');
            }

            if (typeof applyFilter === 'function') {
                applyFilter('all');
            } else {
                // Manually show all cards
                document.querySelectorAll('.ann-card').forEach(c => c.style.display = 'block');
            }

            setTimeout(() => {
                targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                targetCard.classList.add('highlight');
                setTimeout(() => targetCard.classList.remove('highlight'), 2000);
            }, 100);

        } else {
            // We're on a different page — redirect to studentpage with anchor
            const studentPageUrl = document.querySelector('.navbar').dataset.studentPage;
            window.location.href = `${studentPageUrl}#${targetId}`;
        }

        // Mark as read
        item.classList.remove('unread');
        const dot = item.querySelector('.notif-unread-dot');
        if (dot) dot.remove();

        // Update badge count
        const unreadCount = document.querySelectorAll('.notif-item.unread').length;
        const countBadge = document.querySelector('.notif-count');
        const notifDot = document.querySelector('.notif-dot');

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