<x-app-layout>
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="thmain">ภาระงานย่อย</th>
                                        <th width='120px'>หลักฐาน</th>
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
                                                    {{ $list_subworkload->name }}
                                                    @if ($list_subworkload->is_child == 1)
                                                        {{-- <br> --}}
                                                        {{-- <div class="m-3">
                                                            <select class="form-select factor-select bg-white border-0"
                                                                name="scores[{{ $list_subworkload->id }}]"
                                                                id="select-{{ $list_subworkload->id }}"
                                                                data-parent-id="{{ $list_subworkload->id }}" disabled>
                                                                <option value="0">
                                                                    เลือกจำนวนนักศึกษา
                                                                </option>
                                                                @foreach ($subworkload['list_subworkloads'] as $index_select => $select_workload)
                                                                    @if ($select_workload->list_subworkloads_child_id != null && $select_workload->list_subworkloads_child_id == $list_subworkload->id)
                                                                        <option value="1"
                                                                            data-factor="{{ $select_workload->factor }}">
                                                                            {{ $select_workload->name }}
                                                                        </option>
                                                                        {{ $select_workload->name }}
                                                                    @endif
                                                                    
                                                                @endforeach
                                                            </select>
                                                        </div> --}}
                                                    @endif
                                                </td>
                                                <td width='120px'>
                                                    @if ($list_subworkload->file_path == '')
                                                        <small class="text-muted text-none-onprint"></small>
                                                    @else
                                                        <a href="{{ url('storage/' . $list_subworkload->file_path) }}"
                                                            target="_blank">
                                                            <embed type="image/jpg"
                                                                src="{{ asset('storage/' . $list_subworkload->file_path) }}"
                                                                width="100" height="120">
                                                        </a>
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
                                                            class="form-control text-center bg-white border-0" disabled>
                                                    @endif
                                                </td>
                                                <td class="text-center factor-display"
                                                    id="factor-display-{{ $list_subworkload->id }}">
                                                    {{ $list_subworkload->factor }}
                                                </td>
                                                <td class="text-center factor-display"
                                                    id="factor-display-{{ $list_subworkload->id }}">
                                                    {{ number_format($list_subworkload->factor * $list_subworkload->score, 2) }}
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
                    window.location.href = "../workload"; // Change to your desired URL
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

            }, 200);

            window.onafterprint = function() {
                window.location.href = "../workload"; // Change to your desired URL
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
