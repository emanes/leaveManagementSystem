<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\LeaveRequestSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeaveRequestController extends Controller
{

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('User.leave-request.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'leave_from' => 'required|date',
            'leave_to' => 'required|date|after_or_equal:leave_from',
            'leave_type' => 'required|string',
        ], [
            'leave_to.after_or_equal' => 'The "Leave To" date must be after or equal to the "Leave From" date.',
        ]);
        $employee = $request->user()->employee;
        $employee->leaveRequests()->create($request->all());


        $mailData = [
            'employee_name' => $employee->user->name,
            'leave_from' => $request->leave_from,
            'leave_to' => $request->leave_to,
            'leave_type' => $request->leave_type,
            'reason' => $request->reason,
        ];

        mail::to($employee->user->email)->send(new LeaveRequestSubmission($mailData));

        return redirect()->route('dashboard')->with('success', 'Leave request submitted successfully.');
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leaveRequest = auth()->user()->employee->leaveRequests()->findOrFail($id);
        return view('User.leave-request.edit', compact('leaveRequest', 'leaveRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $leaveRequest = auth()->user()->employee->leaveRequests()->findOrFail($id);
        $request->validate([
            'leave_from' => 'required|date',
            'leave_to' => 'required|date|after_or_equal:leave_from',
            'leave_type' => 'required|string',
        ], [
            'leave_to.after_or_equal' => 'The "Leave To" date must be after or equal to the "Leave From" date.',
        ]);
        $leaveRequest->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Leave request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        $leaveRequest = auth()->user()->employee->leaveRequests()->findOrFail($id);
        $leaveRequest->delete();

        return redirect()->route('dashboard')->with('Success', 'Leave request deleted successfully.');
    }
}
