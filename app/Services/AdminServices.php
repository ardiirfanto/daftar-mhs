<?php

namespace App\Services;

use App\Contracts\AuthInterface;
use Illuminate\Http\RedirectResponse;

/**
 * Class service untuk menangani proses autentikasi Administrator.
 * Implements AuthInterface.
 */
class AdminServices implements AuthInterface
{
    /**
     * Melakukan login user Administrator dan mengarahkan ke dashboard admin.
     *
     * @param mixed $user Instance user yang akan login.
     * @return RedirectResponse Redirect ke admin.dashboard dengan pesan sukses.
     */
    public function login($user): RedirectResponse
    {
        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Anda Berhasil Login sebagai Administrator');
    }
}
