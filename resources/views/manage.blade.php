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
                                {{-- <th class="px-4 py-2">Role</th> --}}
                                <th class="px-4 py-2">Rank</th>
                                <th class="px-4 py-2">Group</th>
                                {{-- <th class="px-4 py-2">position</th> --}}
                                {{-- <th class="px-4 py-2">department</th>
                                <th class="px-4 py-2">salary</th>
                                <th class="px-4 py-2">supervisor</th>
                                <th class="px-4 py-2">manage</th> --}}
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                @if ($user->role != 'admin')
                                    <tr>
                                        <td class="border px-4 py-2">{{ $index }}</td>
                                        <td class="border px-4 py-2">{{ $user->name }}</td>
                                        <td class="border px-4 py-2">{{ $user->email }}</td>
                                        <td class="border px-4 py-2">
                                            @if ($user->rank === '1')
                                                <p>เจ้าหน้าที่</p>
                                            @elseif ($user->rank === '2')
                                                <p>อาจารย์</p>
                                            @elseif ($user->rank === '3')
                                                <p>หัวหน้าหลักสูตร/สาขา/กลุ่มวิชา</p>
                                            @elseif ($user->rank === '4')
                                                <p>หัวหน้าสาขา</p>
                                            @elseif ($user->rank === '5')
                                                <p>ผู้ช่วยคณบดี</p>
                                            @elseif ($user->rank === '6')
                                                <p>รองคณบดี</p>
                                            @endif

                                        </td>
                                        <td>
                                            @if ($user->professor_group === '0')
                                                <p>-</p>
                                            @elseif ($user->professor_group === '1')
                                                <p>กลุ่มทั่วไป</p>
                                            @elseif ($user->professor_group === '2')
                                                <p>กลุ่มเน้นสอน</p>
                                            @elseif ($user->professor_group === '3')
                                                <p>กลุ่มเน้นวิจัย</p>
                                            @elseif ($user->professor_group === '4')
                                                <p>กลุ่มเน้นบริการวิชาการ</p>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <div>
                                                <button class="btn btn-outline-warning">แก้ไข</button>
                                            </div> --}}
                                            <div>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('คุณแน่ใจว่าต้องการลบผู้ใช้นี้หรือไม่?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <button class="btn btn-outline-danger" type="submit">ลบ</button>
                                                </form>
                                            </div>
                                        </td>

                                        {{-- <td class="border px-4 py-2">{{ $user->position }}</td> --}}
                                        {{-- <td class="border px-4 py-2">{{ $user->department }}</td>
                                        <td class="border px-4 py-2">{{ $user->salary }}</td>
                                        <td class="border px-4 py-2">{{ $user->supervisor }}</td> --}}
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
