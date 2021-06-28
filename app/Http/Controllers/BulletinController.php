<?php

namespace App\Http\Controllers;

use App\Bulletin;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    public function index()
    {
        $bulletins = Bulletin::orderBy('created_at', 'DESC')->paginate(10);

        return view('bulletin.index', compact('bulletins'));
    }
}
