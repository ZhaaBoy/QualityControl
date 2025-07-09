<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\HistoryPengaduan;
use App\Models\Regional\Province;
use App\Models\Regional\Regency;
use App\Models\Teradu;
use App\Models\TotalVermat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class IndexController extends Controller
{
    public function default()
    {
        return view('default', [
        ]);
    }

}