<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $employee = Employee::where('user_id', $userId)->first();
        $user = User::findOrFail($userId);
        $leaveRequests = null;
        if ($user->employee) {
            $leaveRequests = $user->employee->leaveRequests()->paginate(5);
        }
        return view('User.dashboard', compact('employee', 'employee', 'leaveRequests', 'leaveRequests'));
    }
}
