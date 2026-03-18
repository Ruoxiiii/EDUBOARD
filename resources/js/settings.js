document.addEventListener('DOMContentLoaded', () => {
    // ── Theme Selection Logic ──
    const themeOptions = document.querySelectorAll('input[name="color-theme"]');
    const customThemeControls = document.getElementById('customThemeControls');
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Set initial state
    themeOptions.forEach(option => {
        if (option.value === currentTheme) {
            option.checked = true;
            if (currentTheme === 'custom') customThemeControls.style.display = 'block';
        }
        
        option.addEventListener('change', (e) => {
            const selectedTheme = e.target.value;
            customThemeControls.style.display = (selectedTheme === 'custom') ? 'block' : 'none';
            applyTheme(selectedTheme);
        });
    });

    // ── Custom Color Pickers ──
    const primaryPicker = document.getElementById('primaryColorPicker');
    const topbarPicker = document.getElementById('topbarColorPicker');
    const sidebarPicker = document.getElementById('sidebarColorPicker');
    const sidebarTextPicker = document.getElementById('sidebarTextColorPicker');
    const sidebarActivePicker = document.getElementById('sidebarActiveColorPicker');
    
    const primaryHex = document.getElementById('primaryHex');
    const topbarHex = document.getElementById('topbarHex');
    const sidebarHex = document.getElementById('sidebarHex');
    const sidebarTextHex = document.getElementById('sidebarTextHex');
    const sidebarActiveHex = document.getElementById('sidebarActiveHex');

    // Load saved custom colors
    const savedPrimary = localStorage.getItem('customPrimary') || '#0d9488';
    const savedTopbar = localStorage.getItem('customTopbar') || '#ffffff';
    const savedSidebar = localStorage.getItem('customSidebar') || '#111827';
    const savedSidebarText = localStorage.getItem('customSidebarText') || '#9ca3af';
    const savedSidebarActive = localStorage.getItem('customSidebarActive') || '#0d9488';
    
    function updateHexDisplay() {
        if (primaryHex) primaryHex.textContent = primaryPicker.value.toUpperCase();
        if (topbarHex) topbarHex.textContent = topbarPicker.value.toUpperCase();
        if (sidebarHex) sidebarHex.textContent = sidebarPicker.value.toUpperCase();
        if (sidebarTextHex) sidebarTextHex.textContent = sidebarTextPicker.value.toUpperCase();
        if (sidebarActiveHex) sidebarActiveHex.textContent = sidebarActivePicker.value.toUpperCase();
    }

    const allPickers = [primaryPicker, topbarPicker, sidebarPicker, sidebarTextPicker, sidebarActivePicker];
    allPickers.forEach(picker => {
        if (picker) {
            picker.addEventListener('input', () => {
                updateHexDisplay();
                if (localStorage.getItem('theme') === 'custom') triggerColorUpdate();
            });
        }
    });

    // Set initial picker values
    if (primaryPicker) primaryPicker.value = savedPrimary;
    if (topbarPicker) topbarPicker.value = savedTopbar;
    if (sidebarPicker) sidebarPicker.value = savedSidebar;
    if (sidebarTextPicker) sidebarTextPicker.value = savedSidebarText;
    if (sidebarActivePicker) sidebarActivePicker.value = savedSidebarActive;

    updateHexDisplay();

    function triggerColorUpdate() {
        updateCustomColors(
            primaryPicker.value,
            topbarPicker.value,
            sidebarPicker.value,
            sidebarTextPicker.value,
            sidebarActivePicker.value
        );
    }

    function applyTheme(theme) {
        // Reset custom colors first if switching away from custom
        if (theme !== 'custom') {
            document.documentElement.style.removeProperty('--teal');
            document.documentElement.style.removeProperty('--topbar-bg');
            document.documentElement.style.removeProperty('--sidebar-bg');
            document.documentElement.style.removeProperty('--sidebar-text');
            document.documentElement.style.removeProperty('--sidebar-active');
        }

        if (theme === 'system') {
            const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.setAttribute('data-theme', isDark ? 'dark' : 'light');
        } else if (theme === 'custom') {
            document.documentElement.setAttribute('data-theme', 'light');
            triggerColorUpdate();
        } else {
            document.documentElement.setAttribute('data-theme', theme);
        }
        
        localStorage.setItem('theme', theme);
        showSuccess(`Theme changed to ${theme} mode`);
    }

    function updateCustomColors(primary, topbar, sidebar, sidebarText, sidebarActive) {
        document.documentElement.style.setProperty('--teal', primary);
        document.documentElement.style.setProperty('--topbar-bg', topbar);
        document.documentElement.style.setProperty('--sidebar-bg', sidebar);
        document.documentElement.style.setProperty('--sidebar-text', sidebarText);
        document.documentElement.style.setProperty('--sidebar-active', sidebarActive);
        
        localStorage.setItem('customPrimary', primary);
        localStorage.setItem('customTopbar', topbar);
        localStorage.setItem('customSidebar', sidebar);
        localStorage.setItem('customSidebarText', sidebarText);
        localStorage.setItem('customSidebarActive', sidebarActive);
    }

    // ── Logo Upload Logic ──
    const logoInput = document.getElementById('logoInput');
    const logoPreviewBox = document.getElementById('logoPreviewBox');
    const currentLogoPreview = document.getElementById('currentLogoPreview');
    const resetLogoBtn = document.getElementById('resetLogoBtn');
    
    const savedLogo = localStorage.getItem('customLogo');
    if (savedLogo) {
        updateGlobalLogos(savedLogo);
        if (currentLogoPreview) currentLogoPreview.src = savedLogo;
    }

    if (logoPreviewBox) {
        logoPreviewBox.addEventListener('click', () => logoInput.click());
    }

    if (logoInput) {
        logoInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    const base64Logo = event.target.result;
                    localStorage.setItem('customLogo', base64Logo);
                    updateGlobalLogos(base64Logo);
                    if (currentLogoPreview) currentLogoPreview.src = base64Logo;
                    showSuccess('Logo updated successfully');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    if (resetLogoBtn) {
        resetLogoBtn.addEventListener('click', () => {
            localStorage.removeItem('customLogo');
            const defaultLogo = '/images/Logo.jpg';
            updateGlobalLogos(defaultLogo);
            if (currentLogoPreview) currentLogoPreview.src = defaultLogo;
            showSuccess('Logo reset to default');
        });
    }

    function updateGlobalLogos(src) {
        const sidebarLogo = document.querySelector('.sidebar-brand-icon img');
        if (sidebarLogo) sidebarLogo.src = src;
    }

    function showSuccess(msg) {
        const successModal = document.getElementById('successModal');
        const successMsg = document.getElementById('successModalMessage');
        const successIcon = document.getElementById('successModalIcon');
        
        if (successModal && successMsg) {
            successMsg.textContent = msg;
            if (successIcon) successIcon.style.display = 'block';
            successModal.classList.add('show');
        }
    }
});
