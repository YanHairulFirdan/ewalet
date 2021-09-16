<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $types = Type::get();

        return view('user.subscription', compact('types'));
    }
}
