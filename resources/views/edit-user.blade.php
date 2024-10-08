<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('แก้ไขผู้ใช้') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">แก้ไขผู้ใช้</h3>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700">ชื่อ-นามสกุล</label>
                            <x-text-input type="text" name="name" class="block mt-1 w-full" value="{{ old('name', $user->name) }}" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">อีเมล</label>
                            <x-text-input type="email" name="email" class="block mt-1 w-full" value="{{ old('email', $user->email) }}" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">รหัสผ่าน <small class="text-muted">(ปล่อยว่างถ้าไม่ต้องการเปลี่ยน)</small></label>
                            <x-text-input type="password" name="password" class="block mt-1 w-full" />
                            <small>* รหัสผ่านความยาว 6 ตัวขึ้นไป</small>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">ประเภทผู้ใช้</label>
                            <select name="role"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                required>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>ผู้ใช้ทั่วไป</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>ผู้ดูแลระบบ</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">ระดับ</label>
                            <select name="rank"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                required>
                                <option value="0" {{ $user->rank == '0' ? 'selected' : '' }}>ไม่มี (สำหรับแอดมิน)</option>
                                <option value="1" {{ $user->rank == '1' ? 'selected' : '' }}>เจ้าหน้าที่</option>
                                <option value="2" {{ $user->rank == '2' ? 'selected' : '' }}>อาจารย์</option>
                                <option value="3" {{ $user->rank == '3' ? 'selected' : '' }}>หัวหน้าหลักสูตร</option>
                                <option value="4" {{ $user->rank == '4' ? 'selected' : '' }}>หัวหน้าสาขา</option>
                                <option value="5" {{ $user->rank == '5' ? 'selected' : '' }}>ผู้ช่วยคณบดี</option>
                                <option value="6" {{ $user->rank == '6' ? 'selected' : '' }}>รองคณบดี</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">กลุ่มภาระงาน <small class="text-muted">(ไม่บังคับ)</small></label>
                            <select name="professor_group"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                required>
                                <option value="0" {{ $user->professor_group == '0' ? 'selected' : '' }}>ไม่มี (สำหรับสมาชิกที่ไม่ใช่อาจารย์)</option>
                                <option value="1" {{ $user->professor_group == '1' ? 'selected' : '' }}>กลุ่มทั่วไป</option>
                                <option value="2" {{ $user->professor_group == '2' ? 'selected' : '' }}>กลุ่มเน้นสอน</option>
                                <option value="3" {{ $user->professor_group == '3' ? 'selected' : '' }}>กลุ่มเน้นวิจัย</option>
                                <option value="4" {{ $user->professor_group == '4' ? 'selected' : '' }}>กลุ่มเน้นบริการวิชาการ</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <x-primary-button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                อัปเดตผู้ใช้งาน
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
