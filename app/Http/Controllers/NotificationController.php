<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class NotificationController extends Controller
{
    public function index(): Response
    {
        return inertia('Notification/IndexNotice', ['notifications' => Auth::user()->notifications()->paginate(10)]);
    }
}
