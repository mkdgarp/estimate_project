<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $workload->name }}
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
                                            <tr>
                                                <td>
                                                    {{ $list_subworkload->name }}
                                                    @if ($list_subworkload->is_child == 1)
                                                        {{-- <div class="form-check ps-5 pt-3">
                                                            @foreach ($subworkload['list_subworkloads'] as $index_select => $select_workload)
                                                                @if ($select_workload->list_subworkloads_child_id != null && $select_workload->list_subworkloads_child_id == $list_subworkload->id)
                                                                    <div class="py-2">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="flexRadioDefault"
                                                                            id="flexRadioDefault{{ $index_select }}"
                                                                            value="{{ $select_workload->id }}"
                                                                            data-factor="{{ $select_workload->factor }}">
                                                                        <label class="form-check-label"
                                                                            for="flexRadioDefault{{ $index_select }}">
                                                                            {{ $select_workload->name }}
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div> --}}
                                                        <br>
                                                        <div class="m-3">
                                                            <select class="form-select factor-select"
                                                                name="scores[{{ $list_subworkload->id }}]"
                                                                id="select-{{ $list_subworkload->id }}"
                                                                data-parent-id="{{ $list_subworkload->id }}">
                                                                <option value="0"
                                                                    {{ old('scores.' . $list_subworkload->id, $list_subworkload->score) == 0 ? 'selected' : '' }}>
                                                                    เลือกจำนวนนักศึกษา
                                                                </option>
                                                                @foreach ($subworkload['list_subworkloads'] as $index_select => $select_workload)
                                                                    @if (
                                                                        $select_workload->list_subworkloads_child_id != null &&
                                                                            $select_workload->list_subworkloads_child_id == $list_subworkload->id)
                                                                        <option value="{{ $select_workload->id }}"
                                                                            data-factor="{{ $select_workload->factor }}"
                                                                            {{ old('scores.' . $list_subworkload->id, $list_subworkload->score) == $select_workload->id || $list_subworkload->score == $select_workload->id ? 'selected' : '' }}>
                                                                            {{ $select_workload->name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td style="width:190px;">
                                                    @if ($list_subworkload->file_path == '')
                                                        <input class="form-control form-control-sm formFileSm"
                                                            name="files[{{ $list_subworkload->id }}]" type="file">

                                                        {{-- id={{$list_subworkload->id}} --}}
                                                    @else
                                                        {{-- <input class="form-control form-control-sm formFileSm"
                                                            name="files[{{ $list_subworkload->id }}]" type="file"><br> --}}
                                                        <a href="{{ url('storage/' . $list_subworkload->file_path) }}"
                                                            target="_blank">
                                                            <embed type="image/jpg"
                                                                src="{{ url('storage/' . $list_subworkload->file_path) }}"
                                                                width="100" height="120">
                                                        </a>

                                                        {{-- http://127.0.0.1:8000/storage/uploads/3/9Frrii9q29lHKbLcdM7M5CTm9whfUql5H1ukL2Em.jpg --}}
                                                    @endif

                                                </td>


                                                <td class="text-center">
                                                    @if ($list_subworkload->is_child == 0)
                                                        <input type="number"
                                                            name="scores[{{ $list_subworkload->id }}]"
                                                            value="{{ number_format($list_subworkload->score, 0) }}"
                                                            min="0" class="form-control text-center">
                                                    @else
                                                        1
                                                    @endif
                                                </td>
                                                <td class="text-center factor-display"
                                                    id="factor-display-{{ $list_subworkload->id }}">
                                                    {{ $list_subworkload->factor }}
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
        });
    </script>
</x-app-layout>
