<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Employee') }}
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
                <div class="p-6 text-gray-900">
                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Pending Request') }}
                        </h2>
                    </div>

                    <div class="bg-white p-4 rounded-lg">
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2 text-center">#Sl No</th>
                                    <th class="px-4 py-2 text-start">Name</th>
                                    <th class="px-4 py-2 text-start">Email</th>
                                    <th class="px-4 py-2 text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($pendingUsers == null || $pendingUsers->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No pending request</td>
                                    </tr>
                                @endif
                                @foreach($pendingUsers as $pendingUser)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-4 py-2 text-center">{{ ($pendingUsers->currentPage()-1) * $pendingUsers->perPage() + $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $pendingUser->name }}</td>
                                        <td class="px-4 py-2">{{ $pendingUser->email }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <a href="{{ route('admin.approve-employee', $pendingUser->id) }}" style="background-color: #68D391" class="text-white font-bold py-2 px-4 rounded">
                                                Approve
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $pendingUsers->onEachSide(1)->links() }}
                        </div>
                    </div>


                </div>
                </div>
        </div>
    </div>

    <div class="pb-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Active Employees') }}
                        </h2>
                    </div>

                    <div class="bg-white p-4 rounded-lg">
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2 text-center">#Sl No</th>
                                    <th class="px-4 py-2 text-start">Name</th>
                                    <th class="px-4 py-2 text-start">Email</th>
                                    <th class="px-4 py-2 text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($activeEmployees == null || $activeEmployees->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No Active Employee</td>
                                    </tr>
                                @endif
                                @foreach($activeEmployees as $activeEmployee)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-4 py-2 text-center">{{ ($activeEmployees->currentPage()-1) * $activeEmployees->perPage() + $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $activeEmployee->name }}</td>
                                        <td class="px-4 py-2">{{ $activeEmployee->email }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <a href={{ route('admin.block-employee', $activeEmployee->id) }} style="background-color:#ca2323" class="text-white font-bold py-2 px-4 rounded">
                                                Block
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $activeEmployees->onEachSide(1)->links() }}
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
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Blocked Employee') }}
                        </h2>
                    </div>

                    <div class="bg-white p-4 rounded-lg">
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2 text-center">#Sl No</th>
                                    <th class="px-4 py-2 text-start">Name</th>
                                    <th class="px-4 py-2 text-start">Email</th>
                                    <th class="px-4 py-2 text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($blockedEmployees == null || $blockedEmployees->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No Blocked Employee</td>
                                    </tr>
                                @endif
                                @foreach($blockedEmployees as $blockedEmployee)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-4 py-2 text-center">{{ ($blockedEmployees->currentPage()-1) * $blockedEmployees->perPage() + $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $blockedEmployee->name }}</td>
                                        <td class="px-4 py-2">{{ $blockedEmployee->email }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <a href={{route('admin.unblock-employee', $blockedEmployee->id)}} style="background-color:#68D391" class="text-white font-bold py-2 px-4 rounded">
                                                Unblock
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $pendingUsers->onEachSide(1)->links() }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
