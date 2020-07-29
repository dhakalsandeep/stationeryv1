<div class="sidebar">
    <nav class="sidebar-nav ps ps--active-y">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle">
                        <i class="fas fa-users nav-icon">
                        </i>
                        {{ trans('global.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fas fa-unlock-alt nav-icon"></i>
                                {{ trans('global.permission.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fas fa-briefcase nav-icon"></i>
                                {{ trans('global.role.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fas fa-user nav-icon"></i>
                                {{ trans('global.user.title') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('purchase_access')
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle">
                    <i class="fa fa-get-pocket nav-icon"></i>
                    Purchase
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ route('purchase.index') }}" class="nav-link">
                            <i class="fa fa-shopping-cart nav-icon"></i>
                            Receive
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('purchase.return.index') }}" class="nav-link">
                            <i class="fa fa-undo nav-icon"></i>
                            Return
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('publisher_access')
            <li class="nav-item">
                <a href="{{ route('publisher.index') }}" class="nav-link">
                    <i class="fa fa-newspaper-o nav-icon"></i>
                    Publishers
                </a>
            </li>
            @endcan

            @can('supplier_access')
            <li class="nav-item">
                <a href="{{ route('supplier.index') }}" class="nav-link">
                    <i class="fa fa-industry nav-icon"></i>
                    Suppliers
                </a>
            </li>
            @endcan

            @can('item_access')
            <li class="nav-item">
                <a href="{{ route('item.index') }}" class="nav-link">
                    <i class="fa fa-book nav-icon"></i>
                    Items
                </a>
            </li>
            @endcan

            @can('items_management_access')
            <li class="nav-item">
                <a href="{{ route('stock.index') }}" class="nav-link">
                    <i class="fa fa-info-circle nav-icon"></i>
                    Items Management
                </a>
            </li>
            @endcan

            @can('issue_item_access')
            <li class="nav-item">
                <a href="{{ route('issue.index') }}" class="nav-link">
                    <i class="fa fa-paper-plane nav-icon"></i>
                    Issue Items
                </a>
            </li>
            @endcan
            @can('reports_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle">
                        <i class="fa fa-bar-chart nav-icon"></i>
                        Reports
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("purchase.detail.report.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa fa-download nav-icon"></i>
                                Purchase Detail
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("stock.aging.report.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa fa-download nav-icon"></i>
                                Stock Aging
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("supplier.wise.purchase.report.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa fa-download nav-icon"></i>
                                Supplier Wise Purchase Detail
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("current.stock.report.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa fa-search nav-icon"></i>
                                Current Stock
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 869px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 415px;"></div>
        </div>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>


