<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientPasswordController extends Controller
{
    /**
     * Menampilkan form ganti password.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('dashboards.client.password.change');
    }

    /**
     * Proses update password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Ambil user yang sedang login
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Cek apakah password lama benar
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama tidak sesuai',
            ])->withInput();
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()
            ->route('client.password.change')
            ->with('success', 'Password berhasil diubah');
    }
}
