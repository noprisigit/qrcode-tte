<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Tte;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $total_pegawai = Pegawai::count();
    $total_user = User::count();
    $total_tte = Tte::count();

    return view('admin.dashboard.dashboard-index', compact('total_pegawai', 'total_user', 'total_tte'));
  }
}
