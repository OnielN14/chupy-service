<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search " action="extra_search.html" method="POST">
                    <a href="javascript:;" class="remove">
                    <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="start open {{ Request::segment(1) === 'dashboard' ? 'active' : null }} ">
                <a href="{{ route('dashboard') }}">
                <i class="icon-home"></i>
                <span class="title">Dashboard</span>
                <span class="selected"></span>
                </a>
            </li>   
            <li class=" {{ Request::segment(1) === 'pengguna' ? 'active' : null }} ">
                <a href="{{ route('pengguna') }}">
                <i class="icon-user"></i>
                <span class="title">Pengguna</span>
                </a>
            </li>   
            <li>
                <a href="javascript:;">
                <i class="icon-pencil"></i>
                <span class="title">Konten</span>
                <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="ui_general.html">
                        Article</a>
                    </li>
                    <li>
                        <a href="ui_buttons.html">
                        Tips N Trick</a>
                    </li>
                    <li>
                        <a href="ui_confirmations.html">
                        News</a>
                    </li>
                    
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                <i class="icon-basket-loaded"></i>
                <span class="title">Petshop</span>
                <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="components_pickers.html">
                        Product</a>
                    </li>
                    <li>
                        <a href="components_context_menu.html">
                        Jenis Produk</a>
                    </li>
                    <li>
                        <a href="components_dropdowns.html">
                        Tag Produk</a>
                    </li>
                    
                </ul>
            </li>
            
            <li class="last {{ Request::segment(1) === 'map' ? 'active' : null }}">
                <a href="javascript:;">
                <i class="icon-pointer"></i>
                <span class="title">Maps</span>
                <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('map') }}">
                        Petshop Map</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->