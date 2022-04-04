<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('created_at', 'desc')->get();

        return view('backend.user.index', [
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $data = User::findOrFail($id);

        $data->assignRole('Admin');

        return redirect()->back();
    }

    public function petugas_lab($id)
    {
        $data = User::findOrFail($id);

        $data->assignRole('Petugas Lab');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);

        $data->delete();

        return redirect()->back();
    }
}
