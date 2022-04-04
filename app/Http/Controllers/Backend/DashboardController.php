<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pemeriksaans = Pemeriksaan::orderBy('created_at', 'desc')->get();

        return view('backend.dashboard.index', [
            'pemeriksaans' => $pemeriksaans
        ]);
    }
}
