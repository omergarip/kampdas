  <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase km-nav" id="mainNav">
      <a class="navbar-brand js-scroll-trigger" href="{{ route('home') }}"><img class="logo-brand" src={{ asset('img/PNG.png') }} /> </a>
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
              <li class="nav-item mx-0 mx-lg-1 ">
                  <a
                      class="{{ (request()->routeIs('map')) ? 'active' : '' }}
                          nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                      href={{ route('map') }}>
                      <i class="fas fa-map-marked-alt"></i>
                        Kamp Haritası
                  </a>
              </li>


          </ul>
          <ul class="navbar-nav">
              @if (!Auth::guest())
                  <li class="nav-item mx-0 mx-lg-1">
                      <a
                          class="
                      nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                          href="/profil.html">
                          <img src="img/user-1.jpg" class="km-circle-icon-img">
                          Profilim
                      </a>
                  </li>
                  <li class="nav-item mx-0 mx-lg-1">
                      <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href=""><i class="fas fa-bell"></i>
                          Bildirimler</a>
                  </li>
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
                          class="{{ (request()->routeIs('register-form')) ? 'active' : '' }}
                              nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                          href={{route('login')}}>
                          Giriş Yap
                      </a>
                  </li>
                  <li class="nav-item mx-0 mx-lg-1">
                      <a
                          class="{{ (request()->routeIs('login')) ? 'active' : '' }}
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
