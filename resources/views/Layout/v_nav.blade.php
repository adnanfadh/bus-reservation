<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="/" class="nav-link {{ request()->is('/') ? 'active' : ''}}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      @role('Administrator')
      <li class="nav-item">
        <a href="/users" class="nav-link {{ request()->is('users') ? 'active' : ''}}">
          <i class="far fa-circle nav-icon"></i>
          <p>Users</p>
        </a>
      </li>
      @endrole
      @if (auth()->user()->akses=='Karyawan')
      @hasanyrole('Administrator|Admin Office|Admin Pool')
      <li class="nav-item {{ request()->is('users_profile','tujuan','role','tipe_kend','item_opr','kostumer','karyawan','mitra','crew') ? 'menu-open' : ''}}" >
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-book"></i>
          <p>
            Master Data
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview {{ request()->is('users_profile','tujuan','role','tipe_kend','item_opr','kostumer','karyawan','mitra','crew') ? 'style="display:block;"' : ''}}">
          <li class="nav-item">
            @role('Administrator')
            <a href="/users_profile" class="nav-link {{ request()->is('users_profile') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Users Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/role" class="nav-link {{ request()->is('role') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Role</p>
            </a>
          </li>
          @endrole
          @hasanyrole('Administrator|Admin Office')
          <li class="nav-item">
            <a href="/karyawan" class="nav-link {{ request()->is('karyawan') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Karyawan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/mitra" class="nav-link {{ request()->is('mitra') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Mitra</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/kostumer" class="nav-link {{ request()->is('kostumer') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Kostumer</p>
            </a>
          </li>
          @endhasanyrole
          <li class="nav-item">
            <a href="/tujuan" class="nav-link {{ request()->is('tujuan') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Tujuan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/tipe_kend" class="nav-link {{ request()->is('tipe_kend') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Tipe Kendaraan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/item_opr" class="nav-link {{ request()->is('item_opr') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Item Operasional</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/crew" class="nav-link {{ request()->is('crew') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Crew Pool</p>
            </a>
          </li>
        </ul>
      </li>
      @endhasanyrole
      @hasanyrole('Administrator|Admin Office|Admin Keuangan|Marekting')
      <li class="nav-item">
        <a href="/booking" class="nav-link {{ request()->is('booking') ? 'active' : ''}}">
          <i class="nav-icon fas fa-calendar-check"></i>
          <p>
            Booking
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/harga_tujuan" class="nav-link {{ request()->is('harga_tujuan') ? 'active' : ''}}">
          <i class="nav-icon fas fa-money-bill"></i>
          <p>
            Harga
          </p>
        </a>
      </li>
      @endhasanyrole
      @hasanyrole('Administrator|Admin Office|Admin Pool')
      <li class="nav-item">
        <a href="/penjadwalan" class="nav-link {{ request()->is('penjadwalan') ? 'active' : ''}}">
          <i class="nav-icon fas fa-calendar-alt"></i>
          <p>
            Penjadwalan
          </p>
        </a>
      </li>
      @hasanyrole('Admin Keuangan|Administrator|Admin Office|Admin Pool')
      <li class="nav-item">
        <a href="/pengajuan_dana" class="nav-link {{ request()->is('pengajuan_dana') ? 'active' : ''}}">
          <i class="nav-icon fas fa-money-check"></i>
          <p>
            Pengajuan Dana
          </p>
        </a>
      </li>
      @endhasanyrole
      <li class="nav-item">
        <a href="/operasional" class="nav-link {{ request()->is('operasional') ? 'active' : ''}}">
          <i class="nav-icon fas fa-tools"></i>
          <p>
            Operasional
          </p>
        </a>
      </li>
      @endhasanyrole
      <li class="nav-item">
        <a href="/unit_kend" class="nav-link {{ request()->is('unit_kend') ? 'active' : ''}}">
          <i class="nav-icon fas fa-bus"></i>
          <p>
            Unit Kendaraan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/event" class="nav-link {{ request()->is('calendar') ? 'active' : ''}}">
          <i class="nav-icon far fa-calendar-alt"></i>
          <p>
            Calendar
          </p>
        </a>
      </li>
      <!-- ADMIN OFFICE-->
      @elseif(auth()->user()->level==2)
      <li class="nav-item {{ request()->is('users','tujuan','level_akses','tipe_kend','item_opr','kostumer') ? 'menu-open' : ''}}" >
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-book"></i>
          <p>
            Master Data
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview {{ request()->is('users','tujuan','level_akses','tipe_kend','item_opr','kostumer') ? 'style="display:block;"' : ''}}">
          <li class="nav-item">
            <a href="/kostumer" class="nav-link {{ request()->is('kostumer') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Kostumer</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/tujuan" class="nav-link {{ request()->is('tujuan') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Tujuan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/tipe_kend" class="nav-link {{ request()->is('tipe_kend') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Tipe Kendaraan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/item_opr" class="nav-link {{ request()->is('item_opr') ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Item Operasional</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="/booking" class="nav-link {{ request()->is('booking') ? 'active' : ''}}">
          <i class="nav-icon fas fa-circle-alt"></i>
          <p>
            Booking
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/paket" class="nav-link {{ request()->is('paket') ? 'active' : ''}}">
          <i class="nav-icon fas fa-circle-alt"></i>
          <p>
            Paket
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/penjadwalan" class="nav-link {{ request()->is('penjadwalan') ? 'active' : ''}}">
          <i class="nav-icon fas fa-calendar-alt"></i>
          <p>
            Penjadwalan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/pengajuan_dana" class="nav-link {{ request()->is('pengajuan_dana') ? 'active' : ''}}">
          <i class="nav-icon fas fa-money-check"></i>
          <p>
            Pengajuan Dana
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/unit_kend" class="nav-link {{ request()->is('unit_kendaraan') ? 'active' : ''}}">
          <i class="nav-icon fas fa-bus"></i>
          <p>
            Unit Kendaraan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/event" class="nav-link {{ request()->is('calendar') ? 'active' : ''}}">
          <i class="nav-icon far fa-calendar-alt"></i>
          <p>
            Calendar
          </p>
        </a>
      </li>
      @else
      <li class="nav-item" >
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-book"></i>
          <p>
            Pages
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>None</p>
            </a>
          </li>
        </ul>
      </li>

      @endif

      <li class="nav-item">
        <a href="/about" class="nav-link {{ request()->is('about') ? 'active' : ''}}">
          <i class="far fa-circle nav-icon"></i>
          <p>About</p>
        </a>
      </li>
    </ul>
  </nav>
