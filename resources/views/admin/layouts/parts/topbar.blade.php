   @inject('request', 'Illuminate\Http\Request')
      <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggle" class="btn btn-link d-none d-md-inline rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <ul class="navbar-nav">
            <li class="nav-item pt-3 d-none d-md-inline">
                @include('admin.layouts.parts.breadcrumb')
            </li>
          </ul>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

@php
                  $count_matches = \App\Match::where([['winner', '<', 1]])->where([['start', '<', \Carbon\Carbon::now()->addHours(1)]])->orderBy('start', 'desc')->get()->count();
                  @endphp
@if($count_matches > 0)

           <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-hockey-puck fa-fw"></i>

                <!-- Counter - Alerts -->

                  @if($count_matches > 0)
                <span class="badge badge-danger badge-counter">{{$count_matches }}</span>
                      @endif
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in shadow" aria-labelledby="alertsDropdown">
                  <a href="{{ route('admin.tikety.index') }}" class="text-light">
                  <h6 class="dropdown-header">Nevyhodnocené zápasy</h6>
                </a>
            @foreach(\App\Match::where([['winner', '<', 1]])->where([['start', '<', \Carbon\Carbon::now()->addHours(1)]])->orderBy('start', 'desc')->get()->take(10) as $match)
                              @include('admin.matches.parts.matchMin', $template = $match)
            @endforeach
              </div>
            </li>
@endif
@php
                  $count_tips = \App\Ticket::where([['status', '<', 1]])->where([['match_start', '<', \Carbon\Carbon::now()->addHours(1)]])->orderBy('match_start', 'desc')->get()->count();
                  @endphp
@if($count_tips > 0)

           <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>

                <!-- Counter - Alerts -->

                  @if($count_tips > 0)
                <span class="badge badge-danger badge-counter">{{$count_tips }}</span>
                      @endif
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in shadow" aria-labelledby="alertsDropdown">
                  <a href="{{ route('admin.tikety.index') }}" class="text-light">
                  <h6 class="dropdown-header">Nevyhodnocené Tipy</h6>
                </a>
            @foreach(\App\Ticket::where([['status', '<', 1]])->where([['match_start', '<', \Carbon\Carbon::now()->addHours(1)]])->orderBy('match_start', 'desc')->get()->take(10) as $ticket)
                              <a class="dropdown-item d-flex pt-2 pb-2 pl-2 pr-2 align-items-center justify-content-between" href="{{ route('admin.tikety.show', $ticket->id) }}">
                  <div>
                    <div class="icon-circle {{ $ticket->package->color }}">
                      <i class="fas fa-archive text-white"></i>
                    </div>
                  </div>
                  <div class="w-100 pr-2 pl-2">
                    <div class="small text-gray-800">{{ $ticket->start }}</div>
                      <div class="font-weight-bold">{{  $ticket->match_title }}</div>
                    <div>{{  $ticket->tip.' '.'('.$ticket->odds.')'}} </div>

                  </div>
                                                        <div class="mr-0">
                      <form action="{{ route('admin.tikety.update', $ticket->id)}}" method="post">
                  @csrf
                  @method('PATCH')
                              <input type="hidden" name="action" value="win">
                  <button class="btn btn-sm btn-great" type="submit"><i class="fas fa-check text-white fa-fw"></i></button>
                </form>
                                                            <form action="{{ route('admin.tikety.update', $ticket->id)}}" method="post">
                  @csrf
                  @method('PATCH')
                              <input type="hidden" name="action" value="lose">
                  <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-times text-white fa-fw"></i></button>
                </form>
                  </div>

                </a>
            @endforeach
              </div>
            </li>
@endif
                  @php
                  $count_zpravy = \App\Message::where([['read', '!=', 1]])->orderBy('created_at', 'desc')->get()->count();
                  @endphp
@if($count_zpravy > 0)
            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Alerts -->
                  @if($count_zpravy > 0)
                <span class="badge badge-danger badge-counter">{{$count_zpravy }}</span>
                      @endif
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in shadow" aria-labelledby="alertsDropdown">
                <a href="{{ route('admin.zpravy.index') }}" class="text-light">
                  <h6 class="dropdown-header">Zprávy</h6>
                </a>
            @foreach(\App\Message::where([['read', '!=', 1]])->orderBy('created_at', 'desc')->get()->take(10) as $zprava)
                @include('admin.messages.parts.listItemMessage', $zprava)
            @endforeach
              </div>
            </li>
 @endif
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 text-gray-600 small"><i class=" fas fa-user fa-fw text-gray-400"></i><span class="d-none d-lg-inline"> {{ \Illuminate\Support\Facades\Auth::user()->name }}</span></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('admin.uzivatele.show', \Illuminate\Support\Facades\Auth::user()->id) }}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Odhlásit
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
