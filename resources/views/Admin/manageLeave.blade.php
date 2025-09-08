<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Leave Requests') }}
        </h2>
    </x-slot>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" style="background-color: #68D391" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full table-auto">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">Pending Requests</th>
                            <th class="px-4 py-2">Approved Requests</th>
                            <th class="px-4 py-2">Rejected Requests</th>
                            <th class="px-4 py-2">Total Requests</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="px-4 py-2 text-center">{{ $leaveRequests->where('status', 'Pending')->count() }}</td>
                            <td class="px-4 py-2 text-center">{{ $leaveRequests->where('status', 'Approved')->count() }}</td>
                            <td class="px-4 py-2 text-center">{{ $leaveRequests->where('status', 'Rejected')->count() }}</td>
                            <td class="px-4 py-2 text-center">{{ $leaveRequests->count() }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Pending Leave Requests') }}
                        </h2>
                    </div>

                    <div class="bg-white p-4 rounded-lg">
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2 text-center">#Sl No</th>
                                    <th class="px-4 py-2 text-start">Request By</th>
                                    <th class="px-4 py-2 text-start">Leave Type</th>
                                    <th class="px-4 py-2 text-start">From</th>
                                    <th class="px-4 py-2 text-start">To</th>
                                    <th class="px-4 py-2 text-start">Duration</th>
                                    <th class="px-4 py-2 text-start">Reason</th>
                                    <th class="px-4 py-2 text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($pendingLeaveRequests == null || $pendingLeaveRequests->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">No Leave Request</td>
                                    </tr>
                                @endif
                                @foreach($pendingLeaveRequests as $pendingLeaveRequest)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-4 py-2 text-center">{{ ($pendingLeaveRequests->currentPage()-1) * $pendingLeaveRequests->perPage() + $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $pendingLeaveRequest->employee->user->name }}</td>
                                        <td class="px-4 py-2">{{ $pendingLeaveRequest->leave_type }}</td>
                                        <td class="px-4 py-2">{{ $pendingLeaveRequest->leave_from }}</td>
                                        <td class="px-4 py-2">{{ $pendingLeaveRequest->leave_to }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($pendingLeaveRequest->leave_from)->diffInDays(\Carbon\Carbon::parse($pendingLeaveRequest->leave_to)) }} days</td>
                                        <td class="px-4 py-2">{{ $pendingLeaveRequest->reason }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <div class="flex gap-2 justify-center">
                                                <a href="{{route('admin.approve-leave', $pendingLeaveRequest->id)}}" style="background-color:#128019" class="text-white font-bold py-2 px-4 rounded">
                                                    Approve
                                                </a>
                                                <a href="{{route('admin.reject-leave', $pendingLeaveRequest->id)}}" style="background-color:#cd3952" class="text-white font-bold py-2 px-4 rounded">
                                                    Reject
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $pendingLeaveRequests->onEachSide(1)->links() }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Previous Leave Requests') }}
                        </h2>
                    </div>

                    <div class="bg-white p-4 rounded-lg">
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2 text-center">#Sl No</th>
                                    <th class="px-4 py-2 text-start">Request By</th>
                                    <th class="px-4 py-2 text-start">Leave Type</th>
                                    <th class="px-4 py-2 text-start">From</th>
                                    <th class="px-4 py-2 text-start">To</th>
                                    <th class="px-4 py-2 text-start">Duration</th>
                                    <th class="px-4 py-2 text-start">Reason</th>
                                    <th class="px-4 py-2 text-center">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($otherLeaveRequests == null || $otherLeaveRequests->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">No Leave Request</td>
                                    </tr>
                                @endif
                                @foreach($otherLeaveRequests as $otherLeaveRequest)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-4 py-2 text-center">{{ ($otherLeaveRequests->currentPage()-1) * $otherLeaveRequests->perPage() + $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $otherLeaveRequest->employee->user->name }}</td>
                                        <td class="px-4 py-2">{{ $otherLeaveRequest->leave_type }}</td>
                                        <td class="px-4 py-2">{{ $otherLeaveRequest->leave_from }}</td>
                                        <td class="px-4 py-2">{{ $otherLeaveRequest->leave_to }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($otherLeaveRequest->leave_from)->diffInDays(\Carbon\Carbon::parse($otherLeaveRequest->leave_to)) }} days</td>
                                        <td class="px-4 py-2">{{ $otherLeaveRequest->reason }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <div class="flex gap-2 justify-center">
                                                @if($otherLeaveRequest->status === 'Approved')
                                                <div style="background-color:#128019" class="text-white font-bold py-2 px-4 rounded">
                                                    Approved
                                                </div>
                                                @elseif($otherLeaveRequest->status === 'Rejected')
                                                <div style="background-color:#cd3952" class="text-white font-bold py-2 px-4 rounded">
                                                    Rejected
                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $otherLeaveRequests->onEachSide(1)->links() }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
