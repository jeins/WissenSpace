@if (Auth::guard('admin')->check())
    <nav class="menu">
        <p class="menu-label">
            General
        </p>
        <ul class="menu-list">
            <li><a class="is-active" href="#"><span class="icon is-small"><i
                                class="fa fa-tachometer"></i></span> Dashboard</a></li>
        </ul>
        <p class="menu-label">
            Administration
        </p>
        <ul class="menu-list">
            <li><a href=""><span class="icon is-small"><i
                                class="fa fa-users"></i></span> Users</a></li>
            <li><a href=""><span class="icon is-small"><i
                                class="fa fa-desktop"></i></span> Products</a></li>
            <li><a href=""><span class="icon is-small"><i
                                class="fa fa-archive"></i></span> Backups</a></li>
        </ul>
    </nav>
@endif
