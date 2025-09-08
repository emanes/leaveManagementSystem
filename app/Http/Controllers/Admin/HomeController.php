<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $pendingReq = User::whereDoesntHave('employee')
            ->where('role', '!=', 'admin')
            ->count();
        $leaveRequests = LeaveRequest::where('status', 'pending')->count();
        return view('Admin.dashboard',compact('pendingReq','pendingReq','leaveRequests','leaveRequests' ));
    }
}
