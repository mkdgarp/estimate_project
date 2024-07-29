<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('จัดการ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">รายชื่อผู้ใช้งานทั้งหมด</h3>
                    <table class="table-auto w-full table">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                {{-- <th class="px-4 py-2">Role</th>
                                <th class="px-4 py-2">Rank</th> --}}
                                <th class="px-4 py-2">position</th>
                                <th class="px-4 py-2">department</th>
                                <th class="px-4 py-2">salary</th>
                                <th class="px-4 py-2">supervisor</th>
                                <th class="px-4 py-2">manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                @if ($user->role != 'admin')
                                    <tr>
                                        <td class="border px-4 py-2">{{ $index }}</td>
                                        <td class="border px-4 py-2">{{ $user->name }}</td>
                                        <td class="border px-4 py-2">{{ $user->email }}</td>
                                        {{-- <td class="border px-4 py-2">{{ $user->role }}</td>
                                    <td class="border px-4 py-2">{{ $user->rank }}</td> --}}
                                        <td class="border px-4 py-2">{{ $user->position }}</td>
                                        <td class="border px-4 py-2">{{ $user->department }}</td>
                                        <td class="border px-4 py-2">{{ $user->salary }}</td>
                                        <td class="border px-4 py-2">{{ $user->supervisor }}</td>
                                        <td class="border px-4 py-2">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
