<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ url(auth()->user()->profile_photo_path) }}" class="img-circle img-profil" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ auth()->user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        @if (auth()->user()->level == 1)
        <li class="header">SYSTEM</li>
        <li>
          <a href="{{ route('User.index') }}">
            <i class="fa fa-user"></i> <span>Pengguna</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li>
          <a href="{{ route('setting.index') }}">
            <i class="fa fa-cog"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li>
          <a href="{{ route('userActivity.index') }}">
            <i class="fa fa-cog"></i> <span>Aktivitas Pengguna</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        @endif

        @if (auth()->user()->level == 2)
        <li class="header">MASTER</li>
        <li>
          <a href="{{ route('Categories.index') }}">
            <i class="fa fa-cube"></i> <span>Kategori</span>
            
          </a>
        </li>
        <li>
          <a href="{{ route('Products.index') }}">
            <i class="fa fa-cubes"></i> <span>Produk</span>
          </a>
        </li>
        <li class="header">RIWAYAT TRANSAKSI</li>
        <li>
          <a href="{{ route('sales.index')}}">
            <i class="fa fa-upload"></i> <span>Riwayat Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="header">REPORT</li>
        <li>
          <a href="{{ route('report.index')}}">
            <i class="fa fa-file-pdf-o"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="header">Pengguna</li>
        <li>
          <a href="{{ route('userActivity.index') }}">
            <i class="fa fa-cog"></i> <span>Aktivitas Pengguna</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        
        @endif

        @if (auth()->user()->level == 0)
        <li class="header">TRANSAKSI</li>
       
        <li>
          <a href="{{ route('Transaction.index') }}">
            <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Aktif</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li>
          <a href="{{ route('transaction.new') }}">
            <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Baru</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li>
          <a href="{{ route('sales.index')}}">
            <i class="fa fa-upload"></i> <span>Riwayat Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        @endif
        
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>