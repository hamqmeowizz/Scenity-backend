<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenity Control Panel | Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #fcfbf9; /* Warm, ultra-light luxury canvas background */
            color: #1a1a1a;
            display: flex;
            min-height: 100vh;
        }

        /* Fixed Left Sidebar - Sleek Luxury Dark Mode Theme */
        aside {
            width: 260px;
            background: #111111; /* True dark charcoal pitch */
            color: #a3a3a3;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            border-right: 1px solid #222;
        }
        .sidebar-brand {
            padding: 28px 24px;
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 2px;
            border-bottom: 1px solid #222;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .sidebar-brand span {
            font-size: 0.65rem;
            background: #c5a880; /* Premium Brand Muted Gold Accent */
            color: #111;
            padding: 2px 6px;
            border-radius: 2px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .sidebar-menu {
            padding: 24px 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex: 1;
        }
        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 24px;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: none;
            border: none;
            color: #888;
            text-align: left;
            width: 100%;
        }
        .menu-item:hover {
            color: #fff;
            background: #1a1a1a;
        }
        .menu-item.active {
            background: #1a1a1a;
            color: #c5a880; /* Gold text highlight for active section */
            font-weight: 600;
            border-left: 3px solid #c5a880;
            padding-left: 21px; /* Offset spacing for the border indicator */
        }
        
        .sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid #222;
        }
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            background: transparent;
            border: 1px solid #333;
            color: #888;
            padding: 12px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            cursor: pointer;
            border-radius: 2px;
            transition: all 0.2s ease;
        }
        .btn-logout:hover {
            background: #fdf2f0;
            color: #aa2b1d;
            border-color: #fca5a5;
        }

        /* Main Workspace Engine Layout Frame */
        .main-content {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* Minimalist Clean Top Navbar Header */
        header {
            background: #fff;
            height: 75px;
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eae6e1;
        }
        .breadcrumb {
            font-size: 0.8rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
        }
        .breadcrumb span { color: #111; font-weight: 600; }
        .user-meta-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            color: #444;
        }
        .status-dot {
            width: 6px;
            height: 6px;
            background: #c5a880; /* Signature Brand Gold */
            border-radius: 50%;
        }

        .workspace-container {
            padding: 40px;
        }

        /* Sophisticated Metric Analytics Matrix Row Cards */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }
        .metric-card {
            background: #fff;
            padding: 24px;
            border-radius: 4px;
            border: 1px solid #eae6e1;
            box-shadow: 0 2px 4px rgba(0,0,0,0.01);
        }
        .metric-card-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .metric-card-value {
            font-size: 1.6rem;
            font-weight: 400;
            letter-spacing: -0.5px;
            color: #111;
        }
        .notice {
            padding: 14px 18px;
            border-radius: 4px;
            margin-bottom: 24px;
            font-size: 0.85rem;
            border: 1px solid transparent;
        }
        .notice-success {
            background: #edf7ef;
            color: #245b31;
            border-color: rgba(36, 91, 49, 0.12);
        }
        .notice-error {
            background: #fdf2f0;
            color: #aa2b1d;
            border-color: rgba(170, 43, 29, 0.12);
        }

        /* View Panels Routing Visibility Framework Switcher */
        .panel-container {
            display: none;
            flex-direction: column;
            gap: 35px;
        }
        .panel-container.active {
            display: flex;
        }

        /* Premium Aesthetic Panel Containers */
        .table-card {
            background: #fff;
            border-radius: 4px;
            border: 1px solid #eae6e1;
            padding: 30px;
            width: 100%;
        }
        .card-heading {
            font-size: 1rem;
            font-weight: 600;
            color: #111;
            letter-spacing: 0.5px;
            margin-bottom: 24px;
            padding-bottom: 14px;
            border-bottom: 1px solid #f5f2ee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Luxury Global Call To Action Button Style */
        .btn-global-cta {
            background: #111;
            color: #fff;
            border: 1px solid #111;
            padding: 10px 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-global-cta:hover {
            background: #c5a880;
            border-color: #c5a880;
            color: #111;
        }

        /* Responsive Form Rows Multi-Column Grid Architectures */
        .form-grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #555;
        }
        input, select, textarea {
            padding: 11px 14px;
            font-size: 0.85rem;
            border: 1px solid #dcd8d2;
            border-radius: 2px;
            background: #fff;
            color: #1a1a1a;
            font-family: inherit;
            width: 100%;
            transition: all 0.2s ease-in-out;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #c5a880;
            box-shadow: 0 0 0 3px rgba(197, 168, 128, 0.12);
        }
        
        .form-actions-wrapper {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #f5f2ee;
        }
        
        .action-submit-btn {
            background: #111;
            color: #fff;
            border: 1px solid #111;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 12px 28px;
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.85rem;
            height: 42px;
        }
        .action-submit-btn:hover {
            background: #c5a880;
            border-color: #c5a880;
            color: #111;
        }
        .action-cancel-btn {
            background: #fff;
            color: #555;
            border: 1px solid #dcd8d2;
            font-weight: 500;
            padding: 12px 24px;
            border-radius: 2px;
            cursor: pointer;
            font-size: 0.85rem;
            height: 42px;
            transition: all 0.2s;
        }
        .action-cancel-btn:hover { background: #fcfbf9; color: #111; border-color: #111; }

        /* Fine-Line Editorial Studio Data Tables */
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.85rem;
        }
        th {
            background: #fcfbf9;
            color: #666;
            font-weight: 600;
            padding: 16px;
            border-bottom: 1px solid #eae6e1;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        td {
            padding: 16px;
            border-bottom: 1px solid #f5f2ee;
            color: #333;
            vertical-align: middle;
        }
        tr:hover td { background: #faf9f6; }
        
        .table-thumb {
            width: 44px;
            height: 44px;
            object-fit: cover;
            border-radius: 2px;
            border: 1px solid #eae6e1;
        }
        .data-txt-bold { font-weight: 600; color: #111; font-size: 0.9rem; }
        .data-txt-sub { font-size: 0.775rem; color: #777; margin-top: 3px; font-weight: 400; }
        
        .pill {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            background: #f5f2ee;
            color: #555;
            padding: 4px 10px;
            border-radius: 2px;
            white-space: nowrap;
        }
        .pill-status-active { background: #eef7f2; color: #1e6b43; }
        
        /* Modern Minimal Icon Button Layouts */
        .action-icon-group {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }
        .btn-icon-action {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: 1px solid #eae6e1;
            border-radius: 2px;
            cursor: pointer;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }
        .btn-icon-action.edit-type { color: #444; }
        .btn-icon-action.edit-type:hover { background: #111; border-color: #111; color: #fff; }
        .btn-icon-action.delete-type { color: #999; }
        .btn-icon-action.delete-type:hover { background: #fdf2f0; color: #aa2b1d; border-color: #fca5a5; }

        /* Premium Dashboard Pagination styles */
        .pagination-wrap {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
            padding-top: 20px;
            border-top: 1px solid #f5f2ee;
        }
        .page-link, .page-current, .page-disabled {
            min-width: 38px;
            height: 38px;
            padding: 0 14px;
            border-radius: 2px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid #eae6e1;
            background: #fff;
            color: #555;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .page-link:hover {
            border-color: #111;
            color: #111;
            background: #fcfbf9;
        }
        .page-current {
            background: #111;
            color: #fff;
            border-color: #111;
        }
        .page-disabled {
            color: #ccc;
            background: #faf9f6;
            cursor: not-allowed;
            border-color: #eae6e1;
        }

        /* ==========================================================================
           PREMIUM MODAL MODIFIER WINDOW STYLES
           ========================================================================== */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(17, 17, 17, 0.4);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }
        .modal-wrapper {
            background: #fff;
            width: 100%;
            max-width: 680px;
            border-radius: 4px;
            border: 1px solid #eae6e1;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            padding: 35px;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
            position: relative;
        }
        .modal-overlay.active .modal-wrapper {
            transform: translateY(0);
        }
        .modal-close-trigger {
            position: absolute;
            top: 30px;
            right: 35px;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #888;
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s;
        }
        .modal-close-trigger:hover {
            color: #111;
        }
        .duplicate-modal-wrapper {
            max-width: 520px;
        }
        .duplicate-icon {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: #fdf2f0;
            color: #aa2b1d;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 18px;
        }
        .duplicate-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #111;
            margin-bottom: 10px;
            letter-spacing: 0.2px;
        }
        .duplicate-copy {
            color: #555;
            line-height: 1.7;
            font-size: 0.9rem;
            margin-bottom: 18px;
        }
        .duplicate-details {
            background: #fcfbf9;
            border: 1px solid #eae6e1;
            border-radius: 4px;
            padding: 14px 16px;
            margin-bottom: 24px;
        }
        .duplicate-details span {
            display: block;
            color: #777;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }
        .duplicate-details strong {
            display: block;
            color: #111;
            font-size: 0.95rem;
            margin-bottom: 10px;
        }
        .duplicate-details strong:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>

    <aside>
        <div class="sidebar-brand">
            SCENITY <span>CMS</span>
        </div>
        
        <div class="sidebar-menu">
            <button class="menu-item active" id="tabNavDataset" onclick="routeDashboard('dataset')">
                <span class="icon">&#128196;</span> Manage Perfume Dataset
            </button>
            <button class="menu-item" id="tabNavUsers" onclick="routeDashboard('users')">
                <span class="icon">&#128101;</span> View Registered Users
            </button>
        </div>

        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Are you sure you want to log out of the Scenity Administrative Dashboard?')">
                @csrf
                <button type="submit" class="btn-logout">
                    <span class="icon">&#128682;</span> Log Out Session
                </button>
            </form>
        </div>
    </aside>

    <div class="main-content">
        
        <header>
            <div class="breadcrumb">Console Root / Dashboard / <span id="currentRouteTitle">Dataset Matrix</span></div>
            <div class="user-meta-badge">
                <div class="status-dot"></div>
                <span>Admin Session Engine</span>
            </div>
        </header>

        <div class="workspace-container">
            @if(session('success'))
                <div class="notice notice-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="notice notice-error">{{ $errors->first() }}</div>
            @endif
            
            <section class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-card-title">Perfume in Dataset</div>
                    <div class="metric-card-value" id="perfCounter">{{ $perfumes->total() }}</div>
                </div>
                <div class="metric-card">
                    <div class="metric-card-title">Total Registered Accounts</div>
                    <div class="metric-card-value" id="userCounter">{{ $totalUsers }}</div>
                </div>
                <div class="metric-card">
                    <div class="metric-card-title">Platform Integrity</div>
                    <div class="metric-card-value" style="color: #c5a880; font-weight: 500;">SECURE</div>
                </div>
                <div class="metric-card">
                    <div class="metric-card-title">System Execution Latency</div>
                    <div class="metric-card-value">12 ms</div>
                </div>
            </section>

            <div id="panelDataset" class="panel-container active">
                
                <div class="table-card">
                    <div class="card-heading">
                        <span>Dataset Inventory Registry Directory</span>
                        <button class="btn-global-cta" onclick="openAddModal()">
                            <i class="fa-solid fa-plus"></i> Add New Fragrance
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="datatablePerfumes">
                            <thead>
                                <tr>
                                    <th>Asset</th>
                                    <th>Product Identity Specification</th>
                                    <th>Olfactory Tag</th>
                                    <th>Longevity</th>
                                    <th>Sillage Information</th>
                                    <th>Fragrance Notes Breakdown</th>
                                    <th style="text-align: right;">System Command Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($perfumes as $perfume)
                                    <tr
                                        data-update-url="{{ route('admin.perfumes.update', $perfume) }}"
                                        data-weather="{{ $perfume->weather_suitability }}"
                                        data-image="{{ $perfume->image_url ?? '' }}"
                                        data-longevity="{{ $perfume->longevity }}"
                                        data-sillage="{{ $perfume->sillage }}"
                                        data-top-notes="{{ $perfume->top_notes }}"
                                        data-middle-notes="{{ $perfume->middle_notes }}"
                                        data-base-notes="{{ $perfume->base_notes }}"
                                    >
                                        <td><img src="{{ $perfume->image_url ?? asset('images/default-perfume.jpg') }}" class="table-thumb" alt="{{ $perfume->name }} thumbnail"></td>
                                        <td>
                                            <div class="data-txt-bold">{{ $perfume->name }}</div>
                                            <div class="data-txt-sub">{{ $perfume->brand }}</div>
                                        </td>
                                        <td><span class="pill">{{ $perfume->scent_family }}</span></td>
                                        <td><span class="pill">{{ ucfirst($perfume->longevity) }}</span></td>
                                        <td><span class="pill">{{ ucfirst($perfume->sillage) }}</span></td>
                                        <td>
                                            <div class="data-txt-sub">
                                                Top: {{ $perfume->top_notes }} | Mid: {{ $perfume->middle_notes }} | Base: {{ $perfume->base_notes }}
                                            </div>
                                        </td>
                                        <td style="text-align: right;">
                                            <div class="action-icon-group">
                                                <button class="btn-icon-action edit-type" title="View / Edit Entry" onclick="openEditModal(this)">
                                                    <i class="fa-solid fa-file-pen"></i>
                                                </button>
                                                <form action="{{ route('admin.perfumes.destroy', $perfume) }}" method="POST" onsubmit="return confirm('Confirm fragrance deletion for {{ addslashes($perfume->name) }}? This will permanently remove it from the database.')" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-icon-action delete-type" title="Delete Entry">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="data-txt-sub">No perfume records found in the database.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($perfumes->hasPages())
                        <nav class="pagination-wrap" aria-label="Dataset inventory pagination">
                            @if($perfumes->onFirstPage())
                                <span class="page-disabled">Previous</span>
                            @else
                                <a class="page-link" href="{{ $perfumes->previousPageUrl() }}">Previous</a>
                            @endif

                            @foreach($perfumes->getUrlRange(1, $perfumes->lastPage()) as $page => $url)
                                @if($page === $perfumes->currentPage())
                                    <span class="page-current">{{ $page }}</span>
                                @else
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if($perfumes->hasMorePages())
                                <a class="page-link" href="{{ $perfumes->nextPageUrl() }}">Next</a>
                            @else
                                <span class="page-disabled">Next</span>
                            @endif
                        </nav>
                    @endif
                </div>

            </div>

            <div id="panelUsers" class="panel-container">
                <div class="table-card">
                    <div class="card-heading">Platform Active User Directory</div>
                    <div class="table-responsive">
                        <table id="datatableUsers">
                            <thead>
                                <tr>
                                    <th>Account Identification UID</th>
                                    <th>Registered Client Profile</th>
                                    <th>Account Status</th>
                                    <th style="text-align: right;">Administrative Control</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($registeredUsers as $user)
                                    <tr>
                                        <td class="data-txt-bold" style="color: #666;">USR-{{ str_pad($user->user_id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            <div class="data-txt-bold">{{ $user->name }}</div>
                                            <div class="data-txt-sub">{{ $user->email }}</div>
                                        </td>
                                        <td><span class="pill pill-status-active">Active Member</span></td>
                                        <td style="text-align: right;">
                                            <div class="action-icon-group">
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Confirm account deletion for {{ addslashes($user->name) }}? This will permanently remove the user from the database.')" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-icon-action delete-type" title="Remove User Account">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="data-txt-sub">No registered user accounts found.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal-overlay" id="editPerfumeModal">
        <div class="modal-wrapper">
            <button class="modal-close-trigger" onclick="closeEditModal()">Ã—</button>
            <div class="card-heading" id="modalHeadingTitle" style="margin-bottom: 30px;">Create New Fragrance Entry Registry</div>
            
            <form id="editPerfumeForm" action="{{ route('admin.perfumes.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethodOverride" value="POST">
                <div class="form-grid-2">
                    <div class="field-group">
                        <label for="brand">brand</label>
                        <input type="text" id="brand" name="brand" required>
                    </div>
                    <div class="field-group">
                        <label for="name">name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="field-group">
                        <label for="scent_family">scent_family</label>
                        <select id="scent_family" name="scent_family" required>
                            <option value="Woody">Woody</option>
                            <option value="Floral">Floral</option>
                            <option value="Fresh">Fresh</option>
                            <option value="Oriental">Oriental</option>
                            <option value="Spicy">Spicy</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label for="weather_suitability">weather_suitability</label>
                        <select id="weather_suitability" name="weather_suitability" required>
                            <option value="Crisp & Sunny">Crisp & Sunny</option>
                            <option value="Cold / Overcast">Cold / Overcast</option>
                            <option value="Hot / Humid">Hot / Humid</option>
                            <option value="Balmy Evening">Balmy Evening</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="field-group">
                        <label for="longevity">longevity</label>
                        <select id="longevity" name="longevity" required>
                            <option value="weak">weak</option>
                            <option value="moderate">moderate</option>
                            <option value="strong">strong</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label for="sillage">sillage</label>
                        <select id="sillage" name="sillage" required>
                            <option value="soft">soft</option>
                            <option value="moderate">moderate</option>
                            <option value="heavy">heavy</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="field-group">
                        <label for="top_notes">top_notes</label>
                        <input type="text" id="top_notes" name="top_notes" required>
                    </div>
                    <div class="field-group">
                        <label for="middle_notes">middle_notes</label>
                        <input type="text" id="middle_notes" name="middle_notes" required>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="field-group">
                        <label for="base_notes">base_notes</label>
                        <input type="text" id="base_notes" name="base_notes" required>
                    </div>
                    <div class="field-group">
                        <label for="image_url">image_url</label>
                        <input type="url" id="image_url" name="image_url">
                    </div>
                </div>

                <div class="form-actions-wrapper">
                    <button type="button" class="action-cancel-btn" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="action-submit-btn" id="modalSubmitBtn">Save Entry</button>
                </div>
            </form>
        </div>
    </div>

    @if(session('duplicate_perfume'))
        <div class="modal-overlay active" id="duplicatePerfumeModal">
            <div class="modal-wrapper duplicate-modal-wrapper">
                <button class="modal-close-trigger" onclick="closeDuplicateModal()">×</button>
                <div class="duplicate-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                <div class="duplicate-title">Fragrance Already Exists</div>
                <p class="duplicate-copy">
                    This fragrance is already in the database, so a new duplicate entry was not created.
                </p>
                <div class="duplicate-details">
                    <span>Existing fragrance</span>
                    <strong>{{ session('duplicate_perfume.name') }}</strong>
                    <span>Brand</span>
                    <strong>{{ session('duplicate_perfume.brand') }}</strong>
                    <span>Scent family</span>
                    <strong>{{ session('duplicate_perfume.scent_family') }}</strong>
                </div>
                <div class="form-actions-wrapper">
                    <button type="button" class="action-cancel-btn" onclick="closeDuplicateModal()">Close</button>
                    <button type="button" class="action-submit-btn" onclick="closeDuplicateModal(); openAddModal(true);">Review Entry</button>
                </div>
            </div>
        </div>
    @endif

    <script>
        let globalCurrentPerfumeRow = null;

        function routeDashboard(routeTargetId) {
            document.querySelectorAll(".menu-item").forEach(item => item.classList.remove("active"));
            document.querySelectorAll(".panel-container").forEach(panel => panel.classList.remove("active"));

            const routeDatasetElement = document.getElementById("panelDataset");
            const routeUsersElement = document.getElementById("panelUsers");
            const navDatasetBtn = document.getElementById("tabNavDataset");
            const navUsersBtn = document.getElementById("tabNavUsers");
            const titleDisplay = document.getElementById("currentRouteTitle");

            if(routeTargetId === 'dataset') {
                navDatasetBtn.classList.add("active");
                routeDatasetElement.classList.add("active");
                routeDatasetElement.style.display = 'flex';
                routeUsersElement.style.display = 'none';
                titleDisplay.innerText = "Dataset Matrix Control Panel";
            } else {
                navUsersBtn.classList.add("active");
                routeUsersElement.classList.add("active");
                routeUsersElement.style.display = 'flex';
                routeDatasetElement.style.display = 'none';
                titleDisplay.innerText = "Active User Directory Audit Log Grid";
            }
        }

        function calculateOperationalStats() {
            const rowPerfCount = document.querySelectorAll("#datatablePerfumes tbody tr").length;
            const rowUserCount = document.querySelectorAll("#datatableUsers tbody tr").length;

            document.getElementById("perfCounter").innerText = rowPerfCount;
            document.getElementById("userCounter").innerText = rowUserCount;
        }

        // ==========================================================================
        // CONTROL CONTROLLER FOR UNIFIED CREATION / MODIFICATION MODALS
        // ==========================================================================
        const submittedDuplicateData = @json(session('duplicate_perfume') ? old() : []);

        function fillPerfumeForm(values) {
            Object.entries(values).forEach(([field, value]) => {
                const input = document.getElementById(field);
                if (input && value !== null) {
                    input.value = value;
                }
            });
        }

        function openAddModal(keepSubmittedValues = false) {
            globalCurrentPerfumeRow = null;
            const form = document.getElementById("editPerfumeForm");
            form.reset();
            form.action = "{{ route('admin.perfumes.store') }}";
            document.getElementById("formMethodOverride").value = "POST";

            if (keepSubmittedValues) {
                fillPerfumeForm(submittedDuplicateData);
            }
            
            document.getElementById("modalHeadingTitle").innerText = "Create New Fragrance Entry Registry";
            
            const submitBtn = document.getElementById("modalSubmitBtn");
            submitBtn.innerText = "Save Product Entry";
            submitBtn.style.background = "#111";
            submitBtn.style.borderColor = "#111";
            submitBtn.style.color = "#fff";

            document.getElementById("editPerfumeModal").classList.add("active");
        }

        function openEditModal(buttonRef) {
            const targetRow = buttonRef.closest("tr");
            globalCurrentPerfumeRow = targetRow;

            const perfumeName = targetRow.querySelector("td:nth-child(2) .data-txt-bold").innerText;
            const perfumeBrand = targetRow.querySelector("td:nth-child(2) .data-txt-sub").innerText;
            const scentFamily = targetRow.querySelector("td:nth-child(3) .pill").innerText;
            const longevity = targetRow.getAttribute("data-longevity");
            const sillage = targetRow.getAttribute("data-sillage");
            const topNotes = targetRow.getAttribute("data-top-notes");
            const middleNotes = targetRow.getAttribute("data-middle-notes");
            const baseNotes = targetRow.getAttribute("data-base-notes");
            const weatherProfile = targetRow.getAttribute("data-weather");
            const assetImgUrl = targetRow.getAttribute("data-image");

            const form = document.getElementById("editPerfumeForm");
            form.action = targetRow.getAttribute("data-update-url");
            document.getElementById("formMethodOverride").value = "PUT";

            document.getElementById("brand").value = perfumeBrand;
            document.getElementById("name").value = perfumeName;
            document.getElementById("scent_family").value = scentFamily;
            document.getElementById("weather_suitability").value = weatherProfile;
            document.getElementById("longevity").value = longevity;
            document.getElementById("sillage").value = sillage;
            document.getElementById("top_notes").value = topNotes;
            document.getElementById("middle_notes").value = middleNotes;
            document.getElementById("base_notes").value = baseNotes;
            document.getElementById("image_url").value = assetImgUrl;

            document.getElementById("modalHeadingTitle").innerText = "Modify / Update Existing Dataset Entry Log";
            
            const submitBtn = document.getElementById("modalSubmitBtn");
            submitBtn.innerText = "Save Updates";
            submitBtn.style.background = "#c5a880";
            submitBtn.style.borderColor = "#c5a880";
            submitBtn.style.color = "#111";

            document.getElementById("editPerfumeModal").classList.add("active");
        }

        function closeEditModal() {
            document.getElementById("editPerfumeModal").classList.remove("active");
            document.getElementById("editPerfumeForm").reset();
            document.getElementById("editPerfumeForm").action = "{{ route('admin.perfumes.store') }}";
            document.getElementById("formMethodOverride").value = "POST";
            globalCurrentPerfumeRow = null;
        }

        function closeDuplicateModal() {
            const duplicateModal = document.getElementById("duplicatePerfumeModal");
            if (duplicateModal) {
                duplicateModal.classList.remove("active");
            }
        }

        // Close modal if user clicks outside of the modal window frame context
        window.onclick = function(event) {
            const editOverlay = document.getElementById("editPerfumeModal");
            const duplicateOverlay = document.getElementById("duplicatePerfumeModal");

            if (event.target == editOverlay) {
                closeEditModal();
            }

            if (duplicateOverlay && event.target == duplicateOverlay) {
                closeDuplicateModal();
            }
        }

    </script>
</body>
</html>


