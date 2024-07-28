<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('หน้าแรก') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- ตรวจสอบ role --}}
                    @if (Auth::user()->role === 'admin')
                        <p>ยินดีต้อนรับ, แอดมิน!</p>
                    @elseif (Auth::user()->role === 'user' && Auth::user()->rank === '1')
                        <p>ยินดีต้อนรับ, เจ้าหน้าที่!</p>
                    @elseif (Auth::user()->role === 'user' && Auth::user()->rank === '2')
                        <p>ยินดีต้อนรับ, อาจารย์!</p>
                    @elseif (Auth::user()->role === 'user' && Auth::user()->rank === '3')
                        <p>ยินดีต้อนรับ, หัวหน้าหลักสูตร/สาขา/กลุ่มวิชา!</p>
                    @elseif (Auth::user()->role === 'user' && Auth::user()->rank === '4')
                        <p>ยินดีต้อนรับ, หัวหน้าสาขา!</p>
                    @elseif (Auth::user()->role === 'user' && Auth::user()->rank === '5')
                        <p>ยินดีต้อนรับ, ผู้ช่วยคณบดี!</p>
                    @elseif (Auth::user()->role === 'user' && Auth::user()->rank === '6')
                        <p>ยินดีต้อนรับ, รองคณบดี!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
