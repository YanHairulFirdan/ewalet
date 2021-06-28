<?php

namespace App\Http\Controllers;

use App\Bulletin;
use App\Http\Requests\BulletinRequest;
use Illuminate\Http\Request;


class BulletinController extends Controller
{
    private $currentPage;

    public function index()
    {
        $bulletins = Bulletin::orderBy('created_at', 'DESC')->paginate(10);

        session(['cuurentPage' => $bulletins->currentPage()]);

        return view('bulletin.index', compact('bulletins'));
    }

    public function store(BulletinRequest $bulletinRequest)
    {
        $validated = $bulletinRequest->validated();

        Bulletin::create($validated);

        return redirect()->back();
    }
}
