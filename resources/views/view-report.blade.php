<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ภาระงาน') }}
        </h2>
    </x-slot>
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" /> --}}

    {{-- <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.01.min.css">


    <style>
        .autoComplete_wrapper>input {
            color: rgb(16 134 79) !important;
            border: .05rem solid rgb(16 134 79) !important;
            background-color: white;
        }

        .autoComplete_wrapper>input::placeholder {
            color: rgba(16, 134, 79, .5) !important;
        }

        .autoComplete_wrapper>ul>li mark {
            background-color: transparent;
            color: rgb(16 134 79) !important;
            font-weight: 700
        }

        .autoComplete_wrapper>ul>li:hover {
            cursor: pointer;
            background-color: rgba(16, 134, 79, .15) !important;
        }
    </style>
    @php
        $year = request('year', date('Y')); // ถ้าไม่มีค่า year จะใช้ปีปัจจุบัน
        $times = request('times', 1); // ถ้าไม่มีค่า times จะใช้ค่า 1
    @endphp


    <div class="py-12 pb-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 row">

                    <form action="{{ route('workloads.view-report') }}" method="GET" class="row"> <!-- เพิ่มฟอร์ม -->
                        <div class="col-3">
                            <label for="year">ปี</label>
                            <select class="form-select" name="year">
                                @for ($x = 5; $x >= -5; $x--)
                                    <option value="{{ date('Y') + $x }}"
                                        {{ $year == date('Y') + $x ? 'selected' : '' }}>
                                        {{ (date('Y') + $x) + 543 }} <!-- แสดงปีเป็น พ.ศ. -->
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
                    {{-- {{ $user }} --}}
                    <div>
                        <b>ข้อมูลสำหรับปี {{ ($year + 543) }} ครั้งที่ {{ $times }}</b>
                    </div>
                    <div class="text-end row">

                        <div class="autoComplete_wrapper text-end d-flex justify-content-end align-items-center">
                            <span class=" me-3">ค้นหารายชื่อ</span>
                            @if (Auth::user()->rank != '1')
                                <input class="trigger-autocomplete" id="autoComplete_not_staff" type="search"
                                    dir="ltr" spellcheck=false autocorrect="off" autocomplete="off"
                                    autocapitalize="off">
                            @else
                                <input class="trigger-autocomplete" id="autoComplete_staff" type="search"
                                    dir="ltr" spellcheck=false autocorrect="off" autocomplete="off"
                                    autocapitalize="off">
                            @endif
                        </div>
                    </div>

                    <table class="table table-bordered" id="myTable">
                        <thead>
                        </thead>
                        @if (Auth::user()->rank != '1')
                            <tbody>
                                @foreach ($user as $index => $users)
                                    <tr class="text-white border-0 tr-main tr-show-{{ $users->id }}">
                                        <td style="border-right: 0;border-left: 0;" class="text-white">xxxxxxx<br></td>
                                    </tr>
                                    <tr class="tr-main tr-show-{{ $users->id }}">
                                        <td class="bg-secondary-subtle" style="border-right: 0"></td>
                                        <td class="bg-secondary-subtle" style="border-left: 0" colspan="4">
                                            {{-- /print-all-workload-superadmin/{userId} --}}
                                            <div class="d-flex w-100">
                                                <div class="me-auto">
                                                    <h5><b>{{ $users->name }}</b></h5>
                                                </div>
                                                <div class="ms-auto d-flex">
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
                                                    <button class="btn btn-primary btn-printall"
                                                        attr-user-id="{{ $users->id }}"><i
                                                            class='bx bxs-printer'></i>&nbsp;พิมพ์เอกสารทั้งหมด</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach ($workloads as $workload)
                                        <tr class="tr-main tr-show-{{ $users->id }}">
                                            <td>{{ $workload->id }}</td>
                                            <td>{{ $workload->name }}</td>
                                            <td>
                                                <a href="../manage-subworkload-list-by-id/{{ $users->id }}/{{ $workload->id }}?year={{ $year }}&times={{ $times }}"
                                                    class="btn btn-warning w-100">แก้ไขข้อมูล</a>
                                            </td>
                                            <td>
                                                <a href="../view-report-by-id/{{ $users->id }}/{{ $workload->id }}?year={{ $year }}&times={{ $times }}"
                                                    class="btn btn-secondary w-100">รายงานสรุป</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="tr-main tr-show-{{ $users->id }}">
                                        <td colspan="3" class="text-end fw-bold">รวมคะแนน</td>
                                        <td class="fw-bold text-end">
                                            {{ isset($arrTotalScore[$users->id]) && $arrTotalScore[$users->id] != 0 ? $arrTotalScore[$users->id] : '0' }}
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        @else
                            <tbody class="tbody-show">
                                @foreach ($user as $index => $users)
                                    <tr class="text-white border-0 tr-main tr-show-{{ $users->id }}">
                                        <td style="border-right: 0;border-left: 0;" class="text-white">xxxxxxx<br></td>
                                    </tr>
                                    <tr class="tr-main tr-show-{{ $users->id }}">
                                        <td class="bg-secondary-subtle" style="border-right: 0"></td>
                                        <td class="bg-secondary-subtle" style="border-left: 0" colspan="3">
                                            <h5><b>{{ $users->name }}</b></h5>
                                        </td>
                                    </tr>
                                    @foreach ($workloads as $workload)
                                        {{ $workload->totalScore }}
                                        <tr class="tr-main tr-show-{{ $users->id }}">
                                            <td>{{ $workload->id }}</td>
                                            <td>{{ $workload->name }}</td>
                                            <td>
                                                <a href="../staff-manage-subworkload-list-by-id/{{ $users->id }}/{{ $workload->id }}?year={{ $year }}&times={{ $times }}"
                                                    class="btn btn-warning w-100">แก้ไขข้อมูล</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="tr-main tr-show-{{ $users->id }}">
                                        <td colspan="3" class="text-end fw-bold">รวมคะแนน</td>
                                        <td class="fw-bold text-end">
                                            {{ isset($arrTotalScore[$users->id]) && $arrTotalScore[$users->id] != 0 ? $arrTotalScore[$users->id] : '0' }}
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        @endif

                    </table>
                </div>

            </div>
        </div>
    </div>
    <script>
        const autoCompleteJS = new autoComplete({
            selector: "#autoComplete_not_staff",
            placeHolder: "ค้นหาด้วยชื่อ..",
            data: {
                src: async (query) => {
                    const source = await fetch(`/search-users?query=${query}`);
                    const data = await source.json();
                    return data;
                },
                keys: ["name"]
            },
            resultsList: {
                element: (list, data) => {
                    if (!data.results.length) {
                        // Create "No Results" message element
                        const message = document.createElement("div");
                        // Add class to the created element
                        message.setAttribute("class", "no_result");
                        // Add message text content
                        message.innerHTML = `<span>ไม่พบการค้นหา "${data.query}"</span>`;
                        // Append message element to the results list
                        list.prepend(message);
                    }
                },
                noResults: true,
            },
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        console.log(event.detail.selection.value.name)
                        const selection = event.detail.selection.value.name;
                        autoCompleteJS.input.value = selection;
                        $(`.tr-main`).hide()
                        $(`.tr-show-${event.detail.selection.value.id}`).show()

                    }
                }
            }
        });

        const autoCompleteJS2 = new autoComplete({
            selector: "#autoComplete_staff",
            placeHolder: "ค้นหาด้วยชื่อ..",
            data: {
                src: async (query) => {
                    const source = await fetch(`/search-users?query=${query}`);
                    const data = await source.json();
                    return data;
                },
                keys: ["name"]
            },
            resultsList: {
                element: (list, data) => {
                    if (!data.results.length) {
                        // Create "No Results" message element
                        const message = document.createElement("div");
                        // Add class to the created element
                        message.setAttribute("class", "no_result");
                        // Add message text content
                        message.innerHTML = `<span>ไม่พบการค้นหา "${data.query}"</span>`;
                        // Append message element to the results list
                        list.prepend(message);
                    }
                },
                noResults: true,
            },
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        console.log(event.detail.selection.value.name)
                        const selection = event.detail.selection.value.name;
                        autoCompleteJS2.input.value = selection;


                        $(`.tr-main`).hide()
                        $(`.tr-show-${event.detail.selection.value.id}`).show()


                    }
                }
            }
        });

        $(document).on('change', '.trigger-autocomplete', function() {
            console.log($(this).val())
            let val = $(this).val()
            if (val == '') {
                $(`.tr-main`).show()
            }
        })

        $(document).on('click', 'html', function() {
            setTimeout(function() {
                let val = $('.trigger-autocomplete').val()

                if (val == '') {
                    $(`.tr-main`).show()
                }

            }, 150);

        })

        $(document).on('click', '.btn-printall', function() {
            let select_professor_group = $(this).siblings().find('.select-professor-group')
                .val(); // ใช้ siblings เพื่อหา select ภายใน div
            let user_id = $(this).attr('attr-user-id')
            let year = {{ $year }}
            let times = {{ $times }}
            // console.log(select_professor_group);
            window.open(
                `../print-all-workload-superadmin/${user_id}?year=${year}&times=${times}&professor_group=${select_professor_group}`
            );
        });
    </script>
</x-app-layout>
