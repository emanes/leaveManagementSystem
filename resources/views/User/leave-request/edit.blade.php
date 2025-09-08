<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Leave Request') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('leave-request.update', $leaveRequest->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="leave_type" class="block text-sm font-medium text-gray-700">Leave Type</label>
                            <select id="leave_type" name="leave_type" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="Casual Leave" {{ $leaveRequest->leave_type == 'Casual Leave' ? 'selected' : '' }}>Casual Leave</option>
                                <option value="Sick Leave" {{ $leaveRequest->leave_type == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                                <option value="Emergency Leave" {{ $leaveRequest->leave_type == 'Emergency Leave' ? 'selected' : '' }}>Emergency Leave</option>
                            </select>
                            @error('leave_type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="leave_from" class="block text-sm font-medium text-gray-700">Leave From</label>
                            <input type="date" name="leave_from" id="leave_from" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" value="{{ $leaveRequest->leave_from }}">
                            @error('leave_from')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="leave_to" class="block text-sm font-medium text-gray-700">Leave To</label>
                            <input type="date" name="leave_to" id="leave_to" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" value="{{ $leaveRequest->leave_to }}">
                            @error('leave_to')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                            <textarea id="reason" name="reason" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ $leaveRequest->reason }}</textarea>
                            @error('reason')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" style="background-color:#3f35da" class="hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
