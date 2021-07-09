<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
    <a class="navbar-brand icon" href="#">
        <img class="navbar-brand-full icon rounded" src="{{ asset($setting->showlogo()) }}" width="89" height="25" alt="CoreUI Logo">
      </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
    <ul class="nav navbar-nav d-md-down-none">

    </ul>
    <ul class="nav navbar-nav ml-auto mr-4">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="img-avatar" src="{{url('admin/static/admin/img/avatars/6.jpg')}}" alt="admin@bootstrapmaster.com">
          </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('admin.password.index') }}">
                    <i class="fa fa-lock"></i>Ganti Password
                </a>
                @if(Auth::user()->level == 0)
                    <a class="dropdown-item" href="{{ route('admin.user.index') }}">
                        <i class="fa fa-plus"></i>Tambah Akun
                    </a>
                @endif
                <a class="dropdown-item" href="{{route('admin.auth.logout')}}">
                    <i class="fa fa-sign-out"></i>Keluar Sistem
                </a>
            </div>
        </li>
    </ul>
</header>
