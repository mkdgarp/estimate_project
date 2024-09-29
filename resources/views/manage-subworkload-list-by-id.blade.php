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




                        {{-- @foreach ($hierarchicalData as $data)
                    <pre>{{ $data }}</pre>
                @endforeach  --}}

                        {{-- <div class="accordion " id="accordionPanelsStayOpenExample"> --}}
                        @foreach ($hierarchicalData as $index => $subworkload)
                            {{-- <div class="accordion-item mb-3"> --}}
                            <div class="bg-primary-subtle p-3 rounded-left rounded-right">
                                {{ $subworkload['subworkload']->name }}
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
                                                    @if ($list_subworkload->sort_order != 0 && $list_subworkload->sort_order != 10)
                                                        <p class="ps-4 pb-0 mb-0">
                                                            -&nbsp;&nbsp;{{ $list_subworkload->name }}</p>
                                                    @else
                                                        {{ $list_subworkload->name }}
                                                    @endif
                                                    @if ($list_subworkload->is_child == 1)
                                                        <br>
                                                        <div class="m-3"><button
                                                                class="btn btn-success add-new-subject mb-2">+
                                                                เพิ่มวิชา</button>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td style="width:190px;" class="text-center">
                                                    @if ($list_subworkload->id != 1)
                                                        @if ($list_subworkload->file_path == '')
                                                            <input class="form-control form-control-sm formFileSm"
                                                                name="files[{{ $list_subworkload->id }}]"
                                                                type="file" style="display:none;"
                                                                id="file-{{ $list_subworkload->id }}"
                                                                onchange="updateFileName(this)">
                                                            <label for="file-{{ $list_subworkload->id }}"
                                                                class="rounded border px-2 py-1"
                                                                style="cursor:pointer;">
                                                                <i class='bx bx-link'></i> เลือกไฟล์
                                                            </label>
                                                            <span id="file-name-{{ $list_subworkload->id }}"
                                                                class="file-name-display"
                                                                style="margin-left: 10px;"></span>
                                                        @else
                                                            <a href="{{ url('storage/' . $list_subworkload->file_path) }}"
                                                                target="_blank">
                                                                <embed type="image/jpg"
                                                                    src="{{ url('storage/' . $list_subworkload->file_path) }}"
                                                                    class="mx-auto" width="100" height="120">
                                                            </a><button class="btn btn-outline-danger remove-image"
                                                                type="button"
                                                                image-by-id="{{ $list_subworkload->id }}"
                                                                user-id="{{ $user->id }}"><i
                                                                    class='bx bxs-trash'></i> ลบไฟล์</button>
                                                        @endif
                                                    @endif

                                                </td>


                                                <td class="text-center">
                                                    @if ($list_subworkload->id != 1)
                                                        <input type="number"
                                                            name="scores[{{ $list_subworkload->id }}]"
                                                            value="{{ number_format($list_subworkload->score, 0) }}"
                                                            min="0" class="form-control text-center">
                                                    @endif

                                                </td>
                                                <td class="text-center factor-display"
                                                    id="factor-display-{{ $list_subworkload->id }}">
                                                    @if ($list_subworkload->id != 1)
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
                <div class="mt text-center mb-4">
                    <a href="{{ route('workload') }}">
                        <x-primary-button type="button" class="btn btn-secondary">ย้อนกลับ</x-primary-button>
                    </a>
                    <x-primary-button type="submit" class="btn btn-primary">บันทึกคะแนน</x-primary-button>
                </div>
                </form>
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
        function updateFileName(input) {
            const fileInput = input; // รับ input ที่ถูกเปลี่ยน
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes

            // ตรวจสอบว่า fileInput มีไฟล์หรือไม่
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0]; // รับไฟล์แรก
                if (file.size > maxSize) {
                    alert('File size must be less than 2MB.');

                    // ล้างค่า input file
                    $(fileInput).val(''); // jQuery ล้างค่า input

                    // ล้างชื่อไฟล์ที่แสดง
                    const fileNameDisplay = $(fileInput).next('.file-name-display');
                    fileNameDisplay.text(''); // ล้างชื่อไฟล์

                    return false; // ห้ามส่งฟอร์ม
                }

                // แสดงชื่อไฟล์
                const fileNameDisplay = $('#file-name-' + fileInput.id.split('-')[1]);
                fileNameDisplay.text(file.name); // แสดงชื่อไฟล์
            } else {
                // หากไม่มีไฟล์ ให้ล้างชื่อไฟล์ที่แสดง
                const fileNameDisplay = $('#file-name-' + fileInput.id.split('-')[1]);
                fileNameDisplay.text('');
            }

            return true; // อนุญาตให้ส่งฟอร์ม
        }

        $(document).ready(function() {
            $('.formFileSm').on('change', function(event) {
                const fileInput = $(this)[0]; // Ensure you're selecting the correct input
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes

                // Check if the fileInput exists
                if (!fileInput) {
                    console.error("File input not found!");
                    return true; // Allow submission if input is not found (optional behavior)
                }

                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0]; // Get the first file
                    if (file.size > maxSize) {
                        alert('File size must be less than 2MB.');

                        // Clear the file input
                        $(this).val(''); // jQuery to reset the input

                        return false; // Prevent form submission
                    }
                }

                return true; // Allow form submission
            });

            var parentId = 1
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
                    <input type="number" class="form-control subject-score" name="subjects[${parentIdFirst}][score]" min="0" placeholder="จำนวน" required>
                </div>
                <div class="col-2">
                    <label class="form-label">ภาระงาน</label>
                    <input type="number" class="form-control subject-score" name="subjects[${parentIdFirst}][factor]" min="0" placeholder="ภาระงาน" required>
                    <input type="hidden" class="form-control sort_order" name="subjects[${parentIdFirst}][sort_order]" value="${sort_order}">
                    <input type="hidden" class="form-control subworkload_id" name="subjects[${parentIdFirst}][subworkload_id]" value="${subworkload_id}">
                    <input type="hidden" class="form-control list_id" name="subjects[${parentIdFirst}][list_id]" value="${list_id}">
                </div>
                <div class="col-2">
<label class="form-label">&nbsp;</label>

<input class="form-control form-control-sm formFileSm"
                                name="subjects[${parentIdFirst}][files]" type="file" style="display:none;"
                                id="file-${parentIdFirst}" onchange="updateFileName(this)">
                            <label for="file-${parentIdFirst}" class="rounded border px-2 py-1"
                                style="cursor:pointer;">
                                <i class='bx bx-link'></i> เลือกไฟล์
                            </label>
                            <span id="file-name-${parentIdFirst}" class="file-name-display"
                                style="margin-left: 10px;"></span>

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

                axios.delete(`/images/${subworkloadId}/${userid}`, {
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


        });
    </script>
</x-app-layout>
