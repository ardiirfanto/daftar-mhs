<?php

namespace App\Contracts;

use Illuminate\Http\RedirectResponse;

interface AuthInterface
{
    public function login($user): RedirectResponse;
}
