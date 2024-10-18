<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('แก้ไขภาระงานสอนของ: ') . $user->name }} <!-- ใช้ชื่อผู้ใช้ -->
        </h2>
    </x-slot>


    {{-- <p>Total Score: {{ $totalScore }}</p> --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h3 class="text-lg font-semibold mb-4">{{ $workload->name }}</h3>
                    <form method="POST" action="{{ route('subworkloads.updateScores') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="workload_id" value="{{ $workload->id }}">
                        <input type="hidden" name="is_staff" value="1">
                        <input type="hidden" name="year" value="{{ request('year', date('Y')) }}">
                        <input type="hidden" name="times" value="{{ request('times', 1) }}">
                        <input type="hidden" name="professor_group" value="{{ request('professor_group', 1) }}">




                        {{-- @foreach ($hierarchicalData as $data)
                    <pre>{{ $data }}</pre>
                @endforeach  --}}

                        {{-- <div class="accordion " id="accordionPanelsStayOpenExample"> --}}
                        @foreach ($hierarchicalData as $index => $subworkload)
                            {{-- <div class="accordion-item mb-3"> --}}
                            <div class="bg-primary-subtle p-3 rounded-left rounded-right w-100 d-flex">
                                <div>{{ $subworkload['subworkload']->name }}</div>
                                {{-- <div class="text-end ms-auto">
                                    <button class="btn btn-primary modal-move-subjects" type="button"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        subworkload_id="{{ $subworkload['subworkload']->id }}"
                                        user_id="{{ $user->id }}"
                                        subworkload_name="{{ $subworkload['subworkload']->name }}">
                                        <i class='bx bx-transfer-alt'></i>
                                        &nbsp;โยกย้ายภาระงาน
                                    </button>
                                </div> --}}
                            </div>

                            {{-- <div id="panelsStayOpen-{{ $index }}"
                                        class="accordion-collapse collapse show">
                                        <div class="accordion-body"> --}}
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ภาระงานย่อย</th>
                                        <th>หลักฐาน</th>
                                        <th class="text-center" width='100px'>จำนวน</th>
                                        <th class="text-center" width='150px'>ภาระงาน</th>
                                        {{-- <th class="text-center" width='150px'>รวมภาระงาน</th> --}}

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subworkload['list_subworkloads'] as $index_list => $list_subworkload)
                                        @if ($list_subworkload->list_subworkloads_child_id == null)
                                            <tr attr-id="{{ $list_subworkload->id }}">
                                                <td>
                                                    @if ($list_subworkload->is_child == 1)
                                                        {{ $list_subworkload->name }}
                                                        <br>
                                                        {{-- <div class="m-3"><button
                                                                class="btn btn-success add-new-subject mb-2"
                                                                sort_order="{{ $list_subworkload->sort_order }}"
                                                                subworkload_id="{{ $list_subworkload->subworkload_id }}"
                                                                list_id="{{ $list_subworkload->id }}">+
                                                                เพิ่มภาระงาน</button>
                                                        </div> --}}
                                                    @else
                                                        <div class="w-100 d-flex">
                                                            {{-- <button
                                                                class="btn btn-outline-danger border-0 remove-subjects py-1 px-2"
                                                                type="button" by-id="{{ $list_subworkload->id }}"
                                                                user-id="{{ $user->id }}"><i
                                                                    class='bx bxs-trash'></i></button> --}}
                                                            <p class="ps-4 pb-0 mb-0">
                                                                -&nbsp;&nbsp;{{ $list_subworkload->name }}</p>

                                                        </div>
                                                    @endif
                                                </td>
                                                <td style="width:190px;" class="text-center">
                                                    @if ($list_subworkload->is_child != 1)
                                                        {{-- {{ $list_subworkload->file_path }} --}}
                                                        @php
                                                            $filePaths = json_decode($list_subworkload->file_path);
                                                            if (is_array($filePaths)) {
                                                                // echo count($filePaths);
                                                            } else {
                                                                // echo 0;
                                                            }
                                                        @endphp


                                                        @if ($list_subworkload->file_path == '')
                                                            @for ($x = 0; $x <= 4; $x++)
                                                                {{-- {{ count($filePaths[$x]) }} --}}
                                                                <div>
                                                                    <input type="hidden"
                                                                        name="main[{{ $list_subworkload->id }}][list_subworkload_id]"
                                                                        value="{{ $list_subworkload->id }}">
                                                                    <input
                                                                        class="form-control form-control-sm formFileSm"
                                                                        name="main[{{ $list_subworkload->id }}][files][]"
                                                                        type="file" multiple style="display:none;"
                                                                        id="file-{{ $list_subworkload->id }}-{{ $x }}"
                                                                        onchange="updateFileName(this, {{ $list_subworkload->id }}, {{ $x }})">

                                                                    <label
                                                                        for="file-{{ $list_subworkload->id }}-{{ $x }}"
                                                                        class="rounded border px-2 py-1"
                                                                        style="cursor:pointer;">
                                                                        <i class='bx bx-link'></i> เลือกไฟล์
                                                                    </label>
                                                                    <span
                                                                        id="file-name-{{ $list_subworkload->id }}-{{ $x }}"
                                                                        class="file-name-display"
                                                                        style="margin-left: 10px;"></span>
                                                                </div>
                                                            @endfor
                                                        @else
                                                            @if (!empty($list_subworkload->file_path))
                                                                @php
                                                                    $filePaths = json_decode(
                                                                        $list_subworkload->file_path,
                                                                    );
                                                                @endphp



                                                                @foreach ($filePaths as $index => $file_path)
                                                                    <a href="{{ url('storage/' . $file_path) }}"
                                                                        target="_blank">
                                                                        <embed src="{{ url('storage/' . $file_path) }}"
                                                                            class="mx-auto" width="100"
                                                                            height="120">
                                                                    </a>
                                                                    <button
                                                                        class="btn btn-outline-danger remove-image mt-2"
                                                                        type="button"
                                                                        image-by-id="{{ $list_subworkload->id }}"
                                                                        index-by-image="{{ $index }}"
                                                                        user-id="{{ $list_subworkload->create_by }}">
                                                                        <i class='bx bxs-trash'></i> ลบไฟล์
                                                                    </button>
                                                                @endforeach

                                                                @if (is_array($filePaths))
                                                                    @for ($x = 0; $x <= 4 - count($filePaths); $x++)
                                                                        <div>
                                                                            <input type="hidden"
                                                                                name="main[{{ $list_subworkload->id }}][list_subworkload_id]"
                                                                                value="{{ $list_subworkload->id }}">
                                                                            <input
                                                                                class="form-control form-control-sm formFileSm"
                                                                                name="main[{{ $list_subworkload->id }}][files][]"
                                                                                type="file" multiple
                                                                                style="display:none;"
                                                                                id="file-{{ $list_subworkload->id }}-{{ $x }}"
                                                                                onchange="updateFileName(this, {{ $list_subworkload->id }}, {{ $x }})">

                                                                            <label
                                                                                for="file-{{ $list_subworkload->id }}-{{ $x }}"
                                                                                class="rounded border px-2 py-1"
                                                                                style="cursor:pointer;">
                                                                                <i class='bx bx-link'></i> เลือกไฟล์
                                                                            </label>
                                                                            <span
                                                                                id="file-name-{{ $list_subworkload->id }}-{{ $x }}"
                                                                                class="file-name-display"
                                                                                style="margin-left: 10px;"></span>
                                                                        </div>
                                                                    @endfor
                                                                @else
                                                                    <p>Unable to decode file paths. Please check the
                                                                        format.</p>
                                                                @endif
                                                            @else
                                                                <p>No files found.</p>
                                                            @endif
                                                        @endif
                                                    @endif

                                                </td>


                                                <td class="text-center">
                                                    @if ($list_subworkload->is_child != 1)
                                                        <input type="number"
                                                            name="main[{{ $list_subworkload->id }}][scores]"
                                                            value="{{ number_format($list_subworkload->score, 0) }}"
                                                            min="0"
                                                            class="form-control text-center border-0 bg-white"
                                                            readonly>
                                                    @else
                                                        {{-- <input type="hidden"
                                                            name="scores[{{ $list_subworkload->id }}]" value="0"
                                                            min="0" class="form-control text-center"> --}}
                                                    @endif

                                                </td>
                                                <td class="text-center factor-display"
                                                    id="factor-display-{{ $list_subworkload->id }}">
                                                    @if ($list_subworkload->is_child != 1)
                                                        {{ $list_subworkload->factor }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- </div>
                                    </div>

                                </div> --}}
                        @endforeach

                </div>
                @php
                    $year = request('year', date('Y')); // ถ้าไม่มีค่า year จะใช้ปีปัจจุบัน
                    $times = request('times', 1); // ถ้าไม่มีค่า times จะใช้ค่า 1
                @endphp
                <div class="mt text-center mb-4">
                    <a href="{{ route('workloads.view-report') }}">
                        <x-primary-button type="button" class="btn btn-secondary">ย้อนกลับ</x-primary-button>
                    </a>
                    <x-primary-button type="submit" class="btn btn-primary">บันทึกคะแนน</x-primary-button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Modal โยกภาระงาน -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">โยกย้ายภาระงาน</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">ภาระงานที่โยกย้าย</label>
                        <input type="text" class="form-control modal_subworkload_name" value="" readonly
                            disabled>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">จากอาจารย์</label>
                        <input type="text" class="form-control modal_professor_1" value="{{ $user->name }}"
                            readonly disabled>
                    </div>
                    <div>
                        <label for="" class="form-label">ไปยังอาจารย์ <small class="text-muted">(*
                                กรุณาเลือกอาจารย์)</small></label>
                        <select class="form-select modal_professor_2">
                            <option value="0">เลือก..</option>
                            @foreach ($allUser as $allUsers)
                                <option value="{{ $allUsers->id }}">{{ $allUsers->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                    <button type="button" class="btn btn-primary move-subject">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.factor-select').forEach(function(selectElement) {
                selectElement.addEventListener('change', function() {
                    let selectedOption = selectElement.options[selectElement.selectedIndex];
                    let factor = selectedOption.getAttribute('data-factor');
                    let parentId = selectElement.getAttribute('data-parent-id');
                    let factorDisplay = document.getElementById('factor-display-' + parentId);

                    if (factorDisplay) {
                        factorDisplay.innerText = factor ? factor : '';
                    }
                });
            });
        });

        // Ensure to attach this to the form's submit event
        function updateFileName(input, id_num, inputIndex) {
            const fileInput = input; // รับ input ที่ถูกเปลี่ยน
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes
            const fileNameDisplay = $('#file-name-' + id_num + '-' + inputIndex);
            console.log(id_num, inputIndex)
            // ตรวจสอบว่า fileInput มีไฟล์หรือไม่
            if (fileInput.files.length > 0) {
                let validFiles = [];
                let fileNames = [];

                for (let i = 0; i < fileInput.files.length; i++) {
                    const file = fileInput.files[i];

                    if (file.size > maxSize) {
                        alert(`File "${file.name}" size must be less than 2MB.`);
                        $(fileInput).val(''); // Clear input
                        fileNames = [];
                        break;
                    }

                    validFiles.push(file);
                    fileNames.push(file.name);
                }

                // แสดงชื่อไฟล์
                fileNameDisplay.text(fileNames.join(', ')); // แสดงชื่อไฟล์
            } else {
                // หากไม่มีไฟล์ ให้ล้างชื่อไฟล์ที่แสดง
                fileNameDisplay.text('');
            }

            return true; // อนุญาตให้ส่งฟอร์ม
        }


        $(document).ready(function() {


            let parentIdFirst = 1
            // $('.add-new-subject').on('click', function(e) {
            $(document).on('click', '.add-new-subject', function(e) {
                let sort_order = $(this).attr('sort_order')
                let subworkload_id = $(this).attr('subworkload_id')
                let list_id = $(this).attr('list_id')
                e.preventDefault();
                console.log(parentIdFirst)
                parentIdFirst++
                var newRow = `
        <div class="row-per-subject">
            <div class="row">
                <div class="col-5">
                    <label class="form-label">ชื่อภาระงาน</label>
                    <input type="text" class="form-control subject-name" name="subjects[${parentIdFirst}][name]" placeholder="ชื่อภาระงาน" required>
                </div>
                <div class="col-2">
                    <label class="form-label">จำนวน</label>
                    <input type="text" class="form-control subject-score" name="subjects[${parentIdFirst}][score]" min="0" placeholder="จำนวน" required>
                </div>
                <div class="col-2">
                    <label class="form-label">ภาระงาน</label>
                    <input type="text" class="form-control subject-score" name="subjects[${parentIdFirst}][factor]" min="0" placeholder="ภาระงาน" required>
                    <input type="hidden" class="form-control sort_order" name="subjects[${parentIdFirst}][sort_order]" value="${sort_order}">
                    <input type="hidden" class="form-control subworkload_id" name="subjects[${parentIdFirst}][subworkload_id]" value="${subworkload_id}">
                    <input type="hidden" class="form-control list_id" name="subjects[${parentIdFirst}][list_id]" value="${list_id}">
                </div>
                <div class="col-2">
<label class="form-label">&nbsp;</label>

<div>
    <input class="form-control form-control-sm formFileSm"
           name="subjects[${parentIdFirst}][files][]" type="file" multiple style="display:none;"
           id="file-${parentIdFirst}-1" onchange="updateFileName(this, ${parentIdFirst}, 1)">
    <label for="file-${parentIdFirst}-1" class="rounded border px-2 py-1" style="cursor:pointer;">
        <i class='bx bx-link'></i> เลือกไฟล์
    </label>
    <span id="file-name-${parentIdFirst}-1" class="file-name-display" style="margin-left: 10px;"></span>
</div>
<div>
    <input class="form-control form-control-sm formFileSm"
           name="subjects[${parentIdFirst}][files][]" type="file" multiple style="display:none;"
           id="file-${parentIdFirst}-2" onchange="updateFileName(this, ${parentIdFirst}, 2)">
    <label for="file-${parentIdFirst}-2" class="rounded border px-2 py-1" style="cursor:pointer;">
        <i class='bx bx-link'></i> เลือกไฟล์
    </label>
    <span id="file-name-${parentIdFirst}-2" class="file-name-display" style="margin-left: 10px;"></span>
</div>
<div>
    <input class="form-control form-control-sm formFileSm"
           name="subjects[${parentIdFirst}][files][]" type="file" multiple style="display:none;"
           id="file-${parentIdFirst}-3" onchange="updateFileName(this, ${parentIdFirst}, 3)">
    <label for="file-${parentIdFirst}-3" class="rounded border px-2 py-1" style="cursor:pointer;">
        <i class='bx bx-link'></i> เลือกไฟล์
    </label>
    <span id="file-name-${parentIdFirst}-3" class="file-name-display" style="margin-left: 10px;"></span>
</div>
<div>
    <input class="form-control form-control-sm formFileSm"
           name="subjects[${parentIdFirst}][files][]" type="file" multiple style="display:none;"
           id="file-${parentIdFirst}-4" onchange="updateFileName(this, ${parentIdFirst}, 4)">
    <label for="file-${parentIdFirst}-4" class="rounded border px-2 py-1" style="cursor:pointer;">
        <i class='bx bx-link'></i> เลือกไฟล์
    </label>
    <span id="file-name-${parentIdFirst}-4" class="file-name-display" style="margin-left: 10px;"></span>
</div>
<div>
    <input class="form-control form-control-sm formFileSm"
           name="subjects[${parentIdFirst}][files][]" type="file" multiple style="display:none;"
           id="file-${parentIdFirst}-5" onchange="updateFileName(this, ${parentIdFirst}, 5)">
    <label for="file-${parentIdFirst}-5" class="rounded border px-2 py-1" style="cursor:pointer;">
        <i class='bx bx-link'></i> เลือกไฟล์
    </label>
    <span id="file-name-${parentIdFirst}-5" class="file-name-display" style="margin-left: 10px;"></span>
</div>

            </div>
                <div class="col-1"><label class="form-label">&nbsp;</label><btn class="btn btn-outline-danger py-1 px-2 removerow"><i class='bx bxs-trash' ></i></btn></div>
            </div>
            <br>
        </div>
    `;
                $(this).closest('.m-3').append(newRow);
            });

            $(document).on('click', '.removerow', function() {
                $(this).closest('.row-per-subject').remove();
            })

            $('.remove-image').on('click', function() {
                const subworkloadId = $(this).attr('image-by-id');
                const userid = $(this).attr('user-id');
                const index = $(this).attr('index-by-image');

                axios.delete(`/images/${subworkloadId}/${userid}/${index}`, {
                        data: {
                            id: subworkloadId
                        } // สำหรับ Axios, ข้อมูลจะถูกส่งใน `data` ของการเรียก DELETE
                    })
                    .then(function(response) {
                        alert('ไฟล์ถูกลบเรียบร้อยแล้ว');
                        location.reload(); // อัปเดตหน้าใหม่
                    })
                    .catch(function(error) {
                        alert('เกิดข้อผิดพลาด: ' + error.response.data);
                    });
            });

            let move_subworkloadId
            let move_userid
            let move_subworkload_name
            $('.modal-move-subjects').on('click', function() {
                move_subworkloadId = $(this).attr('subworkload_id');
                move_userid = $(this).attr('user_id');
                move_subworkload_name = $(this).attr('subworkload_name');

                $('.modal_subworkload_name').val(move_subworkload_name)
            });
            $('.move-subject').on('click', function() {
                let modal_move_professor_2 = $('.modal_professor_2').val();
                if (modal_move_professor_2 == 0) {
                    alert('กรุณาเลือกอาจารย์')
                    return
                }
                console.log(modal_move_professor_2)
                axios.put(
                        `/move-subject/${move_subworkloadId}/${move_userid}/${modal_move_professor_2}`
                    ) //ID ที่โยก , เจ้าของภาระงาน , ID User ปลายทางที่รับภาระงาน
                    .then(function(response) {
                        location.reload(); // อัปเดตหน้าใหม่
                    })
                    .catch(function(error) {
                        alert('เกิดข้อผิดพลาด: ' + error.response.data);
                    });
            });


        });
    </script>
</x-app-layout>
