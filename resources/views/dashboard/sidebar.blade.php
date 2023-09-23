<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <img class="img-profile rounded-circle" src="/img/Logo_IADC.png" width="50px" class="img">
        <div class="sidebar-brand-text mr-2"> IA Del Charity </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <li class="nav-item @yield('dashboard')">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-tachometer-alt"></i></i>
            <span> Dashboard </span>
        </a>
    </li>

    <!-- Divider -->
    @if (Auth::user()->role_id != 1)
    <li class="nav-item @yield('data_personal')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">            
            <i class="fas fa-user"></i>                    
            <span> Data Personal </span>
        </a>
        <div id="collapseOne" class="collapse @yield('data_diri')" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if(Auth::user()->role_id == 2)
                <a class="collapse-item @yield('data_diri_bph')" href="/profil_bph">        
                    <i class="fa-regular fa-id-card"></i> Data Diri
                </a>
                @elseif(Auth::user()->role_id == 3)
                <a class="collapse-item @yield('data_diri_donator')" href="/profil_donator">        
                    <i class="fa-regular fa-id-card"></i> Data Diri
                </a>
                @elseif(Auth::user()->role_id == 4)
                <a class="collapse-item @yield('data_diri_awardee')" href="/profil_awardee">        
                    <i class="fa-regular fa-id-card"></i> Data Diri
                </a>
                @endif
            </div>
        </div>
    </li>
    @else
    @endif

    @if (Auth::user()->role_id != 4)
    <li class="nav-item @yield('daftar_anggota')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">            
            <i class="fas fa-users"></i>                    
            <span> Daftar Anggota </span>
        </a>
        <div id="collapseTwo" class="collapse @yield('anggota')" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @yield('anggota_awardee')" href="/anggota_awardee">        
                    <i class="fas fa-users"></i> Anggota Awardee 
                </a>
                @if (Auth::user()->role_id != 3)
                <a class="collapse-item @yield('anggota_bph')" href="/anggota_bph">        
                    <i class="fas fa-users"></i> Anggota BPH 
                </a>
                <a class="collapse-item @yield('anggota_donator')" href="/anggota_donator">        
                    <i class="fas fa-users"></i> Anggota Donator 
                </a>
                @endif
            </div>
        </div>
    </li>
    @else
    @endif

    <li class="nav-item @yield('pemasukan_dana')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">            
            <i class="fas fa-wallet"></i>                    
            <span> Pemasukan Dana </span>
        </a>
        <div id="collapseThree" class="collapse @yield('pemasukan')" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <a class="collapse-item @yield('jenis_pemasukan')" href="/jenis_pemasukan">        
                    <i class="fa-solid fa-clipboard-list"></i> Jenis Pemasukan
                </a>
                <a class="collapse-item @yield('daftar_pemasukan')" href="/daftar_pemasukan">        
                    <i class="fa-solid fa-money-check-dollar"></i></i> Daftar Pemasukan
                </a>
                <a class="collapse-item @yield('informasi_donasi')" href="/informasi_donasi">        
                    <i class="fa-solid fa-hand-holding-dollar"></i> Informasi Donasi 
                </a>
                @endif
                <a class="collapse-item @yield('laporan_pemasukan')" href="/laporan_pemasukan">        
                    <i class="fa-solid fa-chart-line"></i> Laporan Pemasukan
                </a>
                <a class="collapse-item @yield('rekapitulasi_pemasukan')" href="/rekapitulasi_pemasukan">        
                    <i class="fa-solid fa-money-check"></i> Rekap Pemasukan
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item @yield('pengeluaran_dana')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">            
            <i class="fa-solid fa-credit-card"></i>                    
            <span> Pengeluaran Dana </span>
        </a>
        <div id="collapseFour" class="collapse @yield('pengeluaran')" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <a class="collapse-item @yield('jenis_pengeluaran')" href="jenis_pengeluaran">        
                    <i class="fa-solid fa-receipt"></i> Jenis Pengeluaran
                </a>
                <a class="collapse-item @yield('daftar_pengeluaran')" href="/daftar_pengeluaran">        
                    <i class="fa-solid fa-money-bill-wave"></i> Daftar Pengeluaran
                </a>
                @endif
                @if (Auth::user()->role_id != 4)
                <a class="collapse-item @yield('informasi_beasiswa')" href="/informasi_beasiswa">        
                    <i class="fa-solid fa-handshake-angle"></i> Informasi Beasiswa 
                </a>
                @endif
                <a class="collapse-item @yield('laporan_pengeluaran')" href="/laporan_pengeluaran">        
                    <i class="fa-solid fa-chart-simple"></i> Laporan Pengeluaran
                </a>
                <a class="collapse-item @yield('rekapitulasi_pengeluaran')" href="/rekapitulasi_pengeluaran">        
                    <i class="fa-solid fa-file-invoice"></i> Rekap Pengeluaran
                </a>
            </div>
        </div>
    </li>

    @if (Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
    <li class="nav-item @yield('catatan_kontribusi')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">            
            <i class="fa-solid fa-note-sticky"></i>                    
            <span> Catatan Kontribusi </span>
        </a>
        <div id="collapseFive" class="collapse @yield('catatan')" aria-labelledby="headingFive" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if (Auth::user()->role_id == 3)
                <a class="collapse-item @yield('catatan_donasi')" href="/catatan_donasi">        
                    <i class="fa-solid fa-rectangle-list"></i> Catatan Donasi
                </a>
                @else
                <a class="collapse-item @yield('catatan_beasiswa')" href="/catatan_beasiswa">        
                    <i class="fa-solid fa-rectangle-list"></i> Catatan Beasiswa
                </a>
                @endif
            </div>
        </div>
    </li>
    @endif

    @if (Auth::user()->role_id != 3)
    <li class="nav-item @yield('arsip_dokumen')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">            
            <i class="fa-solid fa-book"></i>                    
            <span> Arsip Dokumen </span>
        </a>
        <div id="collapseSix" class="collapse @yield('dokumen')" aria-labelledby="headingSix" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @yield('dokumen_awardee')" href="/dokumen_awardee">        
                    <i class="fa-solid fa-file"></i> Dokumen Awardee
                </a>
            </div>
        </div>
    </li>
    @endif

    <li class="nav-item @yield('layanan_administratif')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">            
            <i class="fa-solid fa-bullhorn"></i>                    
            <span> Zona Publikasi</span>
        </a>
        <div id="collapseSeven" class="collapse @yield('layanan')" aria-labelledby="headingSeven" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <a class="collapse-item @yield('daftar_ajuan_beasiswa')" href="/daftar_ajuan_beasiswa">        
                    <i class="fa-solid fa-table-cells-large"></i> Daftar Ajuan Beasiswa
                </a>
                <a class="collapse-item @yield('daftar_bukti_donasi')" href="/daftar_bukti_donasi">        
                    <i class="fa-solid fa-building"></i> Daftar Bukti Donasi
                </a>
                <a class="collapse-item @yield('unggahan_berkas')" href="/daftar_file_beasiswa">        
                    <i class="fa-solid fa-book-open"></i> Unggahan Berkas
                </a>
                @elseif (Auth::user()->role_id == 3)
                <a class="collapse-item @yield('bukti_donasi')" href="/bukti_donasi">        
                    <i class="fa-solid fa-square-plus"></i> Bukti Donasi
                </a>
                @elseif (Auth::user()->role_id == 4)
                <a class="collapse-item @yield('ajuan_beasiswa')" href="/ajuan_beasiswa">        
                    <i class="fa-solid fa-circle-dollar-to-slot"></i> Ajuan Beasiswa
                </a>
                <a class="collapse-item @yield('unggah_berkas')" href="/file_beasiswa">        
                    <i class="fa-solid fa-file-arrow-up"></i> Unggah Berkas
                </a>
                @endif
            </div>
        </div>
    </li>

    @if (Auth::user()->role_id == 1)
    <li class="nav-item @yield('pengguna_dan_peran')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">            
            <i class="fas fa-users"></i>                    
            <span> Pengguna dan Peran </span>
        </a>
        <div id="collapseEight" class="collapse @yield('pengguna')" aria-labelledby="headingEight" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @yield('tambah_pengguna')" href="/tambah_pengguna">        
                    <i class="fa-solid fa-user-plus"></i> Tambah Pengguna
                </a>
                <a class="collapse-item @yield('daftar_peran_awardee')" href="/daftar_peran_awardee">        
                    <i class="fa-solid fa-user-group"></i> Daftar Peran Awardee
                </a>
                <a class="collapse-item @yield('daftar_peran_bph')" href="/daftar_peran_bph">        
                    <i class="fa-solid fa-user-group"></i> Daftar Peran BPH
                </a>
                <a class="collapse-item @yield('daftar_peran_donator')" href="/daftar_peran_donator">        
                    <i class="fa-solid fa-user-group"></i> Daftar Peran Donator
                </a>
            </div>
        </div>
    </li>
    @endif

    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
    <li class="nav-item @yield('dokumentasi')">
        <a class="nav-link" href="/album_dokumentasi">
            <i class="fa-solid fa-images"></i>
            <span> Album Dokumentasi </span>
        </a>
    </li>
    @endif
</ul>