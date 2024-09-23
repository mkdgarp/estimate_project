<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('เพิ่มผู้ใช้ใหม่') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">เพิ่มผู้ใช้ใหม่</h3>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">ชื่อ-นามสกุล</label>
                            <x-text-input type="text" name="name" class="block mt-1 w-full" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">อีเมล</label>
                            <x-text-input type="email" name="email" class="block mt-1 w-full" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">รหัสผ่าน</label>
                            <x-text-input type="password" name="password" class="block mt-1 w-full" required />
                            <small>* รหัสผ่านความยาว 6 ตัวขึ้นไป</small>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">ประเภทผู้ใช้</label>
                            <select name="role"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                required>
                                <option value="user">ผู้ใช้ทั่วไป</option>
                                <option value="admin">ผู้ดูแลระบบ</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">ระดับ</label>
                            <select name="rank"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                required>
                                <option value="0">ไม่มี (สำหรับแอดมิน)</option>
                                <option value="1">เจ้าหน้าที่</option>
                                <option value="2">อาจารย์</option>
                                <option value="3">หัวหน้าหลักสูตร</option>
                                <option value="4">หัวหน้าสาขา</option>
                                <option value="5">ผู้ช่วยคณบดี</option>
                                <option value="6">รองคณบดี</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <x-primary-button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                เพิ่มผู้ใช้งาน
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
