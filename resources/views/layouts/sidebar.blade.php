<div id="sidebar-menu">
    @if (Auth::user()->role == 'admin')
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" key="t-menu"></li>

            <li>
                <a href="{{ route('dashboard') }}" class="waves-effect">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>           
            <hr>
            <li>
                <a href="{{ route('setting') }}" class="waves-effect">
                    <i class="fas fa-cogs"></i>
                    <span>Panel Settings</span>
                </a>
            </li>
        </ul>
    @endif
    
</div>
