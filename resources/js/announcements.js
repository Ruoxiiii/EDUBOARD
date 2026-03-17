document.addEventListener('DOMContentLoaded', () => {
    // ── Filter Pills ──
    const filterPills   = document.querySelectorAll('.ann-filter-pill');
    const annItems      = document.querySelectorAll('.ann-list-item');
    const annEmptyState = document.getElementById('annEmptyState');

    function checkEmpty() {
        const visible = Array.from(annItems).filter(i => i.style.display !== 'none');
        annEmptyState.style.display = visible.length === 0 ? 'flex' : 'none';
    }

    if (filterPills.length > 0) {
        filterPills.forEach(pill => {
            pill.addEventListener('click', () => {
                filterPills.forEach(p => p.classList.remove('active'));
                pill.classList.add('active');
                const filter = pill.dataset.filter;
                annItems.forEach(item => {
                    item.style.display = (filter === 'all' || item.dataset.category === filter) ? 'flex' : 'none';
                });
                checkEmpty();
            });
        });
    }

    // ── Search ──
    const annSearch = document.getElementById('annSearch');
    if (annSearch) {
        annSearch.addEventListener('input', function () {
            const query = this.value.toLowerCase();
            annItems.forEach(item => {
                const title = item.querySelector('.ann-list-title').textContent.toLowerCase();
                const body  = item.querySelector('.ann-list-body').textContent.toLowerCase();
                item.style.display = (title.includes(query) || body.includes(query)) ? 'flex' : 'none';
            });
            checkEmpty();
        });
    }

    // ── Date Filter ──
    const dateFrom        = document.getElementById('dateFrom');
    const dateTo          = document.getElementById('dateTo');
    const applyDateFilter = document.getElementById('applyDateFilter');
    const clearDateFilter = document.getElementById('clearDateFilter');

    function getItemDate(item) {
        const dateSpan = item.querySelector('.ann-list-info span:nth-child(2)');
        if (!dateSpan) return null;
        const dateText = dateSpan.textContent.trim();
        return dateText ? new Date(dateText) : null;
    }

    if (applyDateFilter) {
        applyDateFilter.addEventListener('click', () => {
            const from = dateFrom.value ? new Date(dateFrom.value) : null;
            const to   = dateTo.value   ? new Date(dateTo.value)   : null;

            annItems.forEach(item => {
                const itemDate = getItemDate(item);
                if (!itemDate) return;

                let visible = true;

                if (from && to) {
                    visible = itemDate >= from && itemDate <= to;
                } else if (from) {
                    visible = itemDate.toDateString() === from.toDateString();
                }

                item.style.display = visible ? 'flex' : 'none';
            });

            checkEmpty();
        });
    }

    if (clearDateFilter) {
        clearDateFilter.addEventListener('click', () => {
            dateFrom.value = '';
            dateTo.value   = '';

            const activePill = document.querySelector('.ann-filter-pill.active');
            const filter     = activePill ? activePill.dataset.filter : 'all';

            annItems.forEach(item => {
                item.style.display = (filter === 'all' || item.dataset.category === filter) ? 'flex' : 'none';
            });

            checkEmpty();
        });
    }

    // ── File Preview ──
    const annMedia        = document.getElementById('annMedia');
    const filePreviewGrid = document.getElementById('filePreviewGrid');
    let selectedFiles     = [];

    if (annMedia) {
        annMedia.addEventListener('change', function () {
            const newFiles = Array.from(this.files);
            selectedFiles  = [...selectedFiles, ...newFiles];
            renderPreviews();
        });
    }

    function renderPreviews() {
        filePreviewGrid.innerHTML = '';
        selectedFiles.forEach((file, index) => {
            const item    = document.createElement('div');
            item.classList.add('file-preview-item');
            const isVideo = file.type.startsWith('video/');
            const url     = URL.createObjectURL(file);

            if (isVideo) {
                item.innerHTML = `
                    <video src="${url}" muted></video>
                    <span class="file-preview-type">Video</span>
                    <button class="file-preview-remove" data-index="${index}">✕</button>
                `;
            } else {
                item.innerHTML = `
                    <img src="${url}" alt="${file.name}">
                    <span class="file-preview-type">Image</span>
                    <button class="file-preview-remove" data-index="${index}">✕</button>
                `;
            }

            filePreviewGrid.appendChild(item);
        });

        filePreviewGrid.querySelectorAll('.file-preview-remove').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                const idx     = parseInt(btn.dataset.index);
                selectedFiles = selectedFiles.filter((_, i) => i !== idx);
                renderPreviews();
            });
        });
    }

    // ── Reset Modal ──
    function resetModal() {
        selectedFiles = [];
        if(filePreviewGrid) {
            filePreviewGrid.innerHTML = '';
        }
        const newAnnForm = document.getElementById('newAnnForm');
        if(newAnnForm) {
            newAnnForm.reset();
        }
        
        // Reset modal title and button
        const modalTitle = document.getElementById('modalTitle');
        const submitBtnText = document.getElementById('submitBtnText');
        if (modalTitle) modalTitle.textContent = 'New Announcement';
        if (submitBtnText) submitBtnText.textContent = 'Publish';
    }

    // ── New Announcement Modal ──
    const newAnnModal        = document.getElementById('newAnnModal');
    const newAnnouncementBtn = document.getElementById('newAnnouncementBtn');
    const newAnnModalOverlay = document.getElementById('newAnnModalOverlay');
    const closeNewAnnModal   = document.getElementById('closeNewAnnModal');
    const cancelNewAnnBtn    = document.getElementById('cancelNewAnnBtn');
    const annTarget          = document.getElementById('annTarget');
    const departmentTargetGroup = document.getElementById('departmentTargetGroup');

    if (annTarget) {
        annTarget.addEventListener('change', () => {
            departmentTargetGroup.style.display = annTarget.value === 'department' ? 'block' : 'none';
        });
    }

    if (newAnnouncementBtn) {
        newAnnouncementBtn.addEventListener('click', () => {
            resetModal();
            newAnnModal.classList.add('show');
        });
    }

    // ── Edit Announcement Modal ──
    const editBtns = document.querySelectorAll('.ann-action-btn.edit');
    editBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.ann-list-item');
            if (!item) return;

            const id = item.dataset.id;
            const title = item.dataset.title;
            const category = item.dataset.category;
            const body = item.dataset.body;
            const pinned = item.dataset.pinned;
            const media = JSON.parse(item.dataset.media || '[]');

            // Populate form
            document.getElementById('annId').value = id || '';
            document.getElementById('annTitle').value = title || '';
            document.getElementById('annCategory').value = category || '';
            document.getElementById('annPin').value = pinned || '0';
            document.getElementById('annContent').value = body || '';

            // Update modal UI
            document.getElementById('modalTitle').textContent = 'Edit Announcement';
            document.getElementById('submitBtnText').textContent = 'Update';

            // Show media previews
            filePreviewGrid.innerHTML = '';
            media.forEach((file, index) => {
                const previewItem = document.createElement('div');
                previewItem.classList.add('file-preview-item');
                
                if (file.type === 'video') {
                    previewItem.innerHTML = `
                        <video src="${file.url}" muted></video>
                        <span class="file-preview-type">Video</span>
                        <button class="file-preview-remove" data-existing="true" data-index="${index}">✕</button>
                    `;
                } else {
                    previewItem.innerHTML = `
                        <img src="${file.url}" alt="Preview">
                        <span class="file-preview-type">Image</span>
                        <button class="file-preview-remove" data-existing="true" data-index="${index}">✕</button>
                    `;
                }
                filePreviewGrid.appendChild(previewItem);
            });

            // Re-attach remove listeners for existing media
            filePreviewGrid.querySelectorAll('.file-preview-remove[data-existing="true"]').forEach(removeBtn => {
                removeBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    removeBtn.closest('.file-preview-item').remove();
                });
            });

            newAnnModal.classList.add('show');
        });
    });

    if (closeNewAnnModal) {
        closeNewAnnModal.addEventListener('click', () => {
            newAnnModal.classList.remove('show');
            resetModal();
        });
    }

    if (cancelNewAnnBtn) {
        cancelNewAnnBtn.addEventListener('click', () => {
            newAnnModal.classList.remove('show');
            resetModal();
        });
    }

    if (newAnnModalOverlay) {
        newAnnModalOverlay.addEventListener('click', () => {
            newAnnModal.classList.remove('show');
            resetModal();
        });
    }

    // ── Delete Announcement Modal ──
    const deleteAnnModal = document.getElementById('deleteAnnModal');
    const deleteAnnModalOverlay = document.getElementById('deleteAnnModalOverlay');
    const closeDeleteAnnModal = document.getElementById('closeDeleteAnnModal');
    const cancelDeleteAnnBtn = document.getElementById('cancelDeleteAnnBtn');
    const confirmDeleteAnnBtn = document.getElementById('confirmDeleteAnnBtn');
    let itemToDelete = null;

    function openDeleteModal(item) {
        itemToDelete = item;
        deleteAnnModal.classList.add('show');
    }

    function closeDeleteModal() {
        itemToDelete = null;
        deleteAnnModal.classList.remove('show');
    }

    if (closeDeleteAnnModal) closeDeleteAnnModal.addEventListener('click', closeDeleteModal);
    if (cancelDeleteAnnBtn) cancelDeleteAnnBtn.addEventListener('click', closeDeleteModal);
    if (deleteAnnModalOverlay) deleteAnnModalOverlay.addEventListener('click', closeDeleteModal);

    if (confirmDeleteAnnBtn) {
        confirmDeleteAnnBtn.addEventListener('click', () => {
            if (itemToDelete) {
                itemToDelete.remove();
                checkEmpty();
            }
            closeDeleteModal();
        });
    }

    // Attach delete listeners
    document.querySelectorAll('.ann-action-btn.delete').forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.ann-list-item');
            if (item) openDeleteModal(item);
        });
    });

    // ── Form Submission ──
    const newAnnForm = document.getElementById('newAnnForm');
    if (newAnnForm) {
        newAnnForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const id = document.getElementById('annId').value;
            const title = document.getElementById('annTitle').value;
            const category = document.getElementById('annCategory').value;
            const pinned = document.getElementById('annPin').value;
            const body = document.getElementById('annContent').value;
            const target = document.getElementById('annTarget').value;
            const department = document.getElementById('annDepartmentTarget').value;

            if (id) {
                // Update existing announcement (static)
                const item = document.querySelector(`[data-id="${id}"]`);
                if (item) {
                    item.dataset.title = title;
                    item.dataset.category = category;
                    item.dataset.pinned = pinned;
                    item.dataset.body = body;
                    item.querySelector('.ann-list-title').textContent = title;
                    item.querySelector('.ann-list-body').textContent = body;
                    const tag = item.querySelector('.tag');
                    if (tag) {
                        tag.className = `tag ${category}`;
                        tag.textContent = category.charAt(0).toUpperCase() + category.slice(1);
                    }
                    const pinnedLabel = item.querySelector('.pinned-label');
                    if (pinnedLabel) {
                        pinnedLabel.style.display = pinned === '1' ? 'inline-flex' : 'none';
                    }
                }
            } else {
                // Add new announcement (static)
                const newItem = document.createElement('div');
                newItem.classList.add('ann-list-item');
                newItem.dataset.category = category;
                newItem.dataset.title = title;
                newItem.dataset.body = body;
                newItem.dataset.pinned = pinned;
                newItem.dataset.media = '[]';
                newItem.dataset.target = target;
                newItem.dataset.department = department;

                newItem.innerHTML = `
                    <div class="ann-list-left">
                        <div class="ann-list-meta">
                            <span class="tag ${category}">${category.charAt(0).toUpperCase() + category.slice(1)}</span>
                            ${pinned === '1' ? '<span class="pinned-label"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" /></svg>Pinned</span>' : ''}
                        </div>
                        <div class="ann-list-title">${title}</div>
                        <div class="ann-list-body">${body}</div>
                        <div class="ann-list-info">
                            <span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" /></svg>
                                {{ auth()->user()->name }}
                            </span>
                            <span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5" /></svg>
                                ${new Date().toISOString().slice(0, 10)}
                            </span>
                        </div>
                    </div>
                    <div class="ann-list-actions">
                        <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" /></svg></button>
                        <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                    </div>
                `;
                document.getElementById('annList').prepend(newItem);
                checkEmpty();
            }

            newAnnModal.classList.remove('show');
            resetModal();
        });
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && newAnnModal && newAnnModal.classList.contains('show')) {
            newAnnModal.classList.remove('show');
            resetModal();
        }
        if (e.key === 'Escape' && deleteAnnModal && deleteAnnModal.classList.contains('show')) {
            closeDeleteModal();
        }
    });
});
