<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users - EduBoard Admin</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js', 'resources/js/users.js'])
</head>
<body>

<div class="admin-layout">
    <x-admin-sidebar />
    <div class="admin-main">
        <x-admin-topbar title="Users" />
        <div class="admin-content">

            {{-- Page Header --}}
            <div class="page-header" style="display:flex; align-items:flex-start; justify-content:space-between;">
                <div>
                    <h1>Users</h1>
                    <p>Manage teachers and students of Westfield Academy</p>
                </div>
                <button class="btn-new-ann" id="addUserBtn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add User
                </button>
            </div>

            {{-- Tabs --}}
            <div class="user-tabs">
                <button class="user-tab active" data-tab="teachers">Teachers <span class="user-tab-count">5</span></button>
                <button class="user-tab" data-tab="students">Students <span class="user-tab-count">5</span></button>
            </div>

            {{-- Filters --}}
            <div class="user-filters">
                <div class="user-filter-group">
                    <label>University</label>
                    <select id="universityFilter">
                        <option value="all">All Universities</option>
                        <option value="westfield">Westfield Academy</option>
                    </select>
                </div>
                <div class="user-filter-group">
                    <label>Department</label>
                    <select id="departmentFilter">
                        <option value="all">All Departments</option>
                        <option value="COT">COT - College of Technology</option>
                        <option value="COB">COB - College of Business</option>
                        <option value="CON">CON - College of Nursing</option>
                        <option value="COE">COE - College of Education</option>
                        <option value="COAS">COAS - College of Arts & Sciences</option>
                    </select>
                </div>
                <div class="user-filter-group">
                    <label>Course</label>
                    <select id="courseFilter" disabled>
                        <option value="all">Select Department first</option>
                    </select>
                </div>
                <div class="ann-search" style="flex:1; min-width:200px;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <input type="text" id="userSearch" placeholder="Search users...">
                </div>
            </div>

            {{-- Table --}}
            <div class="users-table-wrap">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Course</th>
                            <th class="col-section" style="display:none;">Section</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">

                        {{-- ── Teachers ── --}}
                        <tr data-role="teachers" data-dept="COT" data-course="BSIT">
                            <td><div class="user-name-cell"><div class="user-avatar-sm">PR</div>Prof. Reyes</div></td>
                            <td class="text-muted">reyes@westfield.edu</td>
                            <td>COT</td>
                            <td>BSIT</td>
                            <td class="cell-section" style="display:none;"></td>
                            <td><span class="status-badge active">Active</span></td>
                            <td><div class="user-row-actions">
                                <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                                <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                            </div></td>
                        </tr>

                        <tr data-role="teachers" data-dept="COT" data-course="BSCS">
                            <td><div class="user-name-cell"><div class="user-avatar-sm">PG</div>Prof. Garcia</div></td>
                            <td class="text-muted">garcia@westfield.edu</td>
                            <td>COT</td>
                            <td>BSCS</td>
                            <td class="cell-section" style="display:none;"></td>
                            <td><span class="status-badge active">Active</span></td>
                            <td><div class="user-row-actions">
                                <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                                <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                            </div></td>
                        </tr>

                        <tr data-role="teachers" data-dept="COB" data-course="BSBA">
                            <td><div class="user-name-cell"><div class="user-avatar-sm">PC</div>Prof. Cruz</div></td>
                            <td class="text-muted">cruz@westfield.edu</td>
                            <td>COB</td>
                            <td>BSBA</td>
                            <td class="cell-section" style="display:none;"></td>
                            <td><span class="status-badge active">Active</span></td>
                            <td><div class="user-row-actions">
                                <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                                <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                            </div></td>
                        </tr>

                        <tr data-role="teachers" data-dept="CON" data-course="BSN">
                            <td><div class="user-name-cell"><div class="user-avatar-sm">PL</div>Prof. Lim</div></td>
                            <td class="text-muted">lim@westfield.edu</td>
                            <td>CON</td>
                            <td>BSN</td>
                            <td class="cell-section" style="display:none;"></td>
                            <td><span class="status-badge inactive">Inactive</span></td>
                            <td><div class="user-row-actions">
                                <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                                <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                            </div></td>
                        </tr>

                        <tr data-role="teachers" data-dept="COE" data-course="BSEd">
                            <td><div class="user-name-cell"><div class="user-avatar-sm">PT</div>Prof. Torres</div></td>
                            <td class="text-muted">torres@westfield.edu</td>
                            <td>COE</td>
                            <td>BSEd</td>
                            <td class="cell-section" style="display:none;"></td>
                            <td><span class="status-badge active">Active</span></td>
                            <td><div class="user-row-actions">
                                <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                                <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                            </div></td>
                        </tr>

                        {{-- ── Students ── --}}
                        <tr data-role="students" data-dept="COT" data-course="BSIT" style="display:none;">
                            <td><div class="user-name-cell"><div class="user-avatar-sm" style="background:#3b82f6;">JD</div>Juan Dela Cruz</div></td>
                            <td class="text-muted">juan@westfield.edu</td>
                            <td>COT</td>
                            <td>BSIT</td>
                            <td class="cell-section">A</td>
                            <td><span class="status-badge active">Active</span></td>
                            <td><div class="user-row-actions">
                                <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                                <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                            </div></td>
                        </tr>

                        <tr data-role="students" data-dept="COT" data-course="BSCS" style="display:none;">
                            <td><div class="user-name-cell"><div class="user-avatar-sm" style="background:#3b82f6;">MS</div>Maria Santos</div></td>
                            <td class="text-muted">maria@westfield.edu</td>
                            <td>COT</td>
                            <td>BSCS</td>
                            <td class="cell-section">B</td>
                            <td><span class="status-badge active">Active</span></td>
                            <td><div class="user-row-actions">
                                <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                                <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                            </div></td>
                        </tr>

                        <tr data-role="students" data-dept="COB" data-course="BSBA" style="display:none;">
                            <td><div class="user-name-cell"><div class="user-avatar-sm" style="background:#3b82f6;">AL</div>Ana Lopez</div></td>
                            <td class="text-muted">ana@westfield.edu</td>
                            <td>COB</td>
                            <td>BSBA</td>
                            <td class="cell-section">A</td>
                            <td><span class="status-badge active">Active</span></td>
                            <td><div class="user-row-actions">
                                <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                                <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                            </div></td>
                        </tr>

                        <tr data-role="students" data-dept="CON" data-course="BSN" style="display:none;">
                            <td><div class="user-name-cell"><div class="user-avatar-sm" style="background:#3b82f6;">RM</div>Rico Mendoza</div></td>
                            <td class="text-muted">rico@westfield.edu</td>
                            <td>CON</td>
                            <td>BSN</td>
                            <td class="cell-section">C</td>
                            <td><span class="status-badge inactive">Inactive</span></td>
                            <td><div class="user-row-actions">
                                <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                                <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                            </div></td>
                        </tr>

                        <tr data-role="students" data-dept="COE" data-course="BSEd" style="display:none;">
                            <td><div class="user-name-cell"><div class="user-avatar-sm" style="background:#3b82f6;">LR</div>Lisa Reyes</div></td>
                            <td class="text-muted">lisa@westfield.edu</td>
                            <td>COE</td>
                            <td>BSEd</td>
                            <td class="cell-section">A</td>
                            <td><span class="status-badge active">Active</span></td>
                            <td><div class="user-row-actions">
                                <button class="ann-action-btn edit" title="Edit"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg></button>
                                <button class="ann-action-btn delete" title="Delete"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                            </div></td>
                        </tr>

                    </tbody>
                </table>

                {{-- Empty State --}}
                <div class="ann-empty-state" id="usersEmptyState" style="display:none;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <p>No users found.</p>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Add/Edit User Modal --}}
<div class="admin-modal" id="userModal">
    <div class="admin-modal-overlay" id="userModalOverlay"></div>
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3 id="userModalTitle">Add User</h3>
            <button class="admin-modal-close" id="closeUserModal">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form class="admin-modal-form" id="userForm">
            @csrf
            <input type="hidden" id="userId">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="userName" class="form-control" placeholder="e.g. Juan Dela Cruz">
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="userEmail" class="form-control" placeholder="e.g. juan@example.com">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Role</label>
                    <select id="userRole" class="form-control">
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select id="userStatus" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Department</label>
                    <select id="userDepartment" class="form-control">
                        <option value="">Select Department</option>
                        <option value="COT">COT - College of Technology</option>
                        <option value="COB">COB - College of Business</option>
                        <option value="CON">CON - College of Nursing</option>
                        <option value="COE">COE - College of Education</option>
                        <option value="COAS">COAS - College of Arts & Sciences</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Course</label>
                    <select id="userCourse" class="form-control" disabled>
                        <option value="">Select Department first</option>
                    </select>
                </div>
            </div>

            <div class="admin-modal-actions">
                <button type="button" class="btn-cancel" id="cancelUserBtn">Cancel</button>
                <button type="submit" class="btn-save" id="saveUserBtn">Save</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>