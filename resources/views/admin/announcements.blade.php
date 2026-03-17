<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Announcements - EduBoard Admin</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js', 'resources/js/announcements.js'])
</head>
<body>

<div class="admin-layout">

    <x-admin-sidebar />

    <div class="admin-main">

        <x-admin-topbar title="Announcements" />

        <div class="admin-content">

            {{-- Page Header --}}
            <div class="page-header" style="display: flex; align-items: flex-start; justify-content: space-between;">
                <div>
                    <h1>Announcements</h1>
                    <p>Manage and publish announcements for Westfield Academy</p>
                </div>
                <button class="btn-new-ann" id="newAnnouncementBtn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New Announcement
                </button>
            </div>

            {{-- Filters --}}
            <div class="ann-filters">
                <div class="ann-filter-pills">
                    <button class="ann-filter-pill active" data-filter="all">All</button>
                    <button class="ann-filter-pill" data-filter="emergency">Emergency</button>
                    <button class="ann-filter-pill" data-filter="events">Events</button>
                    <button class="ann-filter-pill" data-filter="administrative">Administrative</button>
                    <button class="ann-filter-pill" data-filter="academic">Academic</button>
                    <button class="ann-filter-pill" data-filter="student-affairs">Student Affairs</button>
                    <button class="ann-filter-pill" data-filter="general">General</button>
                </div>
                <div class="ann-search">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <input type="text" id="annSearch" placeholder="Search announcements...">
                </div>
            </div>
            {{-- Date Filter --}}
            <div class="date-filter" style="margin-bottom: 20px;">
                <div class="date-filter-inner">
                    <div class="date-input-group">
                        <label for="dateFrom">From</label>
                        <input type="date" id="dateFrom" class="date-input">
                    </div>
                    <div class="date-separator">—</div>
                    <div class="date-input-group">
                        <label for="dateTo">To</label>
                        <input type="date" id="dateTo" class="date-input">
                    </div>
                    <button class="date-filter-btn" id="applyDateFilter">Apply</button>
                    <button class="date-filter-clear" id="clearDateFilter">Clear</button>
                </div>
            </div>

            {{-- Announcement List --}}
            <div class="ann-list" id="annList">

                {{-- Card 1 --}}
                <div class="ann-list-item" 
                    data-category="emergency" 
                    data-title="Classes Suspended on March 10" 
                    data-body="Due to inclement weather, all classes are suspended on March 10, 2026. Please stay safe and monitor official channels for updates." 
                    data-pinned="1" 
                    data-media='[]'>
                    <div class="ann-list-left">
                        <div class="ann-list-meta">
                            <span class="tag emergency">Emergency</span>
                            <span class="pinned-label">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                                Pinned
                            </span>
                        </div>
                        <div class="ann-list-title">Classes Suspended on March 10</div>
                        <div class="ann-list-body">Due to inclement weather, all classes are suspended on March 10, 2026. Please stay safe and monitor official channels for updates.</div>
                        <div class="ann-list-info">
                            <span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                                </svg>
                                Dr. Santos
                            </span>
                            <span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5" />
                                </svg>
                                2026-03-08
                            </span>
                        </div>
                    </div>
                    <div class="ann-list-actions">
                        <button class="ann-action-btn edit" title="Edit">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                            </svg>
                        </button>
                        <button class="ann-action-btn delete" title="Delete">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="ann-list-item" 
                    data-category="events" 
                    data-title="Foundation Day Celebration" 
                    data-body="Join us for the 50th Foundation Day celebration on March 15! Activities include a parade, cultural performances, and a grand alumni homecoming." 
                    data-pinned="1" 
                    data-media='[{"type":"image","url":"/images/download.jpg"},{"type":"image","url":"/images/download.jpg"},{"type":"image","url":"/images/download.jpg"},{"type":"image","url":"/images/download.jpg"}]'>
                    <div class="ann-list-left">
                        <div class="ann-list-meta">
                            <span class="tag events">Events</span>
                            <span class="pinned-label">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                                Pinned
                            </span>
                        </div>
                        <div class="ann-list-title">Foundation Day Celebration</div>
                        <div class="ann-list-body">Join us for the 50th Foundation Day celebration on March 15! Activities include a parade, cultural performances, and a grand alumni homecoming.</div>
                        <div class="ann-list-info">
                            <span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                                </svg>
                                Events Committee
                            </span>
                            <span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5" />
                                </svg>
                                2026-03-07
                            </span>
                            <span class="ann-has-media">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                4 images
                            </span>
                        </div>
                    </div>
                    <div class="ann-list-actions">
                        <button class="ann-action-btn edit" title="Edit">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                            </svg>
                        </button>
                        <button class="ann-action-btn delete" title="Delete">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="ann-list-item" 
                    data-category="events" 
                    data-title="Foundation Day Highlights Video" 
                    data-body="Watch the highlights from this year's Foundation Day celebration. Relive the parade, performances, and memorable moments from the event." 
                    data-pinned="0" 
                    data-media='[{"type":"video","url":"/video/simple.mp4"},{"type":"image","url":"/images/download.jpg"}]'>
                    <div class="ann-list-left">
                        <div class="ann-list-meta">
                            <span class="tag events">Events</span>
                        </div>
                        <div class="ann-list-title">Foundation Day Highlights Video</div>
                        <div class="ann-list-body">Watch the highlights from this year's Foundation Day celebration. Relive the parade, performances, and memorable moments from the event.</div>
                        <div class="ann-list-info">
                            <span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                                </svg>
                                Events Committee
                            </span>
                            <span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5" />
                                </svg>
                                2026-03-14
                            </span>
                            <span class="ann-has-media">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                1 video · 1 image
                            </span>
                        </div>
                    </div>
                    <div class="ann-list-actions">
                        <button class="ann-action-btn edit" title="Edit">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                            </svg>
                        </button>
                        <button class="ann-action-btn delete" title="Delete">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Empty State --}}
                <div class="ann-empty-state" id="annEmptyState" style="display: none;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                    <p>No announcements found.</p>
                </div>

            </div>
            {{-- End Ann List --}}

        </div>
    </div>
