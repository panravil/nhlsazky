@inject('request', 'Illuminate\Http\Request')
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon img-responsive">
            <img class="img-fluid" src="{{ asset('images/logo.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME', 'NHLsazeni') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item  {{ $request->segment(2) == '' ? 'active' : '' }}">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ $request->segment(2) == 'uzivatele' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.uzivatele.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Uživatele</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mb-0">


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ $request->segment(2) == 'zapasy' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.zapasy.index') }}">
            <i class="fas fa-fw fa-hockey-puck"></i>
            <span>Zápasy</span>
        </a>
    </li>

    <hr class="sidebar-divider mb-0">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ $request->segment(2) == 'tikety' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.tikety.index') }}">
            <i class="fas fa-fw fa-clipboard-check"></i>
            <span>Tikety</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mb-0">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ $request->segment(2) == 'balicky' || $request->segment(2) == 'tarify' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.balicky.index') }}">
            <i class="fas fa-fw fa-archive"></i>
            <span>Balíčky</span>
        </a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ $request->segment(2) == 'transakce' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.transakce.index') }}">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Transakce</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mb-0">

    <li class="nav-item {{ $request->segment(2) == 'zpravy' || $request->segment(2) == 'emaily'  ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.soutez')}}">
            <i class="fas fa-fw fa-trophy"></i>
            <span>Soutež</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mb-0">

    <li class="nav-item {{ $request->segment(2) == 'zpravy' || $request->segment(2) == 'emaily'  ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.zpravy.index')}}">
            <i class="fas fa-fw fa-envelope-open-text"></i>
            <span>Zprávy</span>
        </a>
    </li>
    <hr class="sidebar-divider mb-0">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link {{ $request->segment(2) == 'texty'|| $request->segment(2) == 'faq'|| $request->segment(2) == 'blog'|| $request->segment(2) == 'udalosti' ? 'active' : 'collapsed' }}"
           href="#"
           data-toggle="collapse" data-target="#collapseText"
           aria-expanded="false"
           aria-controls="collapseText">
            <i class="fas fa-fw fa-pen-alt"></i>
            <span>Texty</span>
        </a>
        <div id="collapseText"
             class="collapse {{ $request->segment(2) == 'udalosti' || $request->segment(2) == 'texty'|| $request->segment(2) == 'faq'|| $request->segment(2) == 'recenze'|| $request->segment(2) == 'clanky' ? 'show' : '' }}"
             data-parent="#accordionSidebar" style="">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ $request->segment(2) == 'texty' ? 'active' : '' }}"
                   href="{{ route('admin.texty.index') }}">
                    <i class="fas fa-fw fa-envelope-open-text"></i>
                    <span>Texty</span>
                </a>
                <a class="collapse-item {{ $request->segment(2) == 'udalosti' ? 'active' : '' }}"
                   href="{{ route('admin.udalosti.index') }}">
                    <i class="fas fa-fw fa-calendar-day"></i>
                    <span>Události</span>
                </a>
                <a class="collapse-item {{ $request->segment(2) == 'recenze' ? 'active' : '' }}"
                   href="{{ route('admin.recenze.index') }}">
                    <i class="fas fa-fw fa-star-half-alt -open-text"></i>
                    <span>Recenze</span>
                </a>
                <a class="collapse-item {{ $request->segment(2) == 'faq' ? 'active' : '' }}"
                   href="{{ route('admin.faq.index') }}">
                    <i class="fas fa-fw fa-question"></i>
                    <span>FAQ</span>
                </a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider mb-0">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="false"
           aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Nástroje</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar" style="">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.redirects.index') }}">
                    <i class="fas fa-fw fa-directions"></i>
                    <span>Redirects</span>
                </a>
                <a class="collapse-item disabled">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Nastavení</span>
                </a>
                <a class="collapse-item" href="/admin/media">
                    <i class="fas fa-fw fa-images"></i>
                    <span>MediaManager</span>
                </a>
                <a class="collapse-item" href="{{ route('log-viewer::dashboard') }}" target="_blank">
                    <i class="fas fa-fw fa-bug"></i>
                    <span>LogViewer</span>
                </a>
            </div>
        </div>
    </li>


</ul>
<!-- End of Sidebar -->
