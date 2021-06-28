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
        $mode = $request->submit;

        if ($checked = $bulletin->passwordCheck($request->password, $mode)) {
            return redirect(route('bulletin.show', ['bulletin' => $bulletin->id, 'mode' => $mode]))
                ->with($checked);
        }

        return redirect(route('bulletin.show.' . $mode, ['bulletin' => $bulletin->id]))
            ->with(['type' => 'confirm']);
    }

    public function showEdit(Bulletin $bulletin)
    {
        $currentPage = Session::get('currentPage');

        return view('bulletin.edit', compact('bulletin', 'currentPage'));
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
        $mode = Session::get('mode');

        session()->reflash();

        return view('bulletin.show', compact('bulletin', 'slot', 'mode'));
    }
}
