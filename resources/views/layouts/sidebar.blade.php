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
                <a href="{{ route('deposits') }}" class="waves-effect">
                    <i class="fas fa-wallet"></i>
                    <span>Deposit Requests</span>
                </a>
            </li>
            <li>
                <a href="{{route('withdrawals')}}" class="waves-effect">
                    <i class="fas fa-arrow-up"></i>
                    <span>Withdrawal Requests</span>
                </a>
            </li>

            <li>
                <a href="{{ route('purchases') }}" class="waves-effect">
                    <i class="fas fa-arrow-up"></i>
                    <span>Purchase</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.users')}}" class="waves-effect">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
              <li>
                <a href="{{ route('admin.reward.list') }}" class="waves-effect">
                    <i class="fas fa-cogs"></i>
                    <span>Rewards</span>
                </a>
            </li>
            <li>
                <a href="{{ route('setting') }}" class="waves-effect">
                    <i class="fas fa-cogs"></i>
                    <span>Panel Settings</span>
                </a>
            </li>
        </ul>
    @endif

</div>
