document.addEventListener('DOMContentLoaded', () => {
    // ── Add Category Modal ──
    const categoryModal        = document.getElementById('categoryModal');
    const addCategoryBtn       = document.getElementById('addCategoryBtn');
    const categoryModalOverlay = document.getElementById('categoryModalOverlay');
    const closeCategoryModal   = document.getElementById('closeCategoryModal');
    const cancelCategoryBtn    = document.getElementById('cancelCategoryBtn');
    const categoryModalTitle   = document.getElementById('categoryModalTitle');
    const categoryForm         = document.getElementById('categoryForm');
    const categoryName         = document.getElementById('categoryName');
    const categoryColor        = document.getElementById('categoryColor');

    let editingCard = null;

    function openAddModal() {
        editingCard = null;
        categoryModalTitle.textContent = 'Add Category';
        categoryName.value  = '';
        categoryColor.value = 'academic';
        categoryModal.classList.add('show');
    }

    function closeModal() {
        categoryModal.classList.remove('show');
        editingCard = null;
    }

    if (addCategoryBtn) {
        addCategoryBtn.addEventListener('click', openAddModal);
    }

    if (closeCategoryModal) {
        closeCategoryModal.addEventListener('click', closeModal);
    }

    if (cancelCategoryBtn) {
        cancelCategoryBtn.addEventListener('click', closeModal);
    }

    if (categoryModalOverlay) {
        categoryModalOverlay.addEventListener('click', closeModal);
    }

    // ── Save Category ──
    if (categoryForm) {
        categoryForm.addEventListener('submit', e => {
            e.preventDefault();
            const name  = categoryName.value.trim();
            const color = categoryColor.value;
            if (!name) return;

            if (editingCard) {
                // Edit existing
                const tagEl = editingCard.querySelector('.tag');
                tagEl.textContent = name;
                tagEl.className   = `tag ${color}`;
                editingCard.dataset.name = name;
            } else {
                // Add new card
                const card = document.createElement('div');
                card.classList.add('category-card');
                card.dataset.name = name;
                card.innerHTML = `
                    <span class="tag ${color}">${name}</span>
                    <div class="category-actions">
                        <button class="ann-action-btn edit category-edit-btn" title="Edit">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                            </svg>
                        </button>
                        <button class="ann-action-btn delete category-delete-btn" title="Delete">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                `;
                document.getElementById('categoriesGrid').appendChild(card);
                attachCardEvents(card);
            }

            closeModal();
        });
    }

    // ── Edit & Delete Buttons ──
    function attachCardEvents(card) {
        card.querySelector('.category-edit-btn').addEventListener('click', () => {
            editingCard = card;
            categoryModalTitle.textContent = 'Edit Category';
            const tagEl         = card.querySelector('.tag');
            categoryName.value  = tagEl.textContent.trim();
            categoryColor.value = tagEl.classList[1] || 'academic';
            categoryModal.classList.add('show');
        });

        card.querySelector('.category-delete-btn').addEventListener('click', () => {
            cardToDelete = card;
            document.getElementById('deleteCategoryName').textContent = card.dataset.name;
            deleteCategoryModal.classList.add('show');
        });
    }

    // Attach events to existing cards
    document.querySelectorAll('.category-card').forEach(attachCardEvents);

    // ── Delete Modal ──
    const deleteCategoryModal   = document.getElementById('deleteCategoryModal');
    const deleteCategoryOverlay = document.getElementById('deleteCategoryOverlay');
    const closeDeleteCategoryModal   = document.getElementById('closeDeleteCategoryModal');
    const cancelDeleteCategoryBtn    = document.getElementById('cancelDeleteCategoryBtn');
    const confirmDeleteCategoryBtn   = document.getElementById('confirmDeleteCategoryBtn');
    let cardToDelete = null;

    function closeDeleteModal() {
        deleteCategoryModal.classList.remove('show');
        cardToDelete = null;
    }

    if (closeDeleteCategoryModal) {
        closeDeleteCategoryModal.addEventListener('click', closeDeleteModal);
    }

    if (cancelDeleteCategoryBtn) {
        cancelDeleteCategoryBtn.addEventListener('click', closeDeleteModal);
    }

    if (deleteCategoryOverlay) {
        deleteCategoryOverlay.addEventListener('click', closeDeleteModal);
    }

    if (confirmDeleteCategoryBtn) {
        confirmDeleteCategoryBtn.addEventListener('click', () => {
            if (cardToDelete) {
                cardToDelete.remove();
                cardToDelete = null;
            }
            closeDeleteModal();
        });
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            if (categoryModal && categoryModal.classList.contains('show')) {
                closeModal();
            }
            if (deleteCategoryModal && deleteCategoryModal.classList.contains('show')) {
                closeDeleteModal();
            }
        }
    });
});
