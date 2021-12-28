<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class AppController
{
    public function docs(): RedirectResponse
    {
        return redirect('/swagger/index.html');
    }
}
