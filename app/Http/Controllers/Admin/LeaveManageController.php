<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\LeaveRequestApproved;
use App\Mail\LeaveRequestRejected;
use App\Models\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeaveManageController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $pendingLeaveRequests = LeaveRequest::where('status', 'pending')
            ->with('employee.user')
            ->latest()
            ->paginate(5);
        $otherLeaveRequests = LeaveRequest::where('status','!=', 'pending')
            ->with('employee.user')
            ->latest()
            ->paginate(5);
        $leaveRequests = LeaveRequest::all();
        return view('Admin.manageLeave', compact('pendingLeaveRequests','pendingLeaveRequests', 'otherLeaveRequests','otherLeaveRequests', 'leaveRequests','leaveRequests'));
    }

    public function approveLeave(Request $request): RedirectResponse
    {
        $leaveRequest = LeaveRequest::find($request->id);
        $leaveRequest->status = 'Approved';
        $leaveRequest->save();
        $duration = Carbon::parse($leaveRequest->leave_from)->diffInDays(Carbon::parse($leaveRequest->leave_to)) + 1;

        $employee = $leaveRequest->employee;

        if($leaveRequest->leave_type == 'Casual Leave'){
            $employee->casual_leave += $duration;
        }
        elseif($leaveRequest->leave_type == 'Sick Leave'){
            $employee->sick_leave += $duration;
        }
        elseif($leaveRequest->leave_type == 'Emergency Leave'){
            $employee->emergency_leave += $duration;
        }
        $employee->total_leave += $duration;
        $employee->save();

        $mailData = [
            'employee_name' => $employee->user->name,
            'leave_from' => $leaveRequest->leave_from,
            'leave_to' => $leaveRequest->leave_to,
            'leave_type' => $leaveRequest->leave_type,
            'reason' => $leaveRequest->reason,
        ];

        mail::to($employee->user->email)->send(new LeaveRequestApproved($mailData));

        return redirect()->back()->with('success', 'Leave request approved successfully');
    }

    public function rejectLeave(Request $request): RedirectResponse
    {
        $leaveRequest = LeaveRequest::find($request->id);
        $leaveRequest->status = 'Rejected';
        $leaveRequest->save();

        $employee = $leaveRequest->employee;
        $mailData = [
            'employee_name' => $employee->user->name,
            'leave_from' => $leaveRequest->leave_from,
            'leave_to' => $leaveRequest->leave_to,
            'leave_type' => $leaveRequest->leave_type,
            'reason' => $leaveRequest->reason,
        ];

        mail::to($employee->user->email)->send(new LeaveRequestRejected($mailData));

        return redirect()->back()->with('success', 'Leave request rejected successfully');
    }
}
