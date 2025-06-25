<div class="br-logo">
    <a href="{{ route('vendor.dashboard') }}">
        <span>[</span>Vendor<i>Panel</i><span>]</span>
    </a>
</div>

<div class="br-sideleft sideleft-scrollbar" style="width: 180px; height:min-content"> {{-- Reduce width --}}
    <label class="sidebar-label pd-x-10 mg-t-15 op-6 text-uppercase small">Menu</label>
    <ul class="br-sideleft-menu">

        {{-- Dashboard --}}
        <li class="br-menu-item">
            <a href="{{ route('vendor.dashboard') }}"
               class="br-menu-link {{ Request::routeIs('vendor.dashboard') ? 'active' : '' }}">
                <i class="menu-item-icon icon ion-ios-home-outline tx-18"></i>
                <span class="menu-item-label">Dashboard</span>
            </a>
        </li>

        {{-- Products --}}
        <li class="br-menu-item">
            <a href="#"
               class="br-menu-link {{ Request::routeIs('vendor.products') ? 'active' : '' }}">
                <i class="menu-item-icon icon ion-pricetag tx-18"></i>
                <span class="menu-item-label">Products</span>
            </a>
        </li>

        {{-- Orders --}}
        <li class="br-menu-item">
            <a href="#"
               class="br-menu-link {{ Request::routeIs('#') ? 'active' : '' }}">
                <i class="menu-item-icon icon ion-ios-cart-outline tx-18"></i>
                <span class="menu-item-label">Orders</span>
            </a>
        </li>

        {{-- Create Product --}}
        <li class="br-menu-item">
            <a href="#"
               class="br-menu-link {{ Request::routeIs('#') ? 'active' : '' }}">
                <i class="menu-item-icon icon ion-plus-round tx-18"></i>
                <span class="menu-item-label">Create</span>
            </a>
        </li>
    </ul>
    <br>
</div>