</div>

{{-- New Announcement Modal --}}
<div class="admin-modal" id="newAnnModal">
    <div class="admin-modal-overlay" id="newAnnModalOverlay"></div>
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3 id="modalTitle">New Announcement</h3>
            <button class="admin-modal-close" id="closeNewAnnModal">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form class="admin-modal-form" id="newAnnForm">
            @csrf
            <input type="hidden" id="annId">
            <div class="form-group">
                <label>Title</label>
                <input type="text" id="annTitle" placeholder="Announcement title">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Category</label>
                    <select id="annCategory">
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
                    <label>Pin Announcement</label>
                    <select id="annPin">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Send To</label>
                    <select id="annTarget">
                        <option value="all">All (Everyone)</option>
                        <option value="teachers">All Teachers</option>
                        <option value="students">All Students</option>
                        <option value="department">Specific Department</option>
                    </select>
                </div>
                <div class="form-group" id="departmentTargetGroup" style="display: none;">
                    <label>Department</label>
                    <select id="annDepartmentTarget">
                        <option value="">Select Department</option>
                        <option value="COT">COT - College of Technology</option>
                        <option value="COB">COB - College of Business</option>
                        <option value="CON">CON - College of Nursing</option>
                        <option value="COE">COE - College of Education</option>
                        <option value="COAS">COAS - College of Arts & Sciences</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Send To</label>
                    <select id="annTarget">
                        <option value="all">All (Everyone)</option>
                        <option value="teachers">All Teachers</option>
                        <option value="students">All Students</option>
                        <option value="department">Specific Department</option>
                    </select>
                </div>
                <div class="form-group" id="departmentTargetGroup" style="display: none;">
                    <label>Department</label>
                    <select id="annDepartmentTarget">
                        <option value="">Select Department</option>
                        <option value="COT">COT - College of Technology</option>
                        <option value="COB">COB - College of Business</option>
                        <option value="CON">CON - College of Nursing</option>
                        <option value="COE">COE - College of Education</option>
                        <option value="COAS">COAS - College of Arts & Sciences</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Content</label>
                <textarea id="annContent" placeholder="Write your announcement here..." rows="5"></textarea>
            </div>

            <div class="form-group">
                <label>Attach Media</label>
                <div class="file-upload-area" id="fileUploadArea">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <p>Click to upload or drag and drop</p>
                    <span>Images or videos supported</span>
                    <input type="file" id="annMedia" multiple accept="image/*,video/*">
                </div>

                {{-- File Preview Grid --}}
                <div class="file-preview-grid" id="filePreviewGrid"></div>
            </div>

            <div class="admin-modal-actions">
                <button type="button" class="btn-cancel" id="cancelNewAnnBtn">Cancel</button>
                <button type="submit" class="btn-save" id="submitBtn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                    <span id="submitBtnText">Publish</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="admin-modal" id="deleteAnnModal">
    <div class="admin-modal-overlay" id="deleteAnnModalOverlay"></div>
    <div class="admin-modal-box" style="max-width: 420px;">
        <div class="admin-modal-header">
            <h3>Confirm Deletion</h3>
            <button class="admin-modal-close" id="closeDeleteAnnModal">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <p>Are you sure you want to delete this announcement? This action cannot be undone.</p>
        </div>
        <div class="admin-modal-actions">
            <button type="button" class="btn-cancel" id="cancelDeleteAnnBtn">Cancel</button>
            <button type="button" class="btn-danger" id="confirmDeleteAnnBtn">Delete</button>
        </div>
    </div>
</div>

</body>
</html>