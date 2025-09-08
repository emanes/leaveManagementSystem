<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if($employee == null || $employee->status !== 'active')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You're not listed as an employee!!!") }}
                    </div>
                    <div class="p-6 text-gray-900">
                        {{ __("Please contact with admin") }}
                    </div>
                </div>
            </div>
        </div>
    @else

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" style="background-color: #68D391" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <a href="{{route('leave-request.create')}}" class="block p-6 text-gray-900 text-center hover:underline">
                        {{ __("Create a leave request") }}
                    </a>
                </div>
            </div>
        </div>

        <div class="pb-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <table class="w-full table-auto">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">Casual Leave</th>
                                <th class="px-4 py-2">Sick Leave</th>
                                <th class="px-4 py-2">Emergency Leave</th>
                                <th class="px-4 py-2">Total Leave</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="px-4 py-2 text-center">{{ $employee->casual_leave }}</td>
                                <td class="px-4 py-2 text-center">{{ $employee->sick_leave }}</td>
                                <td class="px-4 py-2 text-center">{{ $employee->emergency_leave }}</td>
                                <td class="px-4 py-2 text-center">{{ $employee->total_leave }}</td>
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
                                {{ __('Leave Requests') }}
                            </h2>
                        </div>

                        <div class="bg-white p-4 rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="w-full table-auto">
                                    <thead>
                                    <tr class="bg-gray-200">
                                        <th class="px-4 py-2 text-center">#Sl No</th>
                                        <th class="px-4 py-2 text-start">Leave Type</th>
                                        <th class="px-4 py-2 text-start">From</th>
                                        <th class="px-4 py-2 text-start">To</th>
                                        <th class="px-4 py-2 text-start">Reason</th>
                                        <th class="px-4 py-2 text-center">Status</th>
                                        <th class="px-4 py-2 text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($leaveRequests == null || $leaveRequests->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center">No Leave Request</td>
                                        </tr>
                                    @endif
                                    @foreach($leaveRequests as $leaveRequest)
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-4 py-2 text-center">{{ ($leaveRequests->currentPage()-1) * $leaveRequests->perPage() + $loop->iteration }}</td>
                                            <td class="px-4 py-2">{{ $leaveRequest->leave_type }}</td>
                                            <td class="px-4 py-2">{{ $leaveRequest->leave_from }}</td>
                                            <td class="px-4 py-2">{{ $leaveRequest->leave_to }}</td>
                                            <td class="px-4 py-2">{{ $leaveRequest->reason }}</td>
                                            <td class="px-4 py-2 text-center"> {{ $leaveRequest->status }} </td>
                                            <td class="px-4 py-2 text-center">
                                                @if($leaveRequest->status === 'Pending')
                                                    <div class="flex gap-2 justify-center">
                                                        <a href="{{route('leave-request.edit', $leaveRequest->id)}}" style="background-color:#3f35da" class="text-white font-bold py-2 px-4 rounded">
                                                            edit
                                                        </a>
                                                        <form action="{{ route('leave-request.destroy', $leaveRequest->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" style="background-color:#cd3952" class="text-white font-bold py-2 px-4 rounded">
                                                                Delete
                                                            </button>
                                                        </form>

                                                    </div>
                                                @else
                                                    <div>
                                                        -
                                                    </div>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $leaveRequests->onEachSide(1)->links() }}
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

{{--        <div class="py-10">--}}
{{--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                    <div class="p-6 text-gray-900">--}}
{{--                        {{ __("You're logged in!") }}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    @endif

</x-app-layout>
