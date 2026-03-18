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
        const show = role === 'students' || role === 'pending';
        sectionHeader.style.display = show ? '' : 'none';
        sectionCells.forEach(cell => cell.style.display = show ? '' : 'none');
    }

    // ── Update Tab Counts ──
    function updateTabCounts() {
        const tabs = document.querySelectorAll('.user-tab');
        tabs.forEach(tab => {
            const role = tab.dataset.tab;
            const count = document.querySelectorAll(`#usersTableBody tr[data-role="${role}"]`).length;
            const countEl = tab.querySelector('.user-tab-count');
            if (countEl) countEl.textContent = count;
        });
    }

    // ── Approval Actions ──
    function handleApprovals() {
        document.addEventListener('click', (e) => {
            const approveBtn = e.target.closest('.approve-user-btn');
            const rejectBtn = e.target.closest('.reject-user-btn');

            if (approveBtn) {
                const row = approveBtn.closest('tr');
                if (row) {
                    // Extract data for the Edit Modal
                    const user = {
                        id: row.dataset.id || `pending-${Date.now()}`,
                        name: row.querySelector('.user-name-cell').textContent.trim(),
                        email: row.querySelector('.text-muted').textContent.trim(),
                        role: 'student', // Default role for approval
                        status: 'active',  // Default status for approval
                        department: row.dataset.dept || '',
                        course: row.dataset.course || '',
                        isApproving: true // Special flag
                    };
                    
                    // Assign temporary ID to row if it doesn't have one
                    if (!row.dataset.id) row.dataset.id = user.id;
                    
                    openUserModal(user);
                }
            }

            if (rejectBtn) {
                const row = rejectBtn.closest('tr');
                if (row) {
                    row.remove();
                    updateTabCounts();
                    applyFilters();
                    showSuccess('User registration rejected');
                }
            }
        });
    }

    // ── Tabs ──
    const userTabs  = document.querySelectorAll('.user-tab');
    let currentRole = 'teachers';

    // Check for tab parameter in URL
    const urlParams = new URLSearchParams(window.location.search);
    const tabParam = urlParams.get('tab');

    if (userTabs.length > 0) {
        if (tabParam && Array.from(userTabs).some(t => t.dataset.tab === tabParam)) {
            currentRole = tabParam;
            userTabs.forEach(t => {
                if (t.dataset.tab === currentRole) t.classList.add('active');
                else t.classList.remove('active');
            });
        }

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
    handleApprovals();
    toggleSectionColumn(currentRole);
    applyFilters();

    // ── Success Modal ──
    const successModal = document.getElementById('successModal');
    const successModalOverlay = document.getElementById('successModalOverlay');
    const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');
    const successModalMessage = document.getElementById('successModalMessage');
    const successModalIcon = document.getElementById('successModalIcon');

    function showSuccess(msg) {
        if (successModalMessage) successModalMessage.textContent = msg;
        if (successModalIcon) {
            // Animated checkmark
            successModalIcon.innerHTML = `
                <svg class="animated-check" viewBox="0 0 52 52">
                    <circle class="animated-check-circle" cx="26" cy="26" r="25" fill="none" />
                    <path class="animated-check-path" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                </svg>
            `;
            successModalIcon.style.display = 'block';
        }
        if (successModal) successModal.classList.add('show');
    }

    function closeSuccessModal() {
        if (successModal) successModal.classList.remove('show');
    }

    if (closeSuccessModalBtn) closeSuccessModalBtn.addEventListener('click', closeSuccessModal);
    if (successModalOverlay) successModalOverlay.addEventListener('click', closeSuccessModal);
    const closeSuccessModalTop = document.getElementById('closeSuccessModalTop');
    if (closeSuccessModalTop) closeSuccessModalTop.addEventListener('click', closeSuccessModal);

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
            userModalTitle.textContent = user.isApproving ? 'Approve & Edit User' : 'Edit User';
            userId.value = user.id;
            userName.value = user.name;
            userEmail.value = user.email;
            userRole.value = user.role;
            userStatus.value = user.status;
            userDepartment.value = user.department;
            if (user.isApproving) userForm.dataset.approving = "true";
            else delete userForm.dataset.approving;
            
            // Note: Course population logic will need to be more robust
            userCourse.innerHTML = `<option value="${user.course}">${user.course}</option>`;
            userCourse.disabled = false;
        } else {
            userModalTitle.textContent = 'Add User';
            delete userForm.dataset.approving;
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

    // ── Form Submission ──
    if (userForm) {
        userForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const id = document.getElementById('userId').value;
            const name = document.getElementById('userName').value;
            const email = document.getElementById('userEmail').value;
            const role = document.getElementById('userRole').value;
            const status = document.getElementById('userStatus').value;
            const dept = document.getElementById('userDepartment').value;
            const course = document.getElementById('userCourse').value;
            const isApproving = userForm.dataset.approving === "true";

            if (id) {
                // Update existing (static)
                const row = document.querySelector(`tr[data-id="${id}"]`);
                if (row) {
                    const avatarImg = row.querySelector('.user-avatar-sm img')?.src || null;
                    const initials = name.substring(0, 2).toUpperCase();
                    
                    row.querySelector('.user-name-cell').innerHTML = avatarImg 
                        ? `<div class="user-avatar-sm"><img src="${avatarImg}" alt="${name}"></div>${name}`
                        : `<div class="user-avatar-sm">${initials}</div>${name}`;
                    
                    row.cells[1].textContent = email;
                    row.cells[2].textContent = dept;
                    row.cells[3].textContent = course;
                    const badge = row.querySelector('.status-badge');
                    badge.className = `status-badge ${status}`;
                    badge.textContent = status.charAt(0).toUpperCase() + status.slice(1);

                    // If it was a pending approval, move it to the correct role tab
                    if (isApproving) {
                        row.dataset.role = role === 'teacher' ? 'teachers' : 'students';
                        // Replace pending actions with normal actions
                        const actionsCell = row.querySelector('.user-row-actions');
                        actionsCell.innerHTML = `
                            <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                            <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                        `;
                        showSuccess(`${name}'s account approved and updated`);
                    } else {
                        showSuccess('User account updated successfully');
                    }

                    // Update dataset and UI sync
                    row.dataset.role = role === 'teacher' ? 'teachers' : 'students';
                    row.dataset.dept = dept;
                    row.dataset.course = course;
                    const sectionCell = row.querySelector('.cell-section');
                    if (sectionCell) sectionCell.style.display = (role === 'teacher') ? 'none' : '';

                    updateTabCounts();
                    applyFilters();
                }
            } else {
                // Add new (static)
                const tbody = document.getElementById('usersTableBody');
                const newRow = document.createElement('tr');
                const newId = Date.now();
                newRow.dataset.id = newId;
                newRow.dataset.role = role;
                newRow.dataset.dept = dept;
                newRow.dataset.course = course;

                // Hide if not the active tab
                const activeTab = document.querySelector('.user-tab.active').dataset.tab;
                if (newRow.dataset.role !== activeTab) {
                    newRow.style.display = 'none';
                }

                newRow.innerHTML = `
                    <td><div class="user-name-cell"><div class="user-avatar-sm">${name.substring(0, 2).toUpperCase()}</div>${name}</div></td>
                    <td class="text-muted">${email}</td>
                    <td>${dept}</td>
                    <td>${course}</td>
                    <td class="cell-section" style="${role === 'teachers' ? 'display:none;' : ''}">N/A</td>
                    <td><span class="status-badge ${status}">${status.charAt(0).toUpperCase() + status.slice(1)}</span></td>
                    <td><div class="user-row-actions">
                        <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                        <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                    </div></td>
                `;
                tbody.prepend(newRow);
                updateTabCounts();
                applyFilters();
                showSuccess('User account added successfully');
            }

            userModal.classList.remove('show');
            userForm.reset();
        });
    }

    // ── Delete User ──
    const deleteUserModal = document.getElementById('deleteUserModal');
    const deleteUserModalOverlay = document.getElementById('deleteUserModalOverlay');
    const cancelDeleteUserBtn = document.getElementById('cancelDeleteUserBtn');
    const confirmDeleteUserBtn = document.getElementById('confirmDeleteUserBtn');
    let userToDeleteRow = null;

    function openDeleteUserModal(row) {
        userToDeleteRow = row;
        deleteUserModal.classList.add('show');
    }

    function closeDeleteUserModalFunc() {
        deleteUserModal.classList.remove('show');
        userToDeleteRow = null;
    }

    if (cancelDeleteUserBtn) cancelDeleteUserBtn.addEventListener('click', closeDeleteUserModalFunc);
    if (deleteUserModalOverlay) deleteUserModalOverlay.addEventListener('click', closeDeleteUserModalFunc);
    const closeDeleteUserModal = document.getElementById('closeDeleteUserModal');
    if (closeDeleteUserModal) closeDeleteUserModal.addEventListener('click', closeDeleteUserModalFunc);

    if (confirmDeleteUserBtn) {
        confirmDeleteUserBtn.addEventListener('click', () => {
            if (userToDeleteRow) {
                userToDeleteRow.remove();
                if (typeof updateTabCounts === 'function') updateTabCounts();
                closeDeleteUserModalFunc();
                applyFilters(); // Update empty state
                showSuccess('User account deleted successfully');
            }
        });
    }

    window.addEventListener('click', (e) => {
        const deleteBtn = e.target.closest('.ann-action-btn.delete');
        if (deleteBtn) {
            const row = deleteBtn.closest('tr');
            if (row) {
                openDeleteUserModal(row);
            }
        }
    });
});
