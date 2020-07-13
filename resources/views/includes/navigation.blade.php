  <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase km-nav" id="mainNav">
      <a class="navbar-brand js-scroll-trigger" href="{{ route('home') }}"><img class="logo-brand" src={{ asset('img/kampdas-logo1.png') }} /> </a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> Menü <i class="fas fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">

          <ul class="navbar-nav mr-auto">
              <li class="nav-item mx-0 mx-lg-1">
                  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                     href={{ route('home') }}>
                      <i class="fas fa-home"></i>
                        Anasayfa
                  </a>
              </li>


          </ul>
          <ul class="navbar-nav">
              @if (!Auth::guest())
                  <li class="nav-item dropdown mx-0 mx-lg-1">
{{--                      <a--}}
{{--                          class="--}}
{{--                      nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"--}}
{{--                          >                  </a>--}}
                          <a class="nav-link dropdown-toggle  py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                              <img class="km-circle-icon-img" src="{{ '/' . auth()->user()->photo ?? 'https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png'}}">
                              Profilim
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <a href="{{route('profile', auth()->user()->username)}}" class="dropdown-item">Kullanıcı Bilgilerim</a>
                              <a class="dropdown-item" href="{{ route('profile.events', auth()->user()->username) }}">Etkinliklerim</a>
                          </div>

                  </li>
                  <li id="notification_li" class="nav-item mx-0 mx-lg-1 mr-lg-3">

                      <a href="#" class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" id="notificationLink">
                          Bildirimler  <span id="notification_count">{{ $numOfNotifications ?? '' ? $numOfNotifications ?? '' : '0' }}</span>
                      </a>

                      <div id="notificationContainer">
                          <div id="notificationTitle">
                              Bildirimler
                              <a href="{{ route('notifications.read') }} ">{{ $numOfNotifications ?? '' ? 'Okundu olarak isaretle' : '' }}</a>
                          </div>
                          <div id="notificationsBody" class="notifications">
                              <ul>
                                  @if($notifications ?? '')
                                      @foreach($notifications ?? '' as $notification)
                                          <li  class="{{ $notification->read_at ? '' : 'unread-notification' }}">
                                              <a href="{{ $notification->read_at ? route('events.show', $notification->data['slug']) : route('notification.read', $notification->id) }}">
                                                  {{ $notification->data['message'] }}
                                              </a>
                                          </li>
                                      @endforeach
                                  @else
                                      <li>No notifications</li>
                                  @endif
                              </ul>
                          </div>
                      </div>

                  </li>
{{--                  <li class="nav-item mx-0 mx-lg-1">--}}
{{--                      <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href=""><i class="fas fa-bell"></i>--}}
{{--                          Bildirimler</a>--}}
{{--                  </li>--}}
                  <li class="nav-item mx-0 mx-lg-1">
                      <a
                          class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                          href={{ route('logout') }}>
                            Çıkış Yap
                      </a>
                  </li>
              @else
                  <li class="nav-item mx-0 mx-lg-1">
                      <a
                          class="{{ (request()->routeIs('login')) ? 'active' : '' }}
                              nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                          href={{route('login')}}>
                          Giriş Yap
                      </a>
                  </li>
                  <li class="nav-item mx-0 mx-lg-1">
                      <a
                          class="{{ (request()->routeIs('register-form')) ? 'active' : '' }}
                              nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                          href={{route('register-form')}}>
                          Kayıt Ol
                      </a>
                  </li>
              @endif


          </ul>
      </div>
      <div>
      </div>

  </nav>
