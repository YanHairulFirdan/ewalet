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
        $bulletins = Bulletin::orderBy('created_at', 'DESC')->paginate(10);

        session(['currentPage' => $bulletins->currentPage(), 'perPage' => $bulletins->perPage(), 'delete' => true, 'edit' => true]);

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
        // refactor
        $action        = $request['submit_edit'] ?: $request['submit_delete'];
        $disableButton = $action == 'edit' ? 'delete' : 'edit';

        session([$action => true]);
        session([$disableButton => false]);
        // refactor

        if ($checked = $bulletin->passwordCheck($request->password, $action)) {
            return redirect(route('bulletin.show', ['bulletin' => $bulletin->id]))
                ->with($checked);
        }

        return redirect(route('bulletin.show.' . $action, ['bulletin' => $bulletin->id]));
    }

    public function showEdit(Bulletin $bulletin)
    {
        return view('bulletin.edit', compact('bulletin'));
    }

    public function update(BulletinRequest $request, Bulletin $bulletin)
    {
        $validated = $request->validated();

        $bulletin->update($validated);

        return redirect(url('bulletin?page=' . Session::get('currentPage')));
    }

    public function show(Bulletin $bulletin)
    {
        $slot = Session::get('slotName');

        session()->reflash();

        return view('bulletin.show', compact('bulletin', 'slot'));
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
}
