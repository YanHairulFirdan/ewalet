<?php

namespace App\Http\Controllers;

use App\Bulletin;
use App\Http\Requests\BulletinRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BulletinController extends Controller
{
    public function index()
    {
        $bulletins = Bulletin::orderBy('created_at', 'DESC')->paginate(2);

        session(['currentPage' => $bulletins->currentPage()]);

        dump(Session::get('currentPage'));

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
        if (!$bulletin->password) {
            return redirect(route('bulletin.show', ['bulletin' => $bulletin->id]))
                ->with(['error' => "This message can't delete, because this message has no been set password", 'slotName' => 'previousButton']);
        }

        if (strlen($request->password) !== 4) {
            return redirect(route('bulletin.show', ['bulletin' => $bulletin->id]))
                ->with(['error' => 'Your password must be 4 digit', 'slotName' => 'form']);
        }

        if ($request->password !== $bulletin->password) {
            return redirect(route('bulletin.show', ['bulletin' => $bulletin->id]))
                ->with(['error' => 'The password you entered does not match. Please try again', 'slotName' => 'form']);
        }

        return redirect(route('bulletin.show.delete', ['bulletin' => $bulletin->id]))
            ->with(['type' => 'confirm']);
    }

    public function showDelete(Bulletin $bulletin)
    {
        $currentPage = Session::get('currentPage');

        return view('bulletin.delete', compact('bulletin', 'currentPage'));
    }

    public function delete(Bulletin $bulletin)
    {
        $bulletin->delete();

        return redirect(url('bulletin?page=' . Session::get('currentPage')));
    }

    public function show(Bulletin $bulletin)
    {
        $slot = Session::get('slotName');

        session()->reflash();

        return view('bulletin.show', compact('bulletin', 'slot'));
    }
}
