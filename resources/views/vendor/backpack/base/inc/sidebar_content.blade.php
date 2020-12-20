<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-title">Manajemen Ruangan</li>
{{-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('gedung') }}'><i class='nav-icon la la-building'></i> Gedung</a></li> --}}
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('ruangan') }}'><i class='nav-icon la la-hotel'></i> Ruangan</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('cleaninghistory') }}'><i class='nav-icon la la-clipboard'></i> Riwayat Pembersihan</a></li>
<li class='nav-item'><a class='nav-link' href='{{url("/admin/laporan")}}'><i class='nav-icon la la-clipboard'></i> Laporan</a></li>

<li class="nav-title">Manajemen Cleaning Service</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('responsibility') }}'><i class='nav-icon la la-certificate'></i> Pembagian Ruangan</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('cleaningservice') }}'><i class='nav-icon la la-users'></i> Cleaning Service</a></li>

<li class="nav-title">Manajemen Pengguna</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-user'></i> User</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('role') }}'><i class='nav-icon la la-id-badge'></i> Role</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('permission') }}'><i class='nav-icon la la-key'></i> Permission</a></li>
