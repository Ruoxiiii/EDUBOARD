document.addEventListener('DOMContentLoaded', () => {
    // ── Department → Course mapping ──
    const deptCourses = {
        COT:  ['BSIT', 'BSCS', 'BSElectronics', 'BSAutomotive', 'BSEMC'],
        COB:  ['BSBA', 'BSAccountancy', 'BSMarketing', 'BSEntrepreneurship'],
        CON:  ['BSN', 'BSMidwifery'],
        COE:  ['BSEd', 'BEEd', 'BSPhysEd'],
        COAS: ['BSPSYCH', 'BSSOC', 'BSBio'],
    };

    const departmentFilter = document.getElementById('departmentFilter');
    const courseFilter     = document.getElementById('courseFilter');

    if (departmentFilter) {
        departmentFilter.addEventListener('change', () => {
            const dept    = departmentFilter.value;
            const courses = deptCourses[dept] || [];

            courseFilter.innerHTML = '<option value="all">All Courses</option>';
            courses.forEach(c => {
                const opt = document.createElement('option');
                opt.value       = c;
                opt.textContent = c;
                courseFilter.appendChild(opt);
            });

            courseFilter.disabled = dept === 'all';
            applyFilters();
        });
    }

    if (courseFilter) {
        courseFilter.addEventListener('change', applyFilters);
    }

    // ── Section Column Toggle ──
    function toggleSectionColumn(role) {
        const sectionHeader = document.querySelector('.col-section');
        const sectionCells  = document.querySelectorAll('.cell-section');
        if (!sectionHeader || !sectionCells) return;
        const show = role === 'students';
        sectionHeader.style.display = show ? '' : 'none';
        sectionCells.forEach(cell => cell.style.display = show ? '' : 'none');
    }

    // ── Tabs ──
    const userTabs  = document.querySelectorAll('.user-tab');
    let currentRole = 'teachers';

    if (userTabs.length > 0) {
        userTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                userTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                currentRole = tab.dataset.tab;
                if (departmentFilter) departmentFilter.value = 'all';
                if (courseFilter) {
                    courseFilter.innerHTML = '<option value="all">Select Department first</option>';
                    courseFilter.disabled  = true;
                }
                const userSearch = document.getElementById('userSearch');
                if (userSearch) userSearch.value = '';
                toggleSectionColumn(currentRole);
                applyFilters();
            });
        });
    }

    // ── Search ──
    const userSearch = document.getElementById('userSearch');
    if (userSearch) {
        userSearch.addEventListener('input', applyFilters);
    }

    // ── Apply Filters ──
    function applyFilters() {
        const dept   = departmentFilter ? departmentFilter.value : 'all';
        const course = courseFilter ? courseFilter.value : 'all';
        const query  = userSearch ? userSearch.value.toLowerCase() : '';
        const rows   = document.querySelectorAll('#usersTableBody tr');
        let visible  = 0;

        rows.forEach(row => {
            const role      = row.dataset.role;
            const rowDept   = row.dataset.dept;
            const rowCourse = row.dataset.course;
            const nameText  = row.querySelector('.user-name-cell')?.textContent.toLowerCase() || '';
            const emailText = row.querySelector('.text-muted')?.textContent.toLowerCase() || '';

            const matchRole   = role === currentRole;
            const matchDept   = dept === 'all' || rowDept === dept;
            const matchCourse = course === 'all' || rowCourse === course;
            const matchSearch = !query || nameText.includes(query) || emailText.includes(query);

            if (matchRole && matchDept && matchCourse && matchSearch) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        const usersEmptyState = document.getElementById('usersEmptyState');
        if (usersEmptyState) {
            usersEmptyState.style.display = visible === 0 ? 'flex' : 'none';
        }
    }

    // ── Init ──
    toggleSectionColumn(currentRole);
    applyFilters();

    // ── Add/Edit User Modal ──
    const userModal = document.getElementById('userModal');
    const addUserBtn = document.getElementById('addUserBtn');
    const userModalOverlay = document.getElementById('userModalOverlay');
    const closeUserModal = document.getElementById('closeUserModal');
    const cancelUserBtn = document.getElementById('cancelUserBtn');
    const userForm = document.getElementById('userForm');
    const userModalTitle = document.getElementById('userModalTitle');
    const userId = document.getElementById('userId');
    const userName = document.getElementById('userName');
    const userEmail = document.getElementById('userEmail');
    const userRole = document.getElementById('userRole');
    const userStatus = document.getElementById('userStatus');
    const userDepartment = document.getElementById('userDepartment');
    const userCourse = document.getElementById('userCourse');

    function openUserModal(user = null) {
        userForm.reset();
        if (user) {
            userModalTitle.textContent = 'Edit User';
            userId.value = user.id;
            userName.value = user.name;
            userEmail.value = user.email;
            userRole.value = user.role;
            userStatus.value = user.status;
            userDepartment.value = user.department;
            // Note: Course population logic will need to be more robust
            userCourse.innerHTML = `<option value="${user.course}">${user.course}</option>`;
            userCourse.disabled = false;
        } else {
            userModalTitle.textContent = 'Add User';
        }
        userModal.classList.add('show');
    }

    function closeUserModalFunc() {
        userModal.classList.remove('show');
    }

    if (addUserBtn) {
        addUserBtn.addEventListener('click', () => openUserModal());
    }

    if (closeUserModal) {
        closeUserModal.addEventListener('click', closeUserModalFunc);
    }

    if (cancelUserBtn) {
        cancelUserBtn.addEventListener('click', closeUserModalFunc);
    }

    if (userModalOverlay) {
        userModalOverlay.addEventListener('click', closeUserModalFunc);
    }

    document.querySelectorAll('.ann-action-btn.edit').forEach(btn => {
        btn.addEventListener('click', () => {
            const row = btn.closest('tr');
            const user = {
                id: row.dataset.id,
                name: row.querySelector('.user-name-cell').textContent.trim(),
                email: row.querySelector('.text-muted').textContent.trim(),
                role: row.dataset.role,
                status: row.querySelector('.status-badge').textContent.toLowerCase(),
                department: row.dataset.dept,
                course: row.dataset.course,
            };
            openUserModal(user);
        });
    });

    if (userForm) {
        userForm.addEventListener('submit', e => {
            e.preventDefault();
            // This is a static implementation
            closeUserModalFunc();
        });
    }
});
