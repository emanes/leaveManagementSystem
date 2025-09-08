<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $pendingUsers = User::whereDoesntHave('employee')
            ->where('role', '!=', 'admin')
            ->select('id', 'name', 'email')
            ->latest()
            ->paginate(5);

        $activeEmployees = User::whereHas('employee', function($query) {
            $query->where('status', 'active');
        })->paginate(5);

        $blockedEmployees = User::whereHas('employee', function($query) {
            $query->where('status', 'blocked');
        })->paginate(5);

        return view('Admin.manageEmployee', compact('pendingUsers', 'pendingUsers', 'activeEmployees','activeEmployees', 'blockedEmployees', 'blockedEmployees'));
    }

    public function approveEmployee(Request $request)
    {
        $user = User::find($request->id);
        $user->employee()->create([
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', 'Employee approved successfully');
    }

    public function blockEmployee(Request $request)
    {
        $userId = $request->id;
        $employee = Employee::where('user_id', $userId)->first();

        if ($employee) {
            $employee->status = 'blocked';
            $employee->save();
        }

        return redirect()->back()->with('success', 'Employee blocked successfully');
    }

    public function unblockEmployee(Request $request)
    {
        $userId = $request->id;
        $employee = Employee::where('user_id', $userId)->first();

        if ($employee) {
            $employee->status = 'active';
            $employee->save();
        }

        return redirect()->back()->with('success', 'Employee unblocked successfully');
    }
}
