<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ภาระงาน') }}
        </h2>
    </x-slot>
    @php
        $year = request('year', date('Y')); // ถ้าไม่มีค่า year จะใช้ปีปัจจุบัน
        $times = request('times', 1); // ถ้าไม่มีค่า times จะใช้ค่า 1
    @endphp

    <div class="py-12 pb-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 row">
                    <form action="{{ route('workload') }}" method="GET" class="row"> <!-- เพิ่มฟอร์ม -->
                        <div class="col-3">
                            <label for="year">ปี</label>
                            <select class="form-select" name="year">
                                @for ($x = 5; $x >= -5; $x--)
                                    <option value="{{ date('Y') + $x }}"
                                        {{ $year == date('Y') + $x ? 'selected' : '' }}>
                                        {{ date('Y') + $x }}
                                    </option>
                                @endfor
                            </select>
                            
                            
                        </div>
                        <div class="col-3">
                            <label for="times">ครั้งที่</label>
                            <select class="form-select" name="times">
                                @for ($x = 1; $x <= 2; $x++)
                                    <option value="{{ $x }}" {{ $times == $x ? 'selected' : '' }}>
                                        {{ $x }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="">&nbsp;</label>
                            <button type="submit" class="btn btn-success d-block"><i
                                    class='bx bx-search-alt-2'></i>&nbsp;ค้นหา</button>
                        </div>
                    </form> <!-- ปิดฟอร์ม -->

                </div>
            </div>
        </div>
    </div>


    <div class="py-12 pt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <b>ข้อมูลสำหรับปี {{ $year }} ครั้งที่ {{ $times }}</b>
                    </div>

                        <div class="ms-auto d-flex mb-3 justify-content-end">
                            {{-- <a href="../print-all-workload-superadmin/{{ $users->id }}">
                                <button class="btn btn-primary"><i
                                        class='bx bxs-printer'></i>&nbsp;พิมพ์เอกสารทั้งหมด</button>
                            </a> --}}
                            <div class="me-2">
                                <select class="form-select select-professor-group me-2">
                                    <option value="1">กลุ่มทั่วไป</option>
                                    <option value="2">กลุ่มเน้นสอน</option>
                                    <option value="3">กลุ่มเน้นวิจัย</option>
                                    <option value="4">กลุ่มเน้นบริการวิชาการ</option>
                                </select>
                            </div>
                            <button class="btn btn-primary btn-printall" attr-user-id="{{ auth()->id() }}"><i
                                    class='bx bxs-printer'></i>&nbsp;พิมพ์เอกสารทั้งหมด</button>
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
                                        <a href="{{ route('workloads.show', ['id' => $workload->id]) }}?year={{ $year }}&times={{ $times }}&professor_group={{ Auth::user()->professor_group }}"
                                            class="btn btn-primary w-100">จัดการข้อมูล</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('workloads.summary', ['id' => $workload->id]) }}?year={{ $year }}&times={{ $times }}&professor_group={{ Auth::user()->professor_group }}"
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

    <script>
        $(document).on('click', '.btn-printall', function() {
            let select_professor_group = $(this).siblings().find('.select-professor-group')
                .val(); // ใช้ siblings เพื่อหา select ภายใน div
            let user_id = $(this).attr('attr-user-id')
            let year = {{ $year }}
            let times = {{ $times }}
            // console.log(select_professor_group);
            window.open(
                `../print-all-workload/${user_id}?year=${year}&times=${times}&professor_group=${select_professor_group}`
            );
        });
    </script>
</x-app-layout>
