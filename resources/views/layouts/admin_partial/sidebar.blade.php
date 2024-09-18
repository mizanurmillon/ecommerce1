<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel pb-3 mb-3 d-flex">
        <div class="image">
          @if(Auth::user()->avatar==NULL)
          <img src="{{ asset('public/backend') }}/dist/img/default-150x150.png" class="img-circle elevation-2" alt="User Image">
          @else
          <img src="{{ asset('public/files/admin/profile/'.Auth::user()->avatar) }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="{{ route('admin.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
          <p class="text-white" style="font-size: 10px; padding: 0; margin: 0;">{{ Auth::user()->type }}</p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('admin.home') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ Route('category') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('subcategory') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subcategory</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('childcategory') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Childcategory</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('brand') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brand</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('color') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Color</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('warehouse') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ware House</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pickuppoint') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pickup Point</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ Route('create.product') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('product') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('digital.product') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Digital Products</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Blogs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ Route('blog.category') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blog Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('blog.post') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Posts</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Offers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ Route('coupon') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Coupon</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('campaing') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E-Campaing</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                WebSite Setup
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ Route('website.setting') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>WebSite Sytem Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ Route('banner') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Banners</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ Route('footer') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Footer</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ Route('page') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pages</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Setup & Configurations
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ Route('seo.setting') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEO</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ Route('smtp') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SMTP</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ Route('tax') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vat & TAX</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('language') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Languages</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('currency') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Currency</p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Shipping
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ Route('shipping') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Shipping Configuration</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('shipping.country') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Shipping Countries</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('shipping.state') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Shipping States</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('shipping.city') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Shipping Cities</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>