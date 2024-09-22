<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ภาระงาน') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-end mb-3">
                        <a href="../print-all-workload/{{ auth()->id() }}">
                            <button class="btn btn-primary text-end"><i
                                    class='bx bxs-printer'></i>&nbsp;พิมพ์เอกสารทั้งหมด</button>
                        </a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ภาระงาน</th>
                                <th>คิดเป็นภาระงาน<br>(ชั่วโมงต่อสัปดาห์)</th>
                                <th>เพิ่ม/แก้ไขข้อมูล</th>
                                <th>รายงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($workloads as $workload)
                                <tr>
                                    <td>{{ $workload->id }}</td>
                                    <td>{{ $workload->name }}</td>
                                    <td>{{ $workload->totalScore }}</td>
                                    <td>
                                        <a href="{{ route('workloads.show', $workload->id) }}"
                                            class="btn btn-primary w-100">จัดการข้อมูล</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('workloads.summary', $workload->id) }}"
                                            class="btn btn-secondary w-100">รายงานสรุป</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">ผลรวม</td>
                                <td>{{ $totalScore }}</td>
                                <td colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
