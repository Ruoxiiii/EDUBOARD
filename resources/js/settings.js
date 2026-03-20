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
    const mainBgPicker = document.getElementById('mainBgColorPicker');
    const mainTextPicker = document.getElementById('mainTextColorPicker');
    const secondaryTextPicker = document.getElementById('secondaryTextColorPicker');
    const surfacePicker = document.getElementById('surfaceColorPicker');
    
    const primaryHex = document.getElementById('primaryHex');
    const topbarHex = document.getElementById('topbarHex');
    const sidebarHex = document.getElementById('sidebarHex');
    const sidebarTextHex = document.getElementById('sidebarTextHex');
    const sidebarActiveHex = document.getElementById('sidebarActiveHex');
    const mainBgHex = document.getElementById('mainBgHex');
    const mainTextHex = document.getElementById('mainTextHex');
    const secondaryTextHex = document.getElementById('secondaryTextHex');
    const surfaceHex = document.getElementById('surfaceHex');
    const applyToTeacher = document.getElementById('applyToTeacher');
    const applyToStudent = document.getElementById('applyToStudent');
    const syncNavToTeacher = document.getElementById('syncNavToTeacher');
    const updateNavBtn = document.getElementById('updateNavBtn');
    const saveAppearanceBtn = document.getElementById('saveAppearanceBtn');
    const navPosOptions = document.querySelectorAll('input[name="nav-pos"]');

    function updateHexDisplay() {
        if (primaryHex && primaryPicker) primaryHex.textContent = primaryPicker.value.toUpperCase();
        if (topbarHex && topbarPicker) topbarHex.textContent = topbarPicker.value.toUpperCase();
        if (sidebarHex && sidebarPicker) sidebarHex.textContent = sidebarPicker.value.toUpperCase();
        if (sidebarTextHex && sidebarTextPicker) sidebarTextHex.textContent = sidebarTextPicker.value.toUpperCase();
        if (sidebarActiveHex && sidebarActivePicker) sidebarActiveHex.textContent = sidebarActivePicker.value.toUpperCase();
        if (mainBgHex && mainBgPicker) mainBgHex.textContent = mainBgPicker.value.toUpperCase();
        if (mainTextHex && mainTextPicker) mainTextHex.textContent = mainTextPicker.value.toUpperCase();
        if (secondaryTextHex && secondaryTextPicker) secondaryTextHex.textContent = secondaryTextPicker.value.toUpperCase();
        if (surfaceHex && surfacePicker) surfaceHex.textContent = surfacePicker.value.toUpperCase();
    }

    // Load initial state from DOM values (pre-filled by PHP)
    updateHexDisplay();

    // ── Navigation Position Logic ──
    navPosOptions.forEach(option => {
        option.addEventListener('change', (e) => {
            const pos = e.target.value;
            const layout = document.querySelector('.admin-layout');
            if (layout) {
                layout.classList.remove('nav-left', 'nav-right', 'nav-top');
                layout.classList.add('nav-' + pos);
            }
        });
    });

    if (updateNavBtn) {
        updateNavBtn.addEventListener('click', () => {
            saveSettings({
                navPos: document.querySelector('input[name="nav-pos"]:checked').value,
                syncNavToTeacher: syncNavToTeacher.checked
            });
        });
    }

    async function saveSettings(data) {
        try {
            const response = await fetch('/admin/settings/appearance', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            
            // If theme was updated, update localStorage to match
            if (data.theme) {
                localStorage.setItem('theme', data.theme);
            }
            
            showSuccess(result.message);
            
            // Reload after a short delay to finalize system-wide changes (like sidebar logo)
            setTimeout(() => {
                window.location.reload();
            }, 1500);
            
        } catch (error) {
            console.error('Error saving settings:', error);
        }
    }

    // ── Theme Selection Logic ──
    themeOptions.forEach(option => {
        option.addEventListener('change', (e) => {
            const selectedTheme = e.target.value;
            customThemeControls.style.display = (selectedTheme === 'custom') ? 'block' : 'none';
            applyTheme(selectedTheme);
            
            // Auto-save when switching between Light/Dark/System
            if (selectedTheme !== 'custom') {
                saveSettings({ theme: selectedTheme });
            }
        });
    });

    // ── Real-time Preview ──
    const allPickers = [primaryPicker, topbarPicker, sidebarPicker, sidebarTextPicker, sidebarActivePicker, mainBgPicker, mainTextPicker, secondaryTextPicker, surfacePicker];
    allPickers.forEach(picker => {
        if (picker) {
            picker.addEventListener('input', (e) => {
                const currentPicker = e.target;
                // Update the specific hex label for this picker
                const hexId = currentPicker.id.replace('ColorPicker', 'Hex');
                const hexLabel = document.getElementById(hexId);
                if (hexLabel) {
                    hexLabel.textContent = currentPicker.value.toUpperCase();
                }

                // Always update preview if Custom is selected
                const selectedTheme = document.querySelector('input[name="color-theme"]:checked').value;
                if (selectedTheme === 'custom') {
                    document.documentElement.setAttribute('data-theme', 'light');
                    triggerColorUpdate();
                }
            });
        }
    });

    // ── Manual Save for Custom Appearance ──
    if (saveAppearanceBtn) {
        saveAppearanceBtn.addEventListener('click', () => {
            saveSettings({
                theme: 'custom',
                customPrimary: primaryPicker.value,
                customTopbar: topbarPicker.value,
                customSidebar: sidebarPicker.value,
                customSidebarText: sidebarTextPicker.value,
                customSidebarActive: sidebarActivePicker.value,
                customMainBg: mainBgPicker.value,
                customMainText: mainTextPicker.value,
                customSecondaryText: secondaryTextPicker.value,
                customSurface: surfacePicker.value,
                applyToTeacher: applyToTeacher.checked,
                applyToStudent: applyToStudent.checked,
                navPos: document.querySelector('input[name="nav-pos"]:checked').value
            });
        });
    }

    // ── Auto-save Toggle ──
    if (applyToTeacher) {
        applyToTeacher.addEventListener('change', () => {
            if (document.querySelector('input[name="color-theme"]:checked').value !== 'custom') {
                saveSettings({ applyToTeacher: applyToTeacher.checked });
            }
        });
    }

    if (applyToStudent) {
        applyToStudent.addEventListener('change', () => {
            if (document.querySelector('input[name="color-theme"]:checked').value !== 'custom') {
                saveSettings({ applyToStudent: applyToStudent.checked });
            }
        });
    }

    function triggerColorUpdate() {
        updateCustomColors(
            primaryPicker.value,
            topbarPicker.value,
            sidebarPicker.value,
            sidebarTextPicker.value,
            sidebarActivePicker.value,
            mainBgPicker.value,
            mainTextPicker.value,
            secondaryTextPicker.value,
            surfacePicker.value
        );
    }

    function applyTheme(theme, showMsg = true) {
        // Reset custom colors first if switching away from custom
        if (theme !== 'custom') {
            document.documentElement.style.removeProperty('--teal');
            document.documentElement.style.removeProperty('--primary-color');
            document.documentElement.style.removeProperty('--topbar-bg');
            document.documentElement.style.removeProperty('--sidebar-bg');
            document.documentElement.style.removeProperty('--sidebar-text');
            document.documentElement.style.removeProperty('--sidebar-active');
            document.documentElement.style.removeProperty('--bg');
            document.documentElement.style.removeProperty('--text');
            document.documentElement.style.removeProperty('--muted');
            document.documentElement.style.removeProperty('--surface');
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
        if (showMsg) showSuccess(`Theme changed to ${theme} mode`);
    }

    function updateCustomColors(primary, topbar, sidebar, sidebarText, sidebarActive, mainBg, mainText, secondaryText, surface) {
        const root = document.documentElement;
        root.style.setProperty('--teal', primary, 'important');
        root.style.setProperty('--primary-color', primary, 'important');
        root.style.setProperty('--topbar-bg', topbar, 'important');
        root.style.setProperty('--sidebar-bg', sidebar, 'important');
        root.style.setProperty('--sidebar-text', sidebarText, 'important');
        root.style.setProperty('--sidebar-active', sidebarActive, 'important');
        root.style.setProperty('--bg', mainBg, 'important');
        root.style.setProperty('--text', mainText, 'important');
        root.style.setProperty('--muted', secondaryText, 'important');
        root.style.setProperty('--surface', surface, 'important');
        
        localStorage.setItem('customPrimary', primary);
        localStorage.setItem('customTopbar', topbar);
        localStorage.setItem('customSidebar', sidebar);
        localStorage.setItem('customSidebarText', sidebarText);
        localStorage.setItem('customSidebarActive', sidebarActive);
        localStorage.setItem('customMainBg', mainBg);
        localStorage.setItem('customMainText', mainText);
        localStorage.setItem('customSecondaryText', secondaryText);
        localStorage.setItem('customSurface', surface);
    }

    // ── Logo Upload Logic ──
    const logoInput = document.getElementById('logoInput');
    const logoPreviewBox = document.getElementById('logoPreviewBox');
    const currentLogoPreview = document.getElementById('currentLogoPreview');
    const resetLogoBtn = document.getElementById('resetLogoBtn');

    if (logoPreviewBox) {
        logoPreviewBox.addEventListener('click', () => logoInput.click());
    }

    if (logoInput) {
        logoInput.addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('logo', file);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                try {
                    const response = await fetch('/admin/settings/appearance', {
                        method: 'POST',
                        body: formData
                    });
                    const result = await response.json();
                    
                    if (result.logo_url) {
                        updateGlobalLogos(result.logo_url);
                        if (currentLogoPreview) currentLogoPreview.src = result.logo_url;
                        showSuccess(result.message);
                        
                        // Force a refresh to ensure the logo is loaded server-side for all portals
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                } catch (error) {
                    console.error('Error uploading logo:', error);
                }
            }
        });
    }

    if (resetLogoBtn) {
        resetLogoBtn.addEventListener('click', async () => {
            try {
                const response = await fetch('/admin/settings/logo/reset', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                const result = await response.json();
                
                const defaultLogo = '/images/Logo.jpg';
                updateGlobalLogos(defaultLogo);
                if (currentLogoPreview) currentLogoPreview.src = defaultLogo;
                showSuccess(result.message);
                
                // Force refresh to restore default logo everywhere
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } catch (error) {
                console.error('Error resetting logo:', error);
            }
        });
    }

    function updateGlobalLogos(src) {
        const sidebarBrandIcons = document.querySelectorAll('.sidebar-brand-icon');
        const navbarLogos = document.querySelectorAll('.brand-icon');
        
        sidebarBrandIcons.forEach(icon => {
            icon.innerHTML = `<img src="${src}" alt="EduBoard Logo" style="width: 100%; height: 100%; object-fit: contain;">`;
        });

        navbarLogos.forEach(logo => {
            logo.src = src;
        });
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
