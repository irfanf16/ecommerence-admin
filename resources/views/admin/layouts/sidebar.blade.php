{{-- sidebar --}}
<div class="left_sidebar">
    <nav class="sidebar">

        <ul id="main-menu" class="metismenu">

            {{-- Dashboard --}}
            @can('admin-dashboard-read')
                <li class="{{ $navItem == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ URL::to('/admin/dashboard') }}">
                        <i class="fa-solid fa-chart-line"></i>
                        Dashboard
                    </a>
                </li>
            @endcan

            <li class="g_heading">Manage</li>

            {{-- Categories --}}
            @if (\App\Traits\userPermissionCheck::userPermissionCheck('admin-categories-read') ||
                \App\Traits\userPermissionCheck::userPermissionCheck('admin-subcategories-read') ||
                \App\Traits\userPermissionCheck::userPermissionCheck('admin-childcategories-read') ||
                \App\Traits\userPermissionCheck::userPermissionCheck('admin-brands-read') ||
                \App\Traits\userPermissionCheck::userPermissionCheck('admin-attributes-read') ||
                \App\Traits\userPermissionCheck::userPermissionCheck('admin-keys-read'))
                <li class="{{ $navItem == 'categories' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-layer-group"></i>Categories
                    </a>
                    <ul>
                        @can('admin-categories-read')
                            <li><a href="{{ URL::to('/admin/categories') }}"><small>Main Categories</small></a></li>
                        @endcan
                        @can('admin-subcategories-read')
                            <li><a href="{{ URL::to('/admin/subcategories') }}"><small>Sub Categories</small></a></li>
                        @endcan
                        @can('admin-childcategories-read')
                            <li><a href="{{ URL::to('/admin/childcategories') }}"><small>Child Categories</small></a>
                            </li>
                        @endcan
                        @can('admin-brands-read')
                            <li><a href="{{ URL::to('/admin/brands') }}"><small>Brands</small></a></li>
                        @endcan
                        @can('admin-attributes-read')
                            <li><a href="{{ URL::to('/admin/attributes') }}"><small>Attributes</small></a></li>
                        @endcan
                        @can('admin-keys-read')
                            <li><a href="{{ URL::to('/admin/keys') }}"><small>Keys</small></a></li>
                        @endcan
                        {{-- <li><a href="{{ URL::to('/admin/variants') }}"><small>Variants</small></a></li> --}}
                    </ul>
                </li>
            @endif
            {{-- Stores --}}
            @if (\App\Traits\userPermissionCheck::userPermissionCheck('admin-vendorstores-read') ||
                \App\Traits\userPermissionCheck::userPermissionCheck('admin-customerstores-read'))
                <li class="{{ $navItem == 'stores' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-shop"></i>Stores
                    </a>
                    <ul>
                        @can('admin-vendorstores-read')
                            <li><a href="{{ URL::to('/admin/stores/vendor') }}"><small>Vendor Stores</small></a></li>
                        @endcan
                        @can('admin-customerstores-read')
                            <li><a href="{{ URL::to('/admin/stores/customer') }}"><small>Customer Stores</small></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif
            {{-- Vendors --}}
            @can('admin-vendors-read')
                <li class="{{ $navItem == 'vendors' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-users"></i>Vednors
                    </a>
                    <ul>
                        <li><a href="{{ URL::to('/admin/vendor/profiles') }}"><small>All Vednors</small></a></li>
                        {{-- <li><a href="{{ URL::to('/admin/vendor/profiles/incomplete') }}"><small>Incomplete</small></a></li>
                        <li><a href="{{ URL::to('/admin/vendor/profiles/under-review') }}"><small>Under Review</small></a></li>
                        <li><a href="{{ URL::to('/admin/vendor/profiles/approved') }}"><small>Approved</small></a></li>
                        <li><a href="{{ URL::to('/admin/vendor/profiles/rejected') }}"><small>Rejected</small></a></li> --}}

                    </ul>
                </li>
            @endcan
            {{-- Customers --}}
            @can('admin-customers-read')
                <li class="{{ $navItem == 'customers' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-users"></i>Customers
                    </a>
                    <ul>
                        <li><a href="{{ URL::to('/admin/customer/profiles') }}"><small
                                    @if ($navItem == 'customers') style="font-weight: bold" @endif>Customers</small></a>
                        </li>
                        <li><a href="{{ URL::to('/admin/customer/wishlist') }}"><small
                                    @if ($navItem == 'customers') style="font-weight: bold" @endif>Wish List</small></a>
                        </li>
                        <li><a href="{{ URL::to('/admin/customer/cartItems') }}"><small
                                    @if ($navItem == 'customers') style="font-weight: bold" @endif>Cart
                                    Items</small></a>
                        </li>
                    </ul>
                </li>
            @endcan
            {{-- subscribers  --}}
            @can('admin-subscribers-read')
                <li class="{{ $navItem == 'subscribers' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-users"></i>Subscribers
                    </a>
                    <ul>
                        <li><a href="{{ URL::to('/admin/subscribers') }}"><small
                                    @if ($navItem == 'subscribers') style="font-weight: bold" @endif>Subscribers</small></a>
                        </li>
                    </ul>
                </li>
            @endcan

            {{-- contacts  --}}
            @can('admin-contacts-read')
                <li class="{{ $navItem == 'contacts' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-users"></i>Contacts
                    </a>
                    <ul>
                        <li><a href="{{ URL::to('/admin/contacts') }}"><small
                                    @if ($navItem == 'contacts') style="font-weight: bold" @endif>Contacts</small></a>
                        </li>
                    </ul>
                </li>
            @endcan
            {{-- Products --}}
            @can('admin-products-read')
                <li class="{{ $navItem == 'products' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-cart-shopping"></i>Products
                    </a>
                    <ul>
                        <li><a href="{{ URL::to('/admin/products') }}"><small>Products</small></a></li>
                        {{--                     <li><a href="{{ URL::to('/admin/variants') }}"><small>Variants</small></a></li> --}}
                        {{--                    <li><a href="{{ URL::to('/admin/massupload/product') }}">Bulk Upload</a></li> --}}
                    </ul>
                </li>
            @endcan
            {{-- Products Stock management --}}
            @can('admin-stockmanagement-read')
                <li class="{{ $navItem == 'stocks' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-cart-shopping"></i>Stock Management
                    </a>
                    <ul>
                        <li><a href="{{ URL::to('/admin/product/stocks/list') }}"><small>Product Stocks</small></a></li>
                        {{--                    <li><a href="{{ URL::to('/admin/products/stocks/history') }}"><small>Stock History</small></a></li> --}}
                    </ul>
                </li>
            @endcan

            {{-- Orders --}}
            @can('admin-orders-read')
                <li class="{{ $navItem == 'orders' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-arrows-down-to-line"></i>Orders
                    </a>
                    <ul>
                        <li><a href="{{ URL::to('/admin/orders') }}"><small>Orders</small></a></li>
                    </ul>
                </li>
            @endcan

            {{-- reviews --}}
            @can('admin-reviews-read')
                <li class="{{ $navItem == 'reviews' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-arrows-down-to-line"></i>Reviews
                    </a>
                    <ul>
                        <li><a href="{{ URL::to('/admin/reviews') }}"><small>All Reviews</small></a></li>
                    </ul>
                </li>
            @endcan

            {{-- questions --}}
            @can('admin-questions-read')
                <li class="{{ $navItem == 'questions' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-arrows-down-to-line"></i>Questions
                    </a>
                    <ul>
                        <li><a href="{{ URL::to('/admin/questions') }}"><small>All Questions</small></a></li>
                    </ul>
                </li>
            @endcan


            {{-- Locations --}}
            @can('admin-locations-read')
                <li class="{{ $navItem == 'locations' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-location-dot"></i>Locations
                    </a>
                    <ul>
                        <li>
                            <a href="{{ URL::to('/admin/cities') }}">
                                <i class="ti-comments"></i><small>Cities</small>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            {{-- Covers & Banners --}}
            @can('admin-covers-read')
                <li class="{{ $navItem == 'covers' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-images"></i> Covers & banners
                    </a>
                    <ul>
                        <li>
                            <a href="{{ URL::to('/admin/website/banners') }}">
                                <i class="ti-comments"></i><small>Website</small>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/admin/mobile/covers') }}">
                                <i class="ti-comments"></i><small>Mobile App</small>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            {{-- Partners --}}
            @can('admin-partners-read')
                <li class="{{ $navItem == 'partners' ? 'active' : '' }}">
                    <a href="{{ URL::to('/admin/partners') }}">
                        <i class="fa-solid fa-handshake-simple"></i>Partners
                    </a>
                </li>
            @endcan

            @can('admin-usermanagement-read')
                <li class="{{ $navItem == 'users' ? 'active' : '' }} ">
                    <a class="has-arrow">
                        <i class="fas fa-user-cog"></i>
                        <span>User Management</span>
                    </a>
                    <ul>
                        <li class="{{ request()->is('admin/users') ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/users') }}">
                                Manage Users </a>
                        </li>

                        <li class="{{ request()->is('admin/roles') ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/roles') }}">
                                Manage Roles </a>
                        </li>
                    </ul>
                </li>
            @endcan

            {{-- Settings --}}
            @if (\App\Traits\userPermissionCheck::userPermissionCheck('admin-sitesetting-read') ||
                \App\Traits\userPermissionCheck::userPermissionCheck('admin-appsetting-read') ||
                \App\Traits\userPermissionCheck::userPermissionCheck('admin-sociallinks-read') ||
                \App\Traits\userPermissionCheck::userPermissionCheck('admin-securitysetting-read'))
                <li class="{{ $navItem == 'settings' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-gear"></i>Settings
                    </a>
                    <ul>
                        @can('admin-sitesetting-read')
                            <li class="{{ $navItem == 'settings' ? 'active' : '' }}">
                                <a href="{{ route('siteSettings.index') }}">
                                    {{-- <i class="fa-solid fa-gears"></i> --}}
                                    <small>Site Settings</small>
                                </a>
                            </li>
                        @endcan
                        @can('admin-appsetting-read')
                            <li class="{{ $navItem == 'settings' ? 'active' : '' }}">
                                <a href="{{ route('app.setting') }}">
                                    {{-- <i class="fa-solid fa-link"></i> --}}
                                    <small>App Settings</small>
                                </a>
                            </li>
                        @endcan
                        @can('admin-securitysetting-read')
                            <li class="{{ $navItem == 'settings' ? 'active' : '' }}">
                                <a href="{{ route('adminProfile.password') }}">
                                    {{-- <i class="fa-solid fa-key"></i> --}}
                                    <small>Security Settings</small>
                                </a>
                            </li>
                        @endcan
                        @can('admin-sociallinks-read')
                            <li class="{{ $navItem == 'settings' ? 'active' : '' }}">
                                <a href="{{ route('admin.social') }}">
                                    {{-- <i class="fa-solid fa-link"></i> --}}
                                    <small>Social Links</small>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endif
            {{--            Commissions --}}
            @can('admin-commission-read')
                <li class="{{ $navItem == 'commissions' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow">
                        <i class="fa-solid fa-sack-dollar"></i>Commissions
                    </a>
                    <ul>
                        <li class="{{ $navItem == 'commissions' ? 'active' : '' }}">
                            <a href="{{ route('commissions') }}">
                                <i class="fa-solid fa-bars-staggered"></i><small>Commissions History</small>
                            </a>
                        </li>
                        <li class="{{ $navItem == 'commissions' ? 'active' : '' }}">
                            <a href="{{ route('commissions.applied') }}">
                                <i class="fa-regular fa-calendar-check"></i><small>Current commissions</small>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
</div>
