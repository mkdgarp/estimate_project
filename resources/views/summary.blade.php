<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $workload->name }}
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
                    <div class="row">
                        <div class="col">
                            <h3 class="text-lg font-semibold mb-4">{{ $workload->name }}</h3>
                        </div>
                        <div class="col-3 text-end">
                            <button class="btn btn-primary text-end" onclick="printDiv()"><i
                                    class='bx bxs-printer'></i>&nbsp;พิมพ์เอกสาร</button>
                        </div>
                    </div>
                    <form id="formPrint">
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
                            <table class="table table-bordered border-right">
                                <thead>
                                    <tr>
                                        <th class="thmain text-center">(๑)<br>ภาระงาน/กิจกรรม/โครงการ/งาน</th>
                                        <th class="text-center" width='120px'>(๒)<br>หลักฐาน</th>
                                        <th class="text-center" width='80px'>(๓)<br>จำนวน</th>
                                        <th class="text-center" width='80px'>(๔)<br>ภาระงาน</th>
                                        <th class="text-center" width='80px'>(๕)<br>รวมภาระงาน<br>(๓ x ๔)</th>
                                        <th class="text-center" width='40px'>หมายเหตุ</th>
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
                                                        <div class="w-100 d-flex">
                                                            <p class="ps-4 pb-0 mb-0">
                                                                -&nbsp;&nbsp;{{ $list_subworkload->name }}</p>

                                                        </div>
                                                    @endif


                                                </td>
                                                <td width='120px' class="text-center">
                                                    @if ($list_subworkload->file_path == '')
                                                        <small class="text-muted text-none-onprint"></small>
                                                    @else
                                                        @php
                                                            // Get the file extension
                                                            $fileExtension = strtolower(
                                                                pathinfo(
                                                                    $list_subworkload->file_path,
                                                                    PATHINFO_EXTENSION,
                                                                ),
                                                            );
                                                        @endphp

                                                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
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
                                                        @endif
                                                    @endif


                                                </td>
                                                <td class="text-center">
                                                    @if ($list_subworkload->is_child == 0)
                                                        <input type="number"
                                                            name="scores[{{ $list_subworkload->id }}]"
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
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                @if ($index === count($hierarchicalData) - 1)
                                    <!-- เช็คว่าคือรอบสุดท้าย -->
                                    <tfoot>
                                        <tr style="border-bottom: none;">
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                            <td colspan="2" style="border-bottom: 1px solid #dee2e6;"><b>รวม</b></td>
                                            <td style="border-bottom: 1px solid #dee2e6;">{{ $finalScore }}</td>
                                            <td style="border: none;"></td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                            {{-- </div>
                                    </div>

                                </div> --}}
                            {{-- {{$index}} -- {{count($hierarchicalData)}} --}}
                        @endforeach



                </div>

                </form>

                <div class="mt text-center mb-4">
                    <a href="{{ route('workloads.show', $workload->id) }}">
                        <x-primary-button type="button" class="btn btn-warning">แก้ไขข้อมูล</x-primary-button>
                    </a>
                    <a href="{{ route('workload') }}">
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

        // function printDiv() {
        //     var printContent = document.getElementById('formPrint').innerHTML;
        //     var printWindow = window.open('', '', 'height=800,width=600');

        //     // Construct the content for the print window
        //     printWindow.document.write('<html><head><title>Print</title>');
        //     printWindow.document.write(
        //     '<link rel="stylesheet" href="path_to_your_stylesheet.css">'); // Optional: Add your CSS file
        //     printWindow.document.write('</head><body>');
        //     printWindow.document.write(printContent);
        //     printWindow.document.write('</body></html>');

        //     printWindow.document.close();
        //     printWindow.focus();

        //     // Print the content and close the print window afterward
        //     printWindow.print();
        //     printWindow.close();
        // }
    </script>
</x-app-layout>
