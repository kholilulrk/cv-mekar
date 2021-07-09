<div class="sidebar">
    <nav class="sidebar-nav">
        @if(Auth::user()->level == 0)
        <ul class="nav">
            <li class="nav-title">Menu Utama</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.service.index') }}">
                    <i class="nav-icon fa fa-puzzle-piece"></i> Service</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.whyus.index') }}">
                    <i class="nav-icon fa fa-puzzle-piece"></i> Why Us</a>
            </li>
            <li class="nav-title">Settings</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.setting.index') }}">
                    <i class="nav-icon icon-globe-alt"></i> About</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.slider.index') }}">
                    <i class="nav-icon icon-picture"></i> Slider</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.contact.index') }}">
                    <i class="nav-icon icon-phone"></i> Contact</a>
            </li>

            <li class="nav-title">Galleries</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.category_gallery.index') }}">
                    <i class="nav-icon icon-camera"></i> Category Image</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.gallery.index') }}">
                    <i class="nav-icon fa fa-file-image-o"></i> Image</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.gallery_video.index') }}">
                    <i class="nav-icon icon-camrecorder"></i> Video</a>
            </li> -->

            <li class="nav-title">Inboxes</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.inbox.index') }}">
                    <i class="nav-icon icon-envelope"></i> Inbox</a>
            </li>
        </ul>
        @endif

        @if(Auth::user()->level == 1)
            <ul class="nav">
                <li class="nav-title">Events</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.abstraction.index') }}">
                        <i class="nav-icon icon-settings"></i> Abstract</a>
                </li>
            </ul>
        @endif
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
