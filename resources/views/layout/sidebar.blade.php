<style>
.logo-wrapper {
    width: 85px; /* Ubah sesuai dengan ukuran yang diinginkan */
    height: auto; /* Biarkan tinggi otomatis untuk menjaga proporsi gambar */
}
</style>
<div class="sidebar-wrapper">
          <div>
            <div class="logo-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid for-light" src="{{ url('cuba') }}/assets/images/favicon.png" alt=""><img class="img-fluid for-dark" src="{{ url('cuba') }}/assets/images/favicon.png" alt=""></a>
              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
              <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
            </div>
            <div class="logo-icon-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid" src="{{ url('cuba') }}/assets/images/logo/logo-icon.png" alt=""></a></div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn"><a href="{{ route('dashboard') }}"><img class="img-fluid" src="{{ url('cuba') }}/assets/images/logo/logo-icon.png" alt=""></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6>Dashboard</h6>
                      <p>Reimbursement - Salsabila Emma</p>
                    </div>
                  </li>

                @if (Auth::user()->jabatan == 'DIREKTUR')
                {{-- -----------------------------------------------------------------------------------------------------------------< Direktur > --}}
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('karyawan') }}"><i data-feather="users"> </i><span>Karyawan</span></a></li>
                {{-- @elseif (Auth::user()->jabatan == 'STAFF') --}}
                {{-- -----------------------------------------------------------------------------------------------------------------< Staff > --}}
                @endif
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('pengajuan') }}"><i data-feather="list"> </i><span>Reimbursement</span></a></li>

                    <li> <a href="{{ route('logout') }}" class="sidebar-link sidebar-title link-nav"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="sign-out"
                            data-feather="log-out"></i>Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>
