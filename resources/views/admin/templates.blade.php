<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Templates - EduBoard Admin</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js', 'resources/js/templates.js'])
</head>
<body>

<div class="admin-layout">
    <x-admin-sidebar />
    <div class="admin-main">
        <x-admin-topbar title="Templates" />
        <div class="admin-content">

            {{-- Page Header --}}
            <div class="page-header" style="display:flex; align-items:flex-start; justify-content:space-between;">
                <div>
                    <h1>Templates</h1>
                    <p>Reusable announcement templates for Westfield Academy</p>
                </div>
                <button class="btn-new-ann" id="addTemplateBtn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New Template
                </button>
            </div>

            {{-- Templates Grid --}}
            <div class="templates-grid" id="templatesGrid">

                <div class="template-card" data-title="Class Suspension Notice" data-category="emergency" data-content="Due to [REASON], all classes are suspended on [DATE]. Please stay safe and monitor official channels for updates.">
                    <div class="template-card-header">
                        <div class="template-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div class="template-card-title-group">
                            <div class="template-card-title">Class Suspension Notice</div>
                        </div>
                        <span class="tag emergency">Emergency</span>
                    </div>
                    <p class="template-card-desc">Template for announcing class suspensions due to weather or emergencies.</p>
                    <div class="template-card-footer">
                        <button class="template-use-btn use-template-btn">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                            </svg>
                            Use Template
                        </button>
                        <div class="template-card-actions">
                            <button class="ann-action-btn edit template-edit-btn" title="Edit">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                </svg>
                            </button>
                            <button class="ann-action-btn delete template-delete-btn" title="Delete">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="template-card" data-title="Exam Schedule Release" data-category="academic" data-content="The examination schedule for [SEMESTER] [SCHOOL YEAR] is now available. Please review your schedule carefully and prepare accordingly. Contact your department for any concerns.">
                    <div class="template-card-header">
                        <div class="template-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div class="template-card-title-group">
                            <div class="template-card-title">Exam Schedule Release</div>
                        </div>
                        <span class="tag academic">Academic</span>
                    </div>
                    <p class="template-card-desc">Standardized template for releasing examination schedules.</p>
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
                </div>

                <div class="template-card" data-title="Event Invitation" data-category="events" data-content="You are cordially invited to [EVENT NAME] on [DATE] at [VENUE]. Activities include [ACTIVITIES]. We look forward to your participation. For inquiries, contact [CONTACT].">
                    <div class="template-card-header">
                        <div class="template-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div class="template-card-title-group">
                            <div class="template-card-title">Event Invitation</div>
                        </div>
                        <span class="tag events">Events</span>
                    </div>
                    <p class="template-card-desc">General template for school events and celebrations.</p>
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
                </div>

                <div class="template-card" data-title="Enrollment Advisory" data-category="administrative" data-content="Enrollment for [SEMESTER] [SCHOOL YEAR] will begin on [START DATE] and end on [END DATE]. Please proceed to your respective departments for enrollment. Bring the following requirements: [REQUIREMENTS].">
                    <div class="template-card-header">
                        <div class="template-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div class="template-card-title-group">
                            <div class="template-card-title">Enrollment Advisory</div>
                        </div>
                        <span class="tag administrative">Administrative</span>
                    </div>
                    <p class="template-card-desc">Template for enrollment-related announcements and schedules.</p>
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
                </div>

            </div>

        </div>
    </div>
</div>

