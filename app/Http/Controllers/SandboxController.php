<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SandboxController extends Controller
{
    public function htmlPreview(): View
    {
        return view('pages.sandbox');
    }
}
