<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP System</title>

    <!-- Include compiled CSS and JS from Vite -->
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])

    <!-- You can include additional meta tags or custom styles here -->
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('home') }}" class="brand-link">
                <span class="brand-text font-weight-light">ERP System</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jobs.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>Job Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tasks.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>Tasks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('inventory.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Inventory</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Reports</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('notifications.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-bell"></i>
                                <p>Notifications</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('settings.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Optional: Include JavaScript files -->
    @vite('resources/js/app.js')

</body>
</html>
