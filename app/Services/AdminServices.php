<?php

namespace App\Services;

use App\Contracts\AuthInterface;
use Illuminate\Http\RedirectResponse;

class AdminServices implements AuthInterface
{
    public function login($user): RedirectResponse
    {
        return redirect()
            ->intended('admin.dashboard')
            ->with('success', 'Anda Berhasil Login sebagai Administrator');
    }
}
