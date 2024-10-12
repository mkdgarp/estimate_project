<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('สรุปภาระงานสอนของ: ') . $user->name }} <!-- ใช้ชื่อผู้ใช้ -->
        </h2>
    </x-slot>
    <style>
        @media print {

            /* Ensure the page is A4 */
            @page {
                size: A4;
                margin: 20mm;
            }

            /* Style the printable content */
            #formPrint {
                width: 100%;
                margin: 0 auto;
                padding: 10mm;
                box-sizing: border-box;
            }

            /* Avoid breaking elements inside */
            #formPrint>* {
                page-break-inside: avoid;
            }

            /* Force page breaks automatically when content exceeds one page */
            .page-break {
                page-break-before: always;
            }

            /* Hide elements with .text-none-onprint */
            .text-none-onprint {
                display: none !important;
            }

            /* Remove vertical borders */
            table {
                border-collapse: collapse !important;
            }

            table td,
            table th {
                border-right: none !important;
                /* Remove right border */
                border-left: none !important;
                /* Remove left border */
            }
        }

        /* Remove vertical borders */
        table {
            border-collapse: collapse;
        }

        table td,
        table th {
            border-right: none !important;
            /* Remove right border */
            border-left: none !important;
            /* Remove left border */
        }
    </style>
    {{-- <p>Total Score: {{ $totalScore }}</p> --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h3 class="text-lg font-semibold mb-4">{{ $workload->name }}</h3>
                    <form>
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
                                        <th width='35%' class="thmain">ภาระงานย่อย</th>
                                        <th width='35%'>หลักฐาน</th>
                                        <th class="text-center" width='80px'>จำนวน</th>
                                        <th class="text-center" width='80px'>ภาระงาน</th>
                                        <th class="text-center" width='80px'>รวม</th>
                                        {{-- <th class="text-center" width='150px'>รวมภาระงาน</th> --}}

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subworkload['list_subworkloads'] as $index_list => $list_subworkload)
                                        @if ($list_subworkload->list_subworkloads_child_id == null)
                                            <tr>
                                                <td>

                                                    @if ($list_subworkload->is_child == 1)
                                                        {{ $list_subworkload->name }}
                                                    @else
                                                        {{-- <div class="w-100 d-flex">
                                                            <p class="ps-4 pb-0 mb-0">
                                                                -&nbsp;&nbsp;{{ $list_subworkload->name }}</p>

                                                        </div> --}}
                                                    @endif


                                                </td>

                                                <td width='120px'>
                                                    @if ($list_subworkload->file_path == '')
                                                        <small class="text-muted text-none-onprint"></small>
                                                    @else
                                                        {{-- @php
                                                            // Get the file extension
                                                            $fileExtension = strtolower(
                                                                pathinfo(
                                                                    $list_subworkload->file_path,
                                                                    PATHINFO_EXTENSION,
                                                                ),
                                                            );
                                                        @endphp --}}

                                                        {{-- @if (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                                            <a href="{{ url('storage/' . $list_subworkload->file_path) }}"
                                                                target="_blank">
                                                                <embed type="image/jpg"
                                                                    src="{{ asset('storage/' . $list_subworkload->file_path) }}"
                                                                    width="100" height="120">
                                                            </a>
                                                        @else
                                                            <a class=""
                                                                href="{{ url('storage/' . $list_subworkload->file_path) }}"
                                                                target="_blank">
                                                                <i class='bx bxs-file text-primary'></i>
                                                            </a>
                                                        @endif --}}
                                                    @endif
                                                    @if ($list_subworkload->is_child == 1)
                                                        {{-- {{ $list_subworkload->name }} --}}
                                                    @else
                                                        <div class="w-100 d-flex">
                                                            <p class=" pb-0 mb-0">
                                                                {{ $list_subworkload->name }}</p>

                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($list_subworkload->is_child == 0)
                                                        <input type="number" name="scores[{{ $list_subworkload->id }}]"
                                                            value="{{ number_format($list_subworkload->score, 0) }}"
                                                            min="0"
                                                            class="form-control text-center bg-white border-0" disabled>
                                                    @else
                                                        <input type="number" value="1" min="1"
                                                            class="form-control text-center bg-white border-0 d-none"
                                                            disabled>
                                                    @endif
                                                </td>
                                                <td class="text-center factor-display"
                                                    id="factor-display-{{ $list_subworkload->id }}">
                                                    @if ($list_subworkload->is_child == 0)
                                                        {{ $list_subworkload->factor }}
                                                    @endif
                                                </td>
                                                <td class="text-center factor-display"
                                                    id="factor-display-{{ $list_subworkload->id }}">
                                                    @if ($list_subworkload->is_child == 0)
                                                        {{ number_format($list_subworkload->factor * $list_subworkload->score, 3) }}
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

                </form>
                @php
                    $year = request('year', date('Y')); // ถ้าไม่มีค่า year จะใช้ปีปัจจุบัน
                    $times = request('times', 1); // ถ้าไม่มีค่า times จะใช้ค่า 1
                @endphp
                <div class="mt text-center mb-4">
                    <a href="../../manage-subworkload-list-by-id/{{ $user->id }}/{{ $workload->id }}?year={{ $year }}&times={{ $times }}&professor_group=1">
                        <x-primary-button type="button" class="btn btn-warning">แก้ไขข้อมูล</x-primary-button>
                    </a>
                    <a href="{{ route('workloads.view-report') }}?year={{ $year }}&times={{ $times }}&professor_group=1">
                        <x-primary-button type="button" class="btn btn-success">ยืนยัน</x-primary-button>
                    </a>
                </div>
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

        function printDiv() {
            var printContent = document.getElementById('formPrint').innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;

            window.print();

            document.body.innerHTML = originalContent;
        }
    </script>
</x-app-layout>
