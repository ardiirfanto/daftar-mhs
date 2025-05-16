<?php

namespace App\Contracts;

use Illuminate\Http\RedirectResponse;

/**
 * Interface untuk otentikasi pengguna.
 * Mendefinisikan kontrak metode login yang harus diimplementasikan.
 *
 * @package App\Contracts
 */
interface AuthInterface
{
    /**
     * Melakukan proses login untuk pengguna.
     *
     * @param mixed $user Data pengguna yang akan login
     * @return RedirectResponse Redirect ke halaman setelah login
     */
    public function login($user): RedirectResponse;
}
