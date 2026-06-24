<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Profile Management</title>

    <!-- Font Awesome 6 (Free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- ============================================================
    STYLES
    ============================================================ -->
    <style>
        /* ----- CSS Variables (Theme) ----- */
        :root {
            --sidebar-width: 260px;
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #818cf8;
            --danger: #ef4444;
            --success: #22c55e;
            --warning: #f59e0b;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.08);
            --radius: 12px;
            --radius-sm: 8px;
            --transition: 0.25s ease;
        }

        /* ----- Reset & Base ----- */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--gray-100);
            color: var(--gray-800);
            display: flex;
            min-height: 100vh;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        button {
            cursor: pointer;
            font: inherit;
            border: none;
            background: none;
        }
        input,
        select,
        textarea {
            font: inherit;
            outline: none;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-sm);
            padding: 0.6rem 0.8rem;
            width: 100%;
            background: #fff;
            transition: border var(--transition);
        }
        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }
        textarea {
            resize: vertical;
            min-height: 60px;
        }
        label {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--gray-700);
            display: block;
            margin-bottom: 0.25rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* ----- Scrollbar ----- */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: var(--gray-100);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--gray-400);
        }

        /* ============================================================
        SIDEBAR
        ============================================================ */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--gray-900);
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            transition: transform var(--transition);
            overflow-y: auto;
        }
        .sidebar-brand {
            font-size: 1.4rem;
            font-weight: 700;
            padding: 0 0.5rem 1.5rem 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .sidebar-brand span {
            color: var(--primary-light);
        }
        .sidebar-nav {
            margin-top: 1.5rem;
            flex: 1;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.7rem 0.8rem;
            border-radius: var(--radius-sm);
            color: var(--gray-300);
            transition: all var(--transition);
            font-weight: 500;
            margin-bottom: 0.2rem;
        }
        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }
        .sidebar-nav a.active {
            background: var(--primary);
            color: #fff;
        }
        .sidebar-nav .icon {
            font-size: 1.2rem;
            width: 1.6rem;
            text-align: center;
        }
        .sidebar-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 1rem;
            font-size: 0.8rem;
            color: var(--gray-400);
            text-align: center;
        }

        /* ----- Sidebar Toggle (mobile) ----- */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 0.8rem;
            left: 0.8rem;
            z-index: 110;
            background: var(--gray-900);
            color: #fff;
            width: 42px;
            height: 42px;
            border-radius: var(--radius-sm);
            font-size: 1.5rem;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-lg);
            border: none;
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 90;
        }

        /* ============================================================
        MAIN CONTENT
        ============================================================ */
        .main {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 1.5rem 2rem 2rem;
            min-height: 100vh;
        }

        /* ----- Top Bar ----- */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-200);
        }
        .topbar h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--gray-900);
        }
        .topbar h1 small {
            font-weight: 400;
            font-size: 0.9rem;
            color: var(--gray-500);
            margin-left: 0.5rem;
        }
        .topbar-actions {
            display: flex;
            gap: 0.7rem;
            flex-wrap: wrap;
        }

        /* ----- Buttons ----- */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.2rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.875rem;
            transition: all var(--transition);
            border: 1px solid transparent;
            background: var(--gray-200);
            color: var(--gray-700);
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow);
        }
        .btn-primary {
            background: var(--primary);
            color: #fff;
        }
        .btn-primary:hover {
            background: var(--primary-dark);
        }
        .btn-success {
            background: var(--success);
            color: #fff;
        }
        .btn-success:hover {
            background: #16a34a;
        }
        .btn-danger {
            background: var(--danger);
            color: #fff;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
        .btn-warning {
            background: var(--warning);
            color: #fff;
        }
        .btn-warning:hover {
            background: #d97706;
        }
        .btn-outline {
            background: transparent;
            border-color: var(--gray-300);
            color: var(--gray-600);
        }
        .btn-outline:hover {
            background: var(--gray-100);
        }
        .btn-sm {
            padding: 0.3rem 0.7rem;
            font-size: 0.8rem;
        }
        .btn-xs {
            padding: 0.15rem 0.5rem;
            font-size: 0.7rem;
            border-radius: 4px;
        }

        /* ============================================================
        DASHBOARD CARDS
        ============================================================ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.8rem;
        }
        .stat-card {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border-left: 4px solid var(--primary);
            transition: transform var(--transition);
        }
        .stat-card:hover {
            transform: translateY(-2px);
        }
        .stat-card .label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-500);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .stat-card .value {
            font-size: 2rem;
            font-weight: 700;
            margin-top: 0.2rem;
            color: var(--gray-900);
        }
        .stat-card.green {
            border-left-color: var(--success);
        }
        .stat-card.blue {
            border-left-color: var(--primary);
        }
        .stat-card.purple {
            border-left-color: #8b5cf6;
        }
        .stat-card.orange {
            border-left-color: var(--warning);
        }
        .stat-card .sub {
            font-size: 0.75rem;
            color: var(--gray-400);
            margin-top: 0.2rem;
        }

        /* ============================================================
        SEARCH & FILTER BAR
        ============================================================ */
        .toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            align-items: center;
            background: #fff;
            padding: 0.8rem 1.2rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
        }
        .toolbar .search-wrap {
            flex: 1;
            min-width: 180px;
            position: relative;
        }
        .toolbar .search-wrap input {
            padding-left: 2.2rem;
            border-radius: 20px;
            border-color: var(--gray-200);
        }
        .toolbar .search-wrap .search-icon {
            position: absolute;
            left: 0.7rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
        }
        .toolbar .filter-group {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            align-items: center;
        }
        .toolbar .filter-group select {
            width: auto;
            min-width: 120px;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            border-color: var(--gray-200);
            background: #fff;
        }
        .toolbar .filter-group .btn {
            border-radius: 20px;
        }

        /* ============================================================
        STUDENT TABLE
        ============================================================ */
        .table-wrap {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 1rem;
        }
        .table-scroll {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }
        thead {
            background: var(--gray-50);
            border-bottom: 2px solid var(--gray-200);
        }
        th {
            text-align: left;
            padding: 0.8rem 1rem;
            font-weight: 600;
            color: var(--gray-600);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            white-space: nowrap;
        }
        th .sort-btn {
            background: none;
            border: none;
            font-weight: 600;
            color: var(--gray-600);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.2rem;
        }
        th .sort-btn:hover {
            color: var(--gray-900);
        }
        td {
            padding: 0.7rem 1rem;
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
        }
        tr:hover td {
            background: var(--gray-50);
        }
        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            background: var(--gray-200);
            display: block;
        }
        .avatar-placeholder {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--primary-light);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
        }
        .badge {
            display: inline-block;
            padding: 0.15rem 0.6rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            background: var(--gray-200);
            color: var(--gray-700);
        }
        .badge.male {
            background: #dbeafe;
            color: #1d4ed8;
        }
        .badge.female {
            background: #fce7f3;
            color: #be185d;
        }
        .actions {
            display: flex;
            gap: 0.3rem;
            flex-wrap: wrap;
        }

        /* ----- Empty state ----- */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--gray-500);
        }
        .empty-state .icon {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        /* ============================================================
        PAGINATION
        ============================================================ */
        .pagination-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.8rem;
            padding: 0.8rem 1rem;
            border-top: 1px solid var(--gray-200);
        }
        .pagination-wrap .info {
            font-size: 0.8rem;
            color: var(--gray-500);
        }
        .pagination {
            display: flex;
            gap: 0.3rem;
        }
        .pagination button {
            padding: 0.3rem 0.7rem;
            border-radius: var(--radius-sm);
            border: 1px solid var(--gray-200);
            background: #fff;
            font-weight: 500;
            font-size: 0.8rem;
            transition: all var(--transition);
        }
        .pagination button:hover:not(:disabled) {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }
        .pagination button.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }
        .pagination button:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* ============================================================
        MODALS
        ============================================================ */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 200;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            backdrop-filter: blur(3px);
        }
        .modal-overlay.open {
            display: flex;
        }
        .modal {
            background: #fff;
            border-radius: var(--radius);
            max-width: 640px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 1.8rem 2rem 2rem;
            box-shadow: var(--shadow-lg);
            animation: modalIn 0.25s ease;
        }
        @keyframes modalIn {
            from {
                transform: scale(0.95) translateY(20px);
                opacity: 0;
            }
            to {
                transform: scale(1) translateY(0);
                opacity: 1;
            }
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .modal-header h2 {
            font-size: 1.3rem;
            font-weight: 700;
        }
        .modal-close {
            font-size: 1.8rem;
            line-height: 1;
            color: var(--gray-400);
            transition: color var(--transition);
            padding: 0 0.3rem;
        }
        .modal-close:hover {
            color: var(--gray-800);
        }
        .modal .form-actions {
            display: flex;
            gap: 0.8rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }
        .modal .form-group .file-input-wrap {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
        }
        .modal .form-group .file-input-wrap input[type="file"] {
            width: auto;
            padding: 0.3rem;
        }
        .modal .preview-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gray-200);
        }

        /* ----- Delete Confirmation ----- */
        .modal.confirm .modal {
            max-width: 440px;
            text-align: center;
        }
        .modal.confirm .modal .confirm-icon {
            font-size: 3.5rem;
            color: var(--danger);
            margin-bottom: 0.5rem;
        }
        .modal.confirm .modal p {
            color: var(--gray-500);
            margin-bottom: 1.2rem;
        }

        /* ============================================================
        NOTIFICATIONS
        ============================================================ */
        .notif-container {
            position: fixed;
            top: 1.2rem;
            right: 1.2rem;
            z-index: 300;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            max-width: 380px;
            width: 100%;
        }
        .notif {
            padding: 0.8rem 1.2rem;
            border-radius: var(--radius-sm);
            background: #fff;
            box-shadow: var(--shadow-lg);
            border-left: 4px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 0.7rem;
            animation: slideIn 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .notif.success {
            border-left-color: var(--success);
        }
        .notif.error {
            border-left-color: var(--danger);
        }
        .notif.warning {
            border-left-color: var(--warning);
        }
        @keyframes slideIn {
            from {
                transform: translateX(40px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .notif .notif-close {
            margin-left: auto;
            font-size: 1.2rem;
            color: var(--gray-400);
            cursor: pointer;
            padding: 0 0.2rem;
        }
        .notif .notif-close:hover {
            color: var(--gray-800);
        }

        /* ============================================================
        RESPONSIVE
        ============================================================ */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .sidebar-overlay.open {
                display: block;
            }
            .sidebar-toggle {
                display: flex;
            }
            .main {
                margin-left: 0;
                padding: 1rem;
            }
            .topbar h1 {
                font-size: 1.2rem;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
            .modal {
                padding: 1.2rem;
            }
        }
        @media (max-width: 576px) {
            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }
            .toolbar .filter-group {
                flex-wrap: wrap;
            }
            .toolbar .filter-group select {
                min-width: 100px;
                flex: 1;
            }
            .topbar-actions .btn span {
                display: none;
            }
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
            .stat-card .value {
                font-size: 1.5rem;
            }
            .pagination-wrap {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>

    <!-- ============================================================
    SIDEBAR
    ============================================================ -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-graduation-cap"></i> <span>Student</span>Hub
        </div>
        <nav class="sidebar-nav">
            <a href="#" class="active" data-page="dashboard">
                <span class="icon"><i class="fas fa-chart-pie"></i></span> Dashboard
            </a>
            <a href="#" data-page="students">
                <span class="icon"><i class="fas fa-users"></i></span> Students
            </a>
            <a href="#" data-page="add">
                <span class="icon"><i class="fas fa-plus-circle"></i></span> Add Student
            </a>
        </nav>
        <div class="sidebar-footer">v1.0 &bull; SQLite</div>
    </aside>

    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar Toggle (mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- ============================================================
    MAIN
    ============================================================ -->
    <main class="main" id="mainContent">

        <!-- TOPBAR -->
        <header class="topbar">
            <h1 id="pageTitle">Dashboard <small>overview</small></h1>
            <div class="topbar-actions">
                <button class="btn btn-primary" id="btnAddStudent">
                    <i class="fas fa-plus-circle"></i> <span>Add Student</span>
                </button>
                <button class="btn btn-outline" id="btnRefresh">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
        </header>

        <!-- ============================================================
        DASHBOARD VIEW
        ============================================================ -->
        <section id="viewDashboard">
            <!-- Stats Cards -->
            <div class="stats-grid" id="statsGrid">
                <div class="stat-card blue">
                    <div class="label"><i class="fas fa-user-graduate"></i> Total Students</div>
                    <div class="value" id="statTotal">0</div>
                </div>
                <div class="stat-card green">
                    <div class="label"><i class="fas fa-male"></i> Male</div>
                    <div class="value" id="statMale">0</div>
                </div>
                <div class="stat-card purple">
                    <div class="label"><i class="fas fa-female"></i> Female</div>
                    <div class="value" id="statFemale">0</div>
                </div>
                <div class="stat-card orange">
                    <div class="label"><i class="fas fa-calendar-plus"></i> Recent Additions</div>
                    <div class="value" id="statRecent">0</div>
                    <div class="sub">last 7 days</div>
                </div>
            </div>

            <!-- Recent Students -->
            <div class="table-wrap">
                <div style="padding:1rem 1rem 0;font-weight:600;color:var(--gray-700);">
                    <i class="fas fa-clock"></i> Recent Students
                </div>
                <div class="table-scroll">
                    <table>
                        <thead><tr><th>Student</th><th>Department</th><th>Email</th><th>Added</th></tr></thead>
                        <tbody id="recentTableBody">
                            <tr><td colspan="4" class="empty-state">
                                <span class="icon"><i class="far fa-folder-open"></i></span>
                                No students yet
                            </td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- ============================================================
        STUDENTS VIEW (table + toolbar)
        ============================================================ -->
        <section id="viewStudents" style="display:none;">
            <!-- Toolbar -->
            <div class="toolbar">
                <div class="search-wrap">
                    <span class="search-icon"><i class="fas fa-search"></i></span>
                    <input type="text" id="searchInput" placeholder="Search by name, email, dept, or ID..." />
                </div>
                <div class="filter-group">
                    <select id="filterGender"><option value="">All Genders</option><option value="Male">Male</option><option value="Female">Female</option></select>
                    <select id="filterDept"><option value="">All Departments</option></select>
                    <button class="btn btn-outline btn-sm" id="btnClearFilters">
                        <i class="fas fa-times"></i> Clear
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-wrap">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th><button class="sort-btn" data-sort="first_name">Name ↕</button></th>
                                <th><button class="sort-btn" data-sort="gender">Gender ↕</button></th>
                                <th><button class="sort-btn" data-sort="age">Age ↕</button></th>
                                <th><button class="sort-btn" data-sort="department">Department ↕</button></th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th style="min-width:100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="studentTableBody">
                            <tr><td colspan="9" class="empty-state">
                                <span class="icon"><i class="far fa-folder-open"></i></span>
                                No students found
                            </td></tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="pagination-wrap">
                    <span class="info" id="paginationInfo">Showing 0 of 0</span>
                    <div class="pagination" id="paginationControls"></div>
                </div>
            </div>
        </section>

    </main>

    <!-- ============================================================
    ADD / EDIT MODAL
    ============================================================ -->
    <div class="modal-overlay" id="formModal">
        <div class="modal">
            <div class="modal-header">
                <h2 id="formModalTitle">Add Student</h2>
                <button class="modal-close" id="formModalClose">&times;</button>
            </div>
            <form id="studentForm" enctype="multipart/form-data">
                <input type="hidden" name="id" id="formId" value="" />

                <div class="form-row">
                    <div class="form-group">
                        <label for="formFirstName">First Name *</label>
                        <input type="text" name="first_name" id="formFirstName" required />
                    </div>
                    <div class="form-group">
                        <label for="formLastName">Last Name *</label>
                        <input type="text" name="last_name" id="formLastName" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="formGender">Gender *</label>
                        <select name="gender" id="formGender" required>
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formAge">Age *</label>
                        <input type="number" name="age" id="formAge" required min="1" max="120" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="formDepartment">Department *</label>
                    <input type="text" name="department" id="formDepartment" required placeholder="e.g. Computer Science" />
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="formEmail">Email *</label>
                        <input type="email" name="email" id="formEmail" required placeholder="student@example.com" />
                    </div>
                    <div class="form-group">
                        <label for="formPhone">Phone</label>
                        <input type="text" name="phone" id="formPhone" placeholder="+1234567890" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="formAddress">Address</label>
                    <textarea name="address" id="formAddress" rows="2" placeholder="Street, City, State"></textarea>
                </div>
                <div class="form-group">
                    <label>Profile Picture</label>
                    <div class="file-input-wrap">
                        <input type="file" name="profile_picture" id="formPicture" accept="image/*" />
                        <div id="formPicturePreview"></div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-outline" id="formCancel">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="formSubmit">
                        <i class="fas fa-save"></i> Save Student
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================
    DELETE CONFIRM MODAL
    ============================================================ -->
    <div class="modal-overlay confirm" id="deleteModal">
        <div class="modal">
            <div class="confirm-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <h2>Delete Student?</h2>
            <p id="deleteMessage">Are you sure you want to delete this student? This action cannot be undone.</p>
            <input type="hidden" id="deleteId" value="" />
            <div class="form-actions" style="justify-content:center;border:none;padding-top:0;">
                <button class="btn btn-outline" id="deleteCancel">Cancel</button>
                <button class="btn btn-danger" id="deleteConfirm">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
            </div>
        </div>
    </div>

    <!-- ============================================================
    NOTIFICATIONS
    ============================================================ -->
    <div class="notif-container" id="notifContainer"></div>

    <!-- ============================================================
    JAVASCRIPT
    ============================================================ -->
    <script>
        // =============================================================
        // STATE
        // =============================================================
        const state = {
            students: [],
            currentPage: 1,
            perPage: 10,
            totalPages: 0,
            total: 0,
            sortField: 'first_name',
            sortDir: 'asc',
            search: '',
            genderFilter: '',
            deptFilter: '',
            departments: [],
            editingId: null,
        };

        // =============================================================
        // DOM REFS
        // =============================================================
        const $ = (s) => document.querySelector(s);
        const $$ = (s) => document.querySelectorAll(s);

        const sidebar = $('#sidebar');
        const sidebarToggle = $('#sidebarToggle');
        const sidebarOverlay = $('#sidebarOverlay');
        const mainContent = $('#mainContent');
        const pageTitle = $('#pageTitle');

        const viewDashboard = $('#viewDashboard');
        const viewStudents = $('#viewStudents');

        const statTotal = $('#statTotal');
        const statMale = $('#statMale');
        const statFemale = $('#statFemale');
        const statRecent = $('#statRecent');
        const recentTableBody = $('#recentTableBody');

        const studentTableBody = $('#studentTableBody');
        const searchInput = $('#searchInput');
        const filterGender = $('#filterGender');
        const filterDept = $('#filterDept');
        const btnClearFilters = $('#btnClearFilters');
        const paginationInfo = $('#paginationInfo');
        const paginationControls = $('#paginationControls');

        const btnAddStudent = $('#btnAddStudent');
        const btnRefresh = $('#btnRefresh');

        const formModal = $('#formModal');
        const formModalTitle = $('#formModalTitle');
        const formModalClose = $('#formModalClose');
        const studentForm = $('#studentForm');
        const formId = $('#formId');
        const formFirstName = $('#formFirstName');
        const formLastName = $('#formLastName');
        const formGender = $('#formGender');
        const formAge = $('#formAge');
        const formDepartment = $('#formDepartment');
        const formEmail = $('#formEmail');
        const formPhone = $('#formPhone');
        const formAddress = $('#formAddress');
        const formPicture = $('#formPicture');
        const formPicturePreview = $('#formPicturePreview');
        const formCancel = $('#formCancel');
        const formSubmit = $('#formSubmit');

        const deleteModal = $('#deleteModal');
        const deleteId = $('#deleteId');
        const deleteMessage = $('#deleteMessage');
        const deleteCancel = $('#deleteCancel');
        const deleteConfirm = $('#deleteConfirm');

        const notifContainer = $('#notifContainer');

        // =============================================================
        // SIDEBAR NAV
        // =============================================================
        function navigateTo(page) {
            $$('.sidebar-nav a').forEach(a => a.classList.toggle('active', a.dataset.page === page));
            if (page === 'dashboard') {
                viewDashboard.style.display = 'block';
                viewStudents.style.display = 'none';
                pageTitle.innerHTML = 'Dashboard <small>overview</small>';
                loadDashboard();
            } else if (page === 'students') {
                viewDashboard.style.display = 'none';
                viewStudents.style.display = 'block';
                pageTitle.innerHTML = 'Students <small>manage all records</small>';
                loadStudents();
            } else if (page === 'add') {
                openFormModal();
            }
            // close mobile sidebar
            closeSidebar();
        }

        $$('.sidebar-nav a').forEach(a => {
            a.addEventListener('click', (e) => {
                e.preventDefault();
                navigateTo(a.dataset.page);
            });
        });

        // Sidebar toggle
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('open');
        });

        function closeSidebar() {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('open');
        }
        sidebarOverlay.addEventListener('click', closeSidebar);

        // =============================================================
        // NOTIFICATIONS
        // =============================================================
        function notify(message, type = 'success') {
            const el = document.createElement('div');
            el.className = `notif ${type}`;
            el.innerHTML = `<span>${message}</span><span class="notif-close">&times;</span>`;
            notifContainer.prepend(el);
            el.querySelector('.notif-close').addEventListener('click', () => el.remove());
            setTimeout(() => { if (el.parentNode) el.remove(); }, 5000);
        }

        // =============================================================
        // API HELPERS
        // =============================================================
        async function api(method, endpoint, data = null) {
            const opts = { method, headers: {} };
            if (data instanceof FormData) {
                opts.body = data;
            } else if (data) {
                opts.headers['Content-Type'] = 'application/json';
                opts.body = JSON.stringify(data);
            }
            const res = await fetch(endpoint, opts);
            return res.json();
        }

        // =============================================================
        // DASHBOARD
        // =============================================================
        async function loadDashboard() {
            try {
                const res = await api('GET', '?action=stats');
                if (res.success) {
                    statTotal.textContent = res.data.total;
                    statMale.textContent = res.data.male;
                    statFemale.textContent = res.data.female;
                    statRecent.textContent = res.data.recent;
                }
                // load recent students
                const recentRes = await api('GET', '?action=recent');
                if (recentRes.success && recentRes.data.length) {
                    recentTableBody.innerHTML = recentRes.data.map(s => `
                        <tr>
                            <td><strong>${escapeHtml(s.first_name)} ${escapeHtml(s.last_name)}</strong></td>
                            <td>${escapeHtml(s.department)}</td>
                            <td>${escapeHtml(s.email)}</td>
                            <td>${formatDate(s.created_at)}</td>
                        </tr>
                    `).join('');
                } else {
                    recentTableBody.innerHTML = `
                        <tr><td colspan="4" class="empty-state">
                            <span class="icon"><i class="far fa-folder-open"></i></span>
                            No recent students
                        </td></tr>
                    `;
                }
            } catch (e) {
                notify('Failed to load dashboard', 'error');
            }
        }

        // =============================================================
        // STUDENTS LIST
        // =============================================================
        async function loadStudents() {
            const params = new URLSearchParams({
                action: 'list',
                page: state.currentPage,
                per_page: state.perPage,
                sort: state.sortField,
                dir: state.sortDir,
                search: state.search,
                gender: state.genderFilter,
                dept: state.deptFilter,
            });
            try {
                const res = await api('GET', `?${params}`);
                if (res.success) {
                    state.students = res.data.data;
                    state.total = res.data.total;
                    state.totalPages = res.data.total_pages;
                    state.departments = res.data.departments || [];
                    renderTable();
                    renderPagination();
                    populateDeptFilter();
                } else {
                    notify(res.message || 'Failed to load students', 'error');
                }
            } catch (e) {
                notify('Network error loading students', 'error');
            }
        }

        function renderTable() {
            if (!state.students.length) {
                studentTableBody.innerHTML = `
                    <tr><td colspan="9" class="empty-state">
                        <span class="icon"><i class="far fa-folder-open"></i></span>
                        No students found
                    </td></tr>
                `;
                return;
            }
            studentTableBody.innerHTML = state.students.map((s, i) => {
                const idx = (state.currentPage - 1) * state.perPage + i + 1;
                const avatar = s.profile_picture ?
                    `<img src="${escapeHtml(s.profile_picture)}" class="avatar" alt="photo" />` :
                    `<div class="avatar-placeholder">${escapeHtml(s.first_name.charAt(0))}${escapeHtml(s.last_name.charAt(0))}</div>`;
                const genderBadge = `<span class="badge ${s.gender.toLowerCase()}">${escapeHtml(s.gender)}</span>`;
                return `
                    <tr>
                        <td>${idx}</td>
                        <td>${avatar}</td>
                        <td><strong>${escapeHtml(s.first_name)} ${escapeHtml(s.last_name)}</strong></td>
                        <td>${genderBadge}</td>
                        <td>${s.age}</td>
                        <td>${escapeHtml(s.department)}</td>
                        <td>${escapeHtml(s.email)}</td>
                        <td>${escapeHtml(s.phone || '—')}</td>
                        <td>
                            <div class="actions">
                                <button class="btn btn-primary btn-xs" onclick="editStudent(${s.id})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-xs" onclick="confirmDelete(${s.id}, '${escapeHtml(s.first_name)} ${escapeHtml(s.last_name)}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function renderPagination() {
            const { currentPage, totalPages, total, perPage } = state;
            const start = total ? (currentPage - 1) * perPage + 1 : 0;
            const end = Math.min(currentPage * perPage, total);
            paginationInfo.textContent = total ? `Showing ${start}–${end} of ${total}` : 'No records';

            let html = '';
            html += `<button onclick="goToPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''}>‹</button>`;
            for (let i = 1; i <= totalPages; i++) {
                if (i === currentPage) {
                    html += `<button class="active">${i}</button>`;
                } else if (i <= 3 || i > totalPages - 3 || Math.abs(i - currentPage) <= 1) {
                    html += `<button onclick="goToPage(${i})">${i}</button>`;
                } else if (i === 4 && currentPage > 5) {
                    html += `<button disabled>…</button>`;
                } else if (i === totalPages - 3 && currentPage < totalPages - 4) {
                    html += `<button disabled>…</button>`;
                }
            }
            html += `<button onclick="goToPage(${currentPage + 1})" ${currentPage >= totalPages ? 'disabled' : ''}>›</button>`;
            paginationControls.innerHTML = html;
        }

        function goToPage(page) {
            if (page < 1 || page > state.totalPages) return;
            state.currentPage = page;
            loadStudents();
        }

        // =============================================================
        // FILTERS & SEARCH
        // =============================================================
        searchInput.addEventListener('input', debounce(() => {
            state.search = searchInput.value.trim();
            state.currentPage = 1;
            loadStudents();
        }, 300));

        filterGender.addEventListener('change', () => {
            state.genderFilter = filterGender.value;
            state.currentPage = 1;
            loadStudents();
        });

        filterDept.addEventListener('change', () => {
            state.deptFilter = filterDept.value;
            state.currentPage = 1;
            loadStudents();
        });

        btnClearFilters.addEventListener('click', () => {
            searchInput.value = '';
            filterGender.value = '';
            filterDept.value = '';
            state.search = '';
            state.genderFilter = '';
            state.deptFilter = '';
            state.currentPage = 1;
            loadStudents();
        });

        function populateDeptFilter() {
            const current = filterDept.value;
            filterDept.innerHTML = '<option value="">All Departments</option>' +
                state.departments.map(d => `<option value="${escapeHtml(d)}">${escapeHtml(d)}</option>`).join('');
            filterDept.value = current;
        }

        // =============================================================
        // SORTING
        // =============================================================
        document.addEventListener('click', (e) => {
            const btn = e.target.closest('.sort-btn');
            if (!btn) return;
            const field = btn.dataset.sort;
            if (state.sortField === field) {
                state.sortDir = state.sortDir === 'asc' ? 'desc' : 'asc';
            } else {
                state.sortField = field;
                state.sortDir = 'asc';
            }
            state.currentPage = 1;
            loadStudents();
        });

        // =============================================================
        // FORM MODAL
        // =============================================================
        function openFormModal(data = null) {
            formModal.classList.add('open');
            if (data) {
                formModalTitle.textContent = 'Edit Student';
                formSubmit.innerHTML = '<i class="fas fa-edit"></i> Update Student';
                formId.value = data.id;
                formFirstName.value = data.first_name;
                formLastName.value = data.last_name;
                formGender.value = data.gender;
                formAge.value = data.age;
                formDepartment.value = data.department;
                formEmail.value = data.email;
                formPhone.value = data.phone || '';
                formAddress.value = data.address || '';
                if (data.profile_picture) {
                    formPicturePreview.innerHTML =
                        `<img src="${escapeHtml(data.profile_picture)}" class="preview-img" alt="preview" />`;
                } else {
                    formPicturePreview.innerHTML = '';
                }
                state.editingId = data.id;
            } else {
                formModalTitle.textContent = 'Add Student';
                formSubmit.innerHTML = '<i class="fas fa-save"></i> Save Student';
                studentForm.reset();
                formId.value = '';
                formPicturePreview.innerHTML = '';
                state.editingId = null;
            }
        }

        function closeFormModal() {
            formModal.classList.remove('open');
        }

        formModalClose.addEventListener('click', closeFormModal);
        formCancel.addEventListener('click', closeFormModal);
        formModal.addEventListener('click', (e) => {
            if (e.target === formModal) closeFormModal();
        });

        btnAddStudent.addEventListener('click', () => openFormModal());

        // Picture preview
        formPicture.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    formPicturePreview.innerHTML =
                        `<img src="${ev.target.result}" class="preview-img" alt="preview" />`;
                };
                reader.readAsDataURL(file);
            } else {
                formPicturePreview.innerHTML = '';
            }
        });

        // =============================================================
        // FORM SUBMIT (Add / Edit)
        // =============================================================
        studentForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Basic validation
            const fn = formFirstName.value.trim();
            const ln = formLastName.value.trim();
            const gender = formGender.value;
            const age = parseInt(formAge.value);
            const dept = formDepartment.value.trim();
            const email = formEmail.value.trim();

            if (!fn || !ln || !gender || !age || !dept || !email) {
                notify('Please fill in all required fields.', 'warning');
                return;
            }
            if (isNaN(age) || age < 1 || age > 120) {
                notify('Please enter a valid age (1–120).', 'warning');
                return;
            }
            if (!email.includes('@') || !email.includes('.')) {
                notify('Please enter a valid email address.', 'warning');
                return;
            }

            const formData = new FormData();
            formData.append('action', state.editingId ? 'update' : 'create');
            if (state.editingId) formData.append('id', state.editingId);
            formData.append('first_name', fn);
            formData.append('last_name', ln);
            formData.append('gender', gender);
            formData.append('age', age);
            formData.append('department', dept);
            formData.append('email', email);
            formData.append('phone', formPhone.value.trim());
            formData.append('address', formAddress.value.trim());
            if (formPicture.files.length) {
                formData.append('profile_picture', formPicture.files[0]);
            }

            try {
                const res = await api('POST', '?', formData);
                if (res.success) {
                    notify(res.message, 'success');
                    closeFormModal();
                    loadStudents();
                    loadDashboard();
                } else {
                    notify(res.message || 'Operation failed', 'error');
                }
            } catch (err) {
                notify('Network error', 'error');
            }
        });

        // =============================================================
        // EDIT STUDENT
        // =============================================================
        async function editStudent(id) {
            try {
                const res = await api('GET', `?action=get&id=${id}`);
                if (res.success) {
                    openFormModal(res.data);
                } else {
                    notify(res.message || 'Failed to load student', 'error');
                }
            } catch (e) {
                notify('Network error', 'error');
            }
        }
        window.editStudent = editStudent;

        // =============================================================
        // DELETE CONFIRM
        // =============================================================
        function confirmDelete(id, name) {
            deleteId.value = id;
            deleteMessage.textContent = `Are you sure you want to delete "${name}"? This action cannot be undone.`;
            deleteModal.classList.add('open');
        }
        window.confirmDelete = confirmDelete;

        deleteCancel.addEventListener('click', () => deleteModal.classList.remove('open'));
        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) deleteModal.classList.remove('open');
        });

        deleteConfirm.addEventListener('click', async () => {
            const id = deleteId.value;
            if (!id) return;
            try {
                const res = await api('DELETE', `?action=delete&id=${id}`);
                if (res.success) {
                    notify(res.message, 'success');
                    deleteModal.classList.remove('open');
                    loadStudents();
                    loadDashboard();
                } else {
                    notify(res.message || 'Delete failed', 'error');
                }
            } catch (e) {
                notify('Network error', 'error');
            }
        });

        // =============================================================
        // REFRESH
        // =============================================================
        btnRefresh.addEventListener('click', () => {
            const active = document.querySelector('.sidebar-nav a.active');
            if (active) navigateTo(active.dataset.page);
            else navigateTo('dashboard');
            notify('Refreshed ✅', 'success');
        });

        // =============================================================
        // UTILITY
        // =============================================================
        function escapeHtml(str) {
            if (!str) return '';
            const div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        function formatDate(ts) {
            if (!ts) return '—';
            const d = new Date(ts);
            return d.toLocaleDateString() + ' ' + d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }

        function debounce(fn, ms) {
            let timer;
            return (...args) => { clearTimeout(timer);
                timer = setTimeout(() => fn(...args), ms); };
        }

        // =============================================================
        // INIT
        // =============================================================
        // Load dashboard by default
        navigateTo('dashboard');

        // Also load students in background for dept filter
        setTimeout(() => loadStudents(), 300);

        // Close modals on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeFormModal();
                deleteModal.classList.remove('open');
            }
        });

        console.log('📘 StudentHub ready!');
    </script>

    <!-- ============================================================
    PHP BACKEND (embedded in same file)
    ============================================================ -->
    <?php
    // =============================================================
    // CONFIG & DATABASE
    // =============================================================
    error_reporting(E_ALL);
    ini_set('display_errors', 0); // set to 1 for debugging

    // SQLite database file
    define('DB_FILE', __DIR__ . '/students.db');

    // =============================================================
    // DATABASE INIT
    // =============================================================
    function getDB()
    {
        static $db = null;
        if ($db === null) {
            $exists = file_exists(DB_FILE);
            $db = new PDO('sqlite:' . DB_FILE);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            if (!$exists) {
                createTables($db);
                seedData($db);
            }
        }
        return $db;
    }

    function createTables($db)
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS students (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                first_name TEXT NOT NULL,
                last_name TEXT NOT NULL,
                gender TEXT NOT NULL,
                age INTEGER NOT NULL,
                department TEXT NOT NULL,
                email TEXT UNIQUE NOT NULL,
                phone TEXT,
                address TEXT,
                profile_picture TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );
            CREATE INDEX IF NOT EXISTS idx_students_email ON students(email);
            CREATE INDEX IF NOT EXISTS idx_students_dept ON students(department);
            CREATE INDEX IF NOT EXISTS idx_students_gender ON students(gender);
        ";
        $db->exec($sql);
    }

    function seedData($db)
    {
        $sample = [
            ['Alice', 'Johnson', 'Female', 22, 'Computer Science', 'alice.j@example.com', '+1-555-0101', '123 Maple St, Boston, MA'],
            ['Bob', 'Smith', 'Male', 24, 'Engineering', 'bob.s@example.com', '+1-555-0102', '456 Oak Ave, New York, NY'],
            ['Carol', 'Davis', 'Female', 21, 'Mathematics', 'carol.d@example.com', '+1-555-0103', '789 Pine Rd, Austin, TX'],
            ['David', 'Wilson', 'Male', 23, 'Physics', 'david.w@example.com', '+1-555-0104', '321 Elm St, Seattle, WA'],
            ['Eva', 'Martinez', 'Female', 20, 'Computer Science', 'eva.m@example.com', '+1-555-0105', '654 Cedar Ln, Chicago, IL'],
            ['Frank', 'Taylor', 'Male', 25, 'Engineering', 'frank.t@example.com', '+1-555-0106', '987 Birch Blvd, Denver, CO'],
            ['Grace', 'Lee', 'Female', 22, 'Biology', 'grace.l@example.com', '+1-555-0107', '147 Spruce Dr, Miami, FL'],
            ['Henry', 'Brown', 'Male', 26, 'Chemistry', 'henry.b@example.com', '+1-555-0108', '258 Willow Way, Phoenix, AZ'],
        ];
        $stmt = $db->prepare("
            INSERT INTO students (first_name, last_name, gender, age, department, email, phone, address)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        foreach ($sample as $row) {
            try {
                $stmt->execute($row);
            } catch (PDOException $e) {
                // skip duplicates
            }
        }
    }

    // =============================================================
    // ROUTER
    // =============================================================
    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? '';

    // For file uploads, we read raw input for JSON or FormData
    $input = [];
    if ($method === 'POST' && empty($_FILES)) {
        $raw = file_get_contents('php://input');
        if ($raw) {
            $input = json_decode($raw, true) ?? [];
        }
    }

    // Merge POST and JSON input
    $postData = array_merge($_POST, $input);

    // =============================================================
    // RESPONSE HELPER
    // =============================================================
    function respond($success, $data = null, $message = '')
    {
        header('Content-Type: application/json');
        echo json_encode(['success' => $success, 'data' => $data, 'message' => $message]);
        exit;
    }

    // =============================================================
    // HANDLE ACTIONS
    // =============================================================
    try {
        $db = getDB();

        // ---- GET: list students ----
        if ($action === 'list' && $method === 'GET') {
            $page = max(1, intval($_GET['page'] ?? 1));
            $perPage = max(1, intval($_GET['per_page'] ?? 10));
            $sort = preg_replace('/[^a-zA-Z_]/', '', $_GET['sort'] ?? 'first_name');
            $dir = strtoupper($_GET['dir'] ?? 'ASC');
            if (!in_array($dir, ['ASC', 'DESC'])) $dir = 'ASC';
            $search = trim($_GET['search'] ?? '');
            $gender = trim($_GET['gender'] ?? '');
            $dept = trim($_GET['dept'] ?? '');

            $where = [];
            $params = [];
            if ($search) {
                $where[] = "(first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR department LIKE ? OR id LIKE ?)";
                $like = '%' . $search . '%';
                $params = array_merge($params, [$like, $like, $like, $like, $like]);
            }
            if ($gender) {
                $where[] = "gender = ?";
                $params[] = $gender;
            }
            if ($dept) {
                $where[] = "department = ?";
                $params[] = $dept;
            }
            $whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

            // Count total
            $countSql = "SELECT COUNT(*) as total FROM students $whereSql";
            $stmt = $db->prepare($countSql);
            $stmt->execute($params);
            $total = $stmt->fetchColumn();

            // Fetch data
            $offset = ($page - 1) * $perPage;
            $sql = "SELECT * FROM students $whereSql ORDER BY $sort $dir LIMIT ? OFFSET ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array_merge($params, [$perPage, $offset]));
            $rows = $stmt->fetchAll();

            // Get departments for filter
            $deptStmt = $db->query("SELECT DISTINCT department FROM students ORDER BY department");
            $depts = $deptStmt->fetchAll(PDO::FETCH_COLUMN);

            respond(true, [
                'data' => $rows,
                'total' => (int) $total,
                'total_pages' => ceil($total / $perPage),
                'current_page' => $page,
                'per_page' => $perPage,
                'departments' => $depts,
            ]);
        }

        // ---- GET: stats ----
        if ($action === 'stats' && $method === 'GET') {
            $total = $db->query("SELECT COUNT(*) FROM students")->fetchColumn();
            $male = $db->query("SELECT COUNT(*) FROM students WHERE gender = 'Male'")->fetchColumn();
            $female = $db->query("SELECT COUNT(*) FROM students WHERE gender = 'Female'")->fetchColumn();
            $recent = $db->query("SELECT COUNT(*) FROM students WHERE created_at >= datetime('now', '-7 days')")->fetchColumn();
            respond(true, ['total' => (int) $total, 'male' => (int) $male, 'female' => (int) $female, 'recent' => (int) $recent]);
        }

        // ---- GET: recent ----
        if ($action === 'recent' && $method === 'GET') {
            $stmt = $db->query("SELECT * FROM students ORDER BY created_at DESC LIMIT 5");
            $rows = $stmt->fetchAll();
            respond(true, $rows);
        }

        // ---- GET: single student ----
        if ($action === 'get' && $method === 'GET') {
            $id = intval($_GET['id'] ?? 0);
            if (!$id) respond(false, null, 'Missing student ID');
            $stmt = $db->prepare("SELECT * FROM students WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            if (!$row) respond(false, null, 'Student not found');
            respond(true, $row);
        }

        // ---- POST: create student ----
        if ($action === 'create' && $method === 'POST') {
            $fn = trim($_POST['first_name'] ?? '');
            $ln = trim($_POST['last_name'] ?? '');
            $gender = trim($_POST['gender'] ?? '');
            $age = intval($_POST['age'] ?? 0);
            $dept = trim($_POST['department'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');

            if (!$fn || !$ln || !$gender || !$age || !$dept || !$email) {
                respond(false, null, 'All required fields must be filled.');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                respond(false, null, 'Invalid email format.');
            }
            if ($age < 1 || $age > 120) {
                respond(false, null, 'Age must be between 1 and 120.');
            }

            // Check duplicate email
            $check = $db->prepare("SELECT id FROM students WHERE email = ?");
            $check->execute([$email]);
            if ($check->fetch()) {
                respond(false, null, 'Email already exists. Please use a different email.');
            }

            // Handle file upload
            $picturePath = null;
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $picturePath = uploadPicture($_FILES['profile_picture']);
                if (!$picturePath) {
                    respond(false, null, 'Failed to upload profile picture.');
                }
            }

            $stmt = $db->prepare("
                INSERT INTO students (first_name, last_name, gender, age, department, email, phone, address, profile_picture)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$fn, $ln, $gender, $age, $dept, $email, $phone, $address, $picturePath]);
            respond(true, ['id' => $db->lastInsertId()], 'Student created successfully.');
        }

        // ---- POST: update student ----
        if ($action === 'update' && $method === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if (!$id) respond(false, null, 'Missing student ID');

            $fn = trim($_POST['first_name'] ?? '');
            $ln = trim($_POST['last_name'] ?? '');
            $gender = trim($_POST['gender'] ?? '');
            $age = intval($_POST['age'] ?? 0);
            $dept = trim($_POST['department'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');

            if (!$fn || !$ln || !$gender || !$age || !$dept || !$email) {
                respond(false, null, 'All required fields must be filled.');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                respond(false, null, 'Invalid email format.');
            }
            if ($age < 1 || $age > 120) {
                respond(false, null, 'Age must be between 1 and 120.');
            }

            // Check duplicate email (excluding current)
            $check = $db->prepare("SELECT id FROM students WHERE email = ? AND id != ?");
            $check->execute([$email, $id]);
            if ($check->fetch()) {
                respond(false, null, 'Email already exists. Please use a different email.');
            }

            // Handle file upload
            $picturePath = null;
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $picturePath = uploadPicture($_FILES['profile_picture']);
                if (!$picturePath) {
                    respond(false, null, 'Failed to upload profile picture.');
                }
            }

            // Build update query
            $fields = [];
            $params = [];
            $fields[] = "first_name = ?";
            $params[] = $fn;
            $fields[] = "last_name = ?";
            $params[] = $ln;
            $fields[] = "gender = ?";
            $params[] = $gender;
            $fields[] = "age = ?";
            $params[] = $age;
            $fields[] = "department = ?";
            $params[] = $dept;
            $fields[] = "email = ?";
            $params[] = $email;
            $fields[] = "phone = ?";
            $params[] = $phone;
            $fields[] = "address = ?";
            $params[] = $address;
            if ($picturePath) {
                $fields[] = "profile_picture = ?";
                $params[] = $picturePath;
            }
            $params[] = $id;

            $sql = "UPDATE students SET " . implode(', ', $fields) . " WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            respond(true, null, 'Student updated successfully.');
        }

        // ---- DELETE: delete student ----
        if ($action === 'delete' && $method === 'DELETE') {
            $id = intval($_GET['id'] ?? 0);
            if (!$id) respond(false, null, 'Missing student ID');
            $stmt = $db->prepare("DELETE FROM students WHERE id = ?");
            $stmt->execute([$id]);
            if ($stmt->rowCount()) {
                respond(true, null, 'Student deleted successfully.');
            } else {
                respond(false, null, 'Student not found.');
            }
        }

        // ---- fallback ----
        if ($action === '') {
            // Serve the HTML content (already rendered above)
            return;
        }

        respond(false, null, 'Invalid action or method.');

    } catch (PDOException $e) {
        respond(false, null, 'Database error: ' . $e->getMessage());
    } catch (Exception $e) {
        respond(false, null, 'Server error: ' . $e->getMessage());
    }

    // =============================================================
    // FILE UPLOAD HELPER
    // =============================================================
    function uploadPicture($file)
    {
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowed)) {
            return false;
        }
        $maxSize = 2 * 1024 * 1024; // 2MB
        if ($file['size'] > $maxSize) {
            return false;
        }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $name = 'profile_' . uniqid() . '.' . $ext;
        $dir = __DIR__ . '/uploads';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $dest = $dir . '/' . $name;
        if (move_uploaded_file($file['tmp_name'], $dest)) {
            return 'uploads/' . $name;
        }
        return false;
    }

    // Ensure uploads directory exists
    if (!is_dir(__DIR__ . '/uploads')) {
        mkdir(__DIR__ . '/uploads', 0755, true);
    }
    ?>
</body>
</html>