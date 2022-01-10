<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{ route('admin.dashboard.index')}}"
                        class="{{ (request()->is('admin/dashboard')) ? 'active' : '' }}"><i class="lnr lnr-home"></i>
                        <span>Dashboard</span></a></li>
                <li>
                    <a href="#subPages1" data-toggle="collapse"
                        class="{{ (request()->is('admin/*categories')) ? 'active' : 'collapsed' }}"><i
                            class="lnr lnr-code"></i> <span>Categories</span> <i
                            class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages1" class="{{ (request()->is('admin/*categories')) ? 'collapse in' : 'collapse' }}">
                        <ul class="nav">
                            <li><a href="{{ route('admin.categories.index')}}"
                                    class="{{ (request()->is('admin/categories')) ? 'active' : '' }}">Category</a></li>
                            <li><a href="{{ route('admin.subcategories.index')}}"
                                    class="{{ (request()->is('admin/subcategories')) ? 'active' : '' }}">Subcategory</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li><a href="{{ route('admin.attributes.index')}}"
                        class="{{ (request()->is('admin/attributes*')) ? 'active' : '' }}"><i
                            class="lnr lnr-tag"></i>
                        <span>Attribute</span></a></li>
                <li><a href="{{ route('admin.products.index')}}"
                        class="{{ (request()->is('admin/products*')) ? 'active' : '' }}"><i class="lnr lnr-shirt"></i>
                        <span>Product</span></a></li>
                <li><a href="{{ route('admin.sliders.index')}}"
                        class="{{ (request()->is('admin/sliders*')) ? 'active' : '' }}"><i class="lnr lnr-screen"></i>
                        <span>Slider</span></a>
                </li>

                <li><a href="{{ route('admin.blogs.index')}}"
                        class="{{ (request()->is('admin/blogs*')) ? 'active' : '' }}"><i class="lnr lnr-bullhorn"></i>
                        <span>Blog</span></a></li>
                <li><a href="typography.html" class=""><i class="lnr lnr-text-format"></i> <span>Typography</span></a>
                </li>
                <li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li>
            </ul>
        </nav>
    </div>
</div>