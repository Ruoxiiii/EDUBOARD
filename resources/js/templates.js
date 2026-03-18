document.addEventListener('DOMContentLoaded', () => {
    // ── Success Modal ──
    const successModal = document.getElementById('successModal');
    const successModalOverlay = document.getElementById('successModalOverlay');
    const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');
    const successModalMessage = document.getElementById('successModalMessage');
    const successModalIcon = document.getElementById('successModalIcon');

    function showSuccess(msg) {
        if (successModalMessage) successModalMessage.textContent = msg;
        if (successModalIcon) {
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

    // ── New Template Modal ──
    const templateModal        = document.getElementById('templateModal');
    const addTemplateBtn       = document.getElementById('addTemplateBtn');
    const templateModalOverlay = document.getElementById('templateModalOverlay');
    const closeTemplateModal   = document.getElementById('closeTemplateModal');
    const cancelTemplateBtn    = document.getElementById('cancelTemplateBtn');
    const templateModalTitle   = document.getElementById('templateModalTitle');
    const templateForm         = document.getElementById('templateForm');
    let editingTemplateCard    = null;

    function openTemplateModal(card = null) {
        editingTemplateCard = card;
        if (card) {
            templateModalTitle.textContent    = 'Edit Template';
            document.getElementById('templateTitle').value    = card.dataset.title || '';
            document.getElementById('templateCategory').value = card.dataset.category || '';
            document.getElementById('templateDesc').value     = card.querySelector('.template-card-desc')?.textContent || '';
            document.getElementById('templateContent').value  = card.dataset.content || '';
        } else {
            templateModalTitle.textContent = 'New Template';
            templateForm.reset();
        }
        templateModal.classList.add('show');
    }

    function closeTemplate() {
        templateModal.classList.remove('show');
        editingTemplateCard = null;
    }

    if (addTemplateBtn) {
        addTemplateBtn.addEventListener('click', () => openTemplateModal());
    }

    if (closeTemplateModal) {
        closeTemplateModal.addEventListener('click', closeTemplate);
    }

    if (cancelTemplateBtn) {
        cancelTemplateBtn.addEventListener('click', closeTemplate);
    }

    if (templateModalOverlay) {
        templateModalOverlay.addEventListener('click', closeTemplate);
    }

    if (templateForm) {
        templateForm.addEventListener('submit', e => {
            e.preventDefault();
            const title    = document.getElementById('templateTitle').value.trim();
            const category = document.getElementById('templateCategory').value;
            const desc     = document.getElementById('templateDesc').value.trim();
            const content  = document.getElementById('templateContent').value.trim();
            if (!title) return;

            if (editingTemplateCard) {
                editingTemplateCard.dataset.title    = title;
                editingTemplateCard.dataset.category = category;
                editingTemplateCard.dataset.content  = content;
                editingTemplateCard.querySelector('.template-card-title').textContent = title;
                editingTemplateCard.querySelector('.template-card-desc').textContent  = desc;
                const tagEl = editingTemplateCard.querySelector('.tag');
                tagEl.className   = `tag ${category}`;
                tagEl.textContent = category.charAt(0).toUpperCase() + category.slice(1);
                showSuccess('Template updated successfully');
            } else {
                const card = document.createElement('div');
                card.classList.add('template-card');
                card.dataset.title    = title;
                card.dataset.category = category;
                card.dataset.content  = content;
                card.innerHTML = `
                    <div class="template-card-header">
                        <div class="template-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div class="template-card-title-group">
                            <div class="template-card-title">${title}</div>
                        </div>
                        <span class="tag ${category}">${category.charAt(0).toUpperCase() + category.slice(1)}</span>
                    </div>
                    <p class="template-card-desc">${desc}</p>
                    <div class="template-card-footer">
                        <button class="template-use-btn use-template-btn">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                            </svg>
                            Use Template
                        </button>
                        <div class="template-card-actions">
                            <button class="ann-action-btn edit template-edit-btn" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                            <button class="ann-action-btn delete template-delete-btn" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                        </div>
                    </div>
                `;
                document.getElementById('templatesGrid').appendChild(card);
                attachCardEvents(card);
                showSuccess('Template added successfully');
            }
            closeTemplate();
        });
    }

    // ── Use Template Modal ──
    const useTemplateModal        = document.getElementById('useTemplateModal');
    const useTemplateModalOverlay = document.getElementById('useTemplateModalOverlay');
    const closeUseTemplateModal   = document.getElementById('closeUseTemplateModal');
    const cancelUseTemplateBtn    = document.getElementById('cancelUseTemplateBtn');

    function openUseModal(card) {
        document.getElementById('useTemplateTitle').textContent  = card.dataset.title;
        document.getElementById('useTitle').value    = card.dataset.title;
        document.getElementById('useCategory').value = card.dataset.category;
        document.getElementById('useContent').value  = card.dataset.content;
        useTemplateModal.classList.add('show');
    }

    function closeUseModal() { 
        if (useTemplateModal) {
            useTemplateModal.classList.remove('show'); 
        }
    }

    if (closeUseTemplateModal) {
        closeUseTemplateModal.addEventListener('click', closeUseModal);
    }

    if (cancelUseTemplateBtn) {
        cancelUseTemplateBtn.addEventListener('click', closeUseModal);
    }

    if (useTemplateModalOverlay) {
        useTemplateModalOverlay.addEventListener('click', closeUseModal);
    }

    const useTemplateForm = document.getElementById('useTemplateForm');
    if (useTemplateForm) {
        useTemplateForm.addEventListener('submit', e => {
            e.preventDefault();
            closeUseModal();
            showSuccess('Announcement published using template');
            // TODO: redirect to announcements page with pre-filled data
        });
    }

    // ── Delete Modal ──
    const deleteTemplateModal   = document.getElementById('deleteTemplateModal');
    const deleteTemplateOverlay = document.getElementById('deleteTemplateOverlay');
    const closeDeleteTemplateModal = document.getElementById('closeDeleteTemplateModal');
    const cancelDeleteTemplateBtn  = document.getElementById('cancelDeleteTemplateBtn');
    const confirmDeleteTemplateBtn = document.getElementById('confirmDeleteTemplateBtn');
    let cardToDelete = null;

    function closeDeleteModal() {
        if (deleteTemplateModal) {
            deleteTemplateModal.classList.remove('show');
            cardToDelete = null;
        }
    }

    if (closeDeleteTemplateModal) {
        closeDeleteTemplateModal.addEventListener('click', closeDeleteModal);
    }

    if (cancelDeleteTemplateBtn) {
        cancelDeleteTemplateBtn.addEventListener('click', closeDeleteModal);
    }

    if (deleteTemplateOverlay) {
        deleteTemplateOverlay.addEventListener('click', closeDeleteModal);
    }

    const closeDeleteTemplateModal = document.getElementById('closeDeleteTemplateModal');
    if (closeDeleteTemplateModal) {
        closeDeleteTemplateModal.addEventListener('click', closeDeleteModal);
    }

    if (confirmDeleteTemplateBtn) {
        confirmDeleteTemplateBtn.addEventListener('click', () => {
            if (cardToDelete) { 
                cardToDelete.remove(); 
                cardToDelete = null; 
                showSuccess('Template deleted successfully');
            }
            closeDeleteModal();
        });
    }

    // ── Attach card events ──
    function attachCardEvents(card) {
        const useBtn = card.querySelector('.use-template-btn');
        if (useBtn) {
            useBtn.addEventListener('click', () => openUseModal(card));
        }
        const editBtn = card.querySelector('.template-edit-btn');
        if (editBtn) {
            editBtn.addEventListener('click', () => openTemplateModal(card));
        }
        const deleteBtn = card.querySelector('.template-delete-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', () => {
                cardToDelete = card;
                document.getElementById('deleteTemplateName').textContent = card.dataset.title;
                deleteTemplateModal.classList.add('show');
            });
        }
    }

    document.querySelectorAll('.template-card').forEach(attachCardEvents);

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeTemplate();
            closeUseModal();
            closeDeleteModal();
        }
    });
});