{{-- New / Edit Template Modal --}}
<div class="admin-modal" id="templateModal">
    <div class="admin-modal-overlay" id="templateModalOverlay"></div>
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3 id="templateModalTitle">New Template</h3>
            <button class="admin-modal-close" id="closeTemplateModal">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form class="admin-modal-form" id="templateForm">
            @csrf
            <div class="form-group">
                <label>Template Title</label>
                <input type="text" id="templateTitle" placeholder="e.g. Class Suspension Notice">
            </div>
            <div class="form-group">
                <label>Category</label>
                <select id="templateCategory">
                    <option value="">Select category</option>
                    <option value="emergency">Emergency</option>
                    <option value="events">Events</option>
                    <option value="administrative">Administrative</option>
                    <option value="academic">Academic</option>
                    <option value="student-affairs">Student Affairs</option>
                    <option value="general">General</option>
                </select>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" id="templateDesc" placeholder="Short description of this template">
            </div>
            <div class="form-group">
                <label>Template Content</label>
                <textarea id="templateContent" rows="6" placeholder="Write your template content here. Use [PLACEHOLDER] for variable fields."></textarea>
            </div>
            <div class="admin-modal-actions">
                <button type="button" class="btn-cancel" id="cancelTemplateBtn">Cancel</button>
                <button type="submit" class="btn-save">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Save Template
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Use Template Modal --}}
<div class="admin-modal" id="useTemplateModal">
    <div class="admin-modal-overlay" id="useTemplateModalOverlay"></div>
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3 id="useTemplateTitle">Use Template</h3>
            <button class="admin-modal-close" id="closeUseTemplateModal">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form class="admin-modal-form" id="useTemplateForm">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" id="useTitle">
            </div>
            <div class="form-group">
                <label>Category</label>
                <select id="useCategory">
                    <option value="emergency">Emergency</option>
                    <option value="events">Events</option>
                    <option value="administrative">Administrative</option>
                    <option value="academic">Academic</option>
                    <option value="student-affairs">Student Affairs</option>
                    <option value="general">General</option>
                </select>
            </div>
            <div class="form-group">
                <label>Content <span style="font-size:11px; color:var(--muted); font-weight:400;">Edit the placeholders in [ ] brackets</span></label>
                <textarea id="useContent" rows="7"></textarea>
            </div>
            <div class="form-group">
                <label>Pin Announcement</label>
                <select id="usePin">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="admin-modal-actions">
                <button type="button" class="btn-cancel" id="cancelUseTemplateBtn">Cancel</button>
                <button type="submit" class="btn-save">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                    Publish
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Confirm Modal --}}
<div class="admin-modal" id="deleteTemplateModal">
    <div class="admin-modal-overlay" id="deleteTemplateOverlay"></div>
    <div class="admin-modal-box" style="max-width:400px;">
        <div class="admin-modal-header">
            <h3>Delete Template</h3>
            <button class="admin-modal-close" id="closeDeleteTemplateModal">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="admin-modal-form">
            <p style="font-size:14px; color:var(--muted); line-height:1.6; margin-bottom:8px;">
                Are you sure you want to delete <strong id="deleteTemplateName" style="color:var(--text);"></strong>? This action cannot be undone.
            </p>
            <div class="admin-modal-actions">
                <button type="button" class="btn-cancel" id="cancelDeleteTemplateBtn">Cancel</button>
                <button type="button" class="btn-danger" id="confirmDeleteTemplateBtn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Success Modal --}}
<div class="admin-modal" id="successModal">
    <div class="admin-modal-overlay" id="successModalOverlay"></div>
    <div class="admin-modal-box" style="max-width:400px;">
        <div class="admin-modal-header">
            <h3>Success</h3>
            <button class="admin-modal-close" id="closeSuccessModalTop">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="admin-modal-form">
            <div id="successModalIcon" style="text-align:center; display:none;">
                <svg class="animated-check" viewBox="0 0 52 52">
                    <circle class="animated-check-circle" cx="26" cy="26" r="25" fill="none" />
                    <path class="animated-check-path" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                </svg>
            </div>
            <p id="successModalMessage" style="font-size:14px; color:var(--muted); text-align:center; line-height:1.6; margin-bottom:8px;">
                Action completed successfully.
            </p>
            <div class="admin-modal-actions">
                <button type="button" class="btn-save" id="closeSuccessModalBtn">Done</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>