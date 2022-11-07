<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Posts</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('posts.index') }}">
                        <i class="bi bi-circle"></i><span>View All Posts</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('posts.create') }}">
                        <i class="bi bi-circle"></i><span>Create a Post</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Permissions</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/dashboard/roles">
                        <i class="bi bi-circle"></i><span>Roles</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/roles/users">
                        <i class="bi bi-circle"></i><span>User Roles</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/roles/assign">
                        <i class="bi bi-circle"></i><span>Assign Role to Users</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/roles/create">
                        <i class="bi bi-circle"></i><span>Create Role</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->
    </ul>

</aside><!-- End Sidebar-->
