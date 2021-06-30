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

        $bulletin = Bulletin::create($validated);
        $extension = $bulletinRequest->file('image')->getClientOriginalExtension();

        // $path = $bulletinRequest->file('image')->storeAs('images', $bulletin->id . '-' . $bulletin->title . $extension);
        $path = $bulletinRequest->file('image')->storeAs('public/images', $bulletin->id . '-' . $bulletin->title . '.' . $extension);

        return redirect()->back();
    }

    public function postPassword(Request $request, Bulletin $bulletin)
    {
        $action        = $request['submit_edit'] ?: $request['submit_delete'];
        $disableButton = $action == 'edit' ? 'delete' : 'edit';

        session([$action => true, $disableButton => false]);

        if ($checked = $bulletin->passwordCheck($request->password, $action)) {
            session($checked);

            return redirect(route('bulletin.show', ['bulletin' => $bulletin->id]));
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

        $currentPage = set_redirect_index(Session::get('currentPage'), Session::get('perPage'), $bulletin);

        return redirect(url('bulletin?page=' . $currentPage));
    }

    public function show(Bulletin $bulletin)
    {
        $slot = Session::get('slotName');

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

        $currentPage = set_redirect_index(Session::get('currentPage'), Session::get('perPage'), $bulletin);

        return redirect(url('bulletin?page=' . $currentPage));
    }
}
