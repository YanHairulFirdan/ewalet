<?php

namespace App\Http\Controllers;

use App\Bulletin;
use App\Http\Requests\BulletinRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function postPassword(Request $request, Bulletin $bulletin)
    {
        $error     = '';
        $errorType = '';

        if (!$bulletin->password) {
            return redirect(route('bulletin.show', ['bulletin' => $bulletin->id]))
                ->with(['error' => "This message can't delete, because this message has no been set password", 'type' => 'empty_password']);
        }

        if (strlen($request->password) !== 4) {
            return redirect(route('bulletin.show', ['bulletin' => $bulletin->id]))
                ->with(['error' => 'Your password must be 4 digit', 'type' => '']);
        }

        if ($request->password !== $bulletin->password) {
            return redirect(route('bulletin.show', ['bulletin' => $bulletin->id]))
                ->with(['error' => 'The password you entered does not match. Please try again', 'type' => 'wrong_password']);
        }

        return redirect(route('bulletin.show', ['bulletin' => $bulletin->id]))
            ->with(['type' => 'confirm']);
    }

    public function show(Bulletin $bulletin)
    {
        return view('bulletin.show', compact('bulletin'));
    }
}
