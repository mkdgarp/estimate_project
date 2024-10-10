<x-app-layout>
    <style>
        @media print {
            .pagebreak {
                page-break-before: always;
                clear: both;
            }

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
                page-break-before: always !important;
                page-break-after: always !important;
                page-break-inside: avoid !important;
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
            border-collapse: collapse !important;
        }

        table td,
        table th {
            border-right: none !important;
            /* Remove right border */
            border-left: none !important;
            /* Remove left border */
        }

        table td {
            border-right: 1px solid black !important;
        }

        @media print {
            table {
                border-collapse: collapse !important;
            }

            table td,
            table th {
                border-right: none !important;
                /* Remove right border */
                border-left: none !important;
                /* Remove left border */
                border-top: 1px solid black !important;
                /* Optional: Set top border */
                border-bottom: 1px solid black !important;
                /* Optional: Set bottom border */
            }

            /* Optional: Remove table's outer border */
            table {
                border: none !important;
            }
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
                            <h3 class="text-lg font-semibold mb-4"></h3>
                        </div>
                        <div class="col-3 text-end">
                            <button class="btn btn-primary text-end autoprint"><i
                                    class='bx bxs-printer'></i>&nbsp;พิมพ์เอกสาร</button>
                        </div>
                    </div>
                    <form id="formPrint">
                        @csrf




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
                                        <th class="text-center" width='200px'>(๒)<br>หลักฐาน</th>
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
                                {{-- {{ $index }} -- {{ count($hierarchicalData) }} --}}
                                @if ($index === 5)
                                    <!-- เช็คว่าคือรอบสุดท้าย -->
                                    <tfoot>
                                        <tr style="border-bottom: none;">
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                            <td colspan="2" style="border-bottom: 1px solid #dee2e6;"><b>รวม</b></td>
                                            <td style="border-bottom: 1px solid #dee2e6;">{{ $total_1 }}</td>
                                            <td style="border: none;"></td>
                                        </tr>
                                    </tfoot>
                                @endif
                                @if ($index === 11)
                                    <!-- เช็คว่าคือรอบสุดท้าย -->
                                    <tfoot>
                                        <tr style="border-bottom: none;">
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                            <td colspan="2" style="border-bottom: 1px solid #dee2e6;"><b>รวม</b></td>
                                            <td style="border-bottom: 1px solid #dee2e6;">{{ $total_2 }}</td>
                                            <td style="border: none;"></td>
                                        </tr>
                                    </tfoot>
                                @endif
                                @if ($index === 16)
                                    <!-- เช็คว่าคือรอบสุดท้าย -->
                                    <tfoot>
                                        <tr style="border-bottom: none;">
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                            <td colspan="2" style="border-bottom: 1px solid #dee2e6;"><b>รวม</b></td>
                                            <td style="border-bottom: 1px solid #dee2e6;">{{ $total_3 }}</td>
                                            <td style="border: none;"></td>
                                        </tr>
                                    </tfoot>
                                @endif
                                @if ($index === 18)
                                    <!-- เช็คว่าคือรอบสุดท้าย -->
                                    <tfoot>
                                        <tr style="border-bottom: none;">
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                            <td colspan="2" style="border-bottom: 1px solid #dee2e6;"><b>รวม</b></td>
                                            <td style="border-bottom: 1px solid #dee2e6;">{{ $total_4 }}</td>
                                            <td style="border: none;"></td>
                                        </tr>
                                    </tfoot>
                                @endif
                                @if ($index === 19)
                                    <!-- เช็คว่าคือรอบสุดท้าย -->
                                    <tfoot>
                                        <tr style="border-bottom: none;">
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                            <td colspan="2" style="border-bottom: 1px solid #dee2e6;"><b>รวม</b></td>
                                            <td style="border-bottom: 1px solid #dee2e6;">{{ $total_5 }}</td>
                                            <td style="border: none;"></td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                            {{-- </div>
                                    </div>

                                </div> --}}
                        @endforeach
                        <div class="page-break pagebreak"></div>
                        <p>ส่วนที่ ๑ องค์ประกอบที่ ๑ ผลสัมฤทธิ์ของงาน</p>
                        <table class="table table-bordered border-right">
                            <thead class="text-center">
                                <tr>
                                    <th>(๑) ภาระงาน/กิจกรรม/โครงการ/งาน</th>
                                    <th>รวยภาระงาน</th>
                                    <th width="40px">หมายเหตุ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <b><u>๑. ภาระงานสอน (ภาระงานขั้นต่ำ)</u></b><br>
                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 1 ? 'checked' : '' }}>กลุ่มทั่วไป
                                            ๑๕
                                            ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 2 ? 'checked' : '' }}>กลุ่มเน้นสอน
                                            ๒๐
                                            ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 3 ? 'checked' : '' }}>กลุ่มเน้นวิจัย
                                            ๙
                                            ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 4 ? 'checked' : '' }}>กลุ่มเน้นบริการวิชาการ
                                            ๙ ภาระงาน/สัปดาห์</div>

                                    </td>
                                    <td class="text-center">{{ $total_1 }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b><u>๒. ภาระงานวิจัยและงานวิชาการอื่นที่ปรากฏเป็นผลงานวิชาการตามหลักเกณฑ์ที่
                                                ก.พ.อ กำหนด</u></b><br>
                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 1 ? 'checked' : '' }}>กลุ่มทั่วไป
                                            ๖
                                            ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 2 ? 'checked' : '' }}>กลุ่มเน้นสอน
                                            ๖
                                            ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 3 ? 'checked' : '' }}>กลุ่มเน้นวิจัย
                                            ๒๑ ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 4 ? 'checked' : '' }}>กลุ่มเน้นบริการวิชาการ
                                            ๖ ภาระงาน/สัปดาห์</div>

                                    </td>
                                    <td class="text-center">{{ $total_2 }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b><u>๓. ภาระงานบริการทางวิชาการ</u></b><br>
                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 1 ? 'checked' : '' }}>กลุ่มทั่วไป
                                            ๕
                                            ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 2 ? 'checked' : '' }}>กลุ่มเน้นสอน
                                            ๓
                                            ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 3 ? 'checked' : '' }}>กลุ่มเน้นวิจัย
                                            ๒ ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 4 ? 'checked' : '' }}>กลุ่มเน้นบริการวิชาการ
                                            ๑๗ ภาระงาน/สัปดาห์</div>

                                    </td>
                                    <td class="text-center">{{ $total_3 }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b><u>๔. ภาระงานทำนุบำรุงศิลปวัฒธรรม</u></b><br>
                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 1 ? 'checked' : '' }}>กลุ่มทั่วไป
                                            ๓
                                            ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 2 ? 'checked' : '' }}>กลุ่มเน้นสอน
                                            ๓
                                            ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 3 ? 'checked' : '' }}>กลุ่มเน้นวิจัย
                                            ๒ ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 4 ? 'checked' : '' }}>กลุ่มเน้นบริการวิชาการ
                                            ๒ ภาระงาน/สัปดาห์</div>

                                    </td>
                                    <td class="text-center">{{ $total_4 }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b><u>๕. ภาระงานอื่น ๆ ที่สอดคล้องกับพันธกิจของคณะ มหาวิทยาลัย</u></b><br>
                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 1 ? 'checked' : '' }}>กลุ่มทั่วไป
                                            ๖
                                            ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 2 ? 'checked' : '' }}>กลุ่มเน้นสอน
                                            ๓
                                            ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 3 ? 'checked' : '' }}>กลุ่มเน้นวิจัย
                                            ๑ ภาระงาน/สัปดาห์</div>

                                        <div class="mb-2"><input class="ms-4 me-2 " type="checkbox"
                                                {{ request('professor_group') == 4 ? 'checked' : '' }}>กลุ่มเน้นบริการวิชาการ
                                            ๑ ภาระงาน/สัปดาห์</div>

                                    </td>
                                    <td class="text-center">{{ $total_5 }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b><u>๖. ภาระงานด้านบริหารทดแทนภาระงาน</u></b>

                                    </td>
                                    <td class="text-center">{{ $total_6 }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b><u>๗. ภาระงานที่ได้รับการแต่งตั้งให้ดำรงตำแหน่งและงานที่ได้รับมอบหมายอื่น
                                                ๆ</u></b>

                                    </td>
                                    <td class="text-center">{{ $total_7 }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end" style="border-bottom: 1px solid #dee2e6;"><b>(๖) รวม</b></td>
                                    <td class="text-center" style="border-bottom: 1px solid #dee2e6;">
                                        {{ $total_subjects }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        {{-- </div> --}}



                    </form>

                    <div class="mt text-center mb-4">
                        {{-- <a href="{{ route('workloads.show', $workload->id) }}">
                        <x-primary-button type="button" class="btn btn-warning">แก้ไขข้อมูล</x-primary-button>
                    </a> --}}
                        {{-- <a href="{{ route('workload') }}">
                        <x-primary-button type="button" class="btn btn-success">ยืนยัน</x-primary-button>
                    </a> --}}
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



        $(document).ready(function() {
            $(document).on('click', '.autoprint', function() {
                var printContent = document.getElementById('formPrint').innerHTML;
                var originalContent = document.body.innerHTML;

                document.body.innerHTML = printContent;

                // Automatically open the print dialog
                window.print();

                // Restore the original content after printing
                document.body.innerHTML = originalContent;

                // Redirect after the print dialog is closed
                window.onafterprint = function() {
                    window.location.href = "../view-report"; // Change to your desired URL
                    // Or refresh the page
                    // window.location.reload();
                };
            })
            setTimeout(function() {
                // Automatically open the print dialog
                $('.autoprint').click()

                // Restore the original content after printing
                document.body.innerHTML = originalContent;

                // Redirect after the print dialog is closed

            }, 250);

            window.onafterprint = function() {
                window.location.href = "../view-report"; // Change to your desired URL
            };
            // $('.autoprint').click()
        })

        // Automatically call printDiv when the page loads




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
