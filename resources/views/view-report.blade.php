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



    {{-- {{dd($hierarchicalData)}} --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ $user }} --}}
                    <div class="text-end">
                        <div class="autoComplete_wrapper text-end">
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
                                                <div class="ms-auto"> <a href="../print-all-workload-superadmin/{{ $users->id }}">
                                                        <button class="btn btn-primary"><i
                                                                class='bx bxs-printer'></i>&nbsp;พิมพ์เอกสารทั้งหมด</button>
                                                    </a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach ($workloads as $workload)
                                        <tr class="tr-main tr-show-{{ $users->id }}">
                                            <td>{{ $workload->id }}</td>
                                            <td>{{ $workload->name }}</td>
                                            <td>
                                                <a href="../manage-subworkload-list-by-id/{{ $users->id }}/{{ $workload->id }}"
                                                    class="btn btn-warning w-100">แก้ไขข้อมูล</a>
                                            </td>
                                            <td>
                                                <a href="../view-report-by-id/{{ $users->id }}/{{ $workload->id }}"
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
                                                <a href="../staff-manage-subworkload-list-by-id/{{ $users->id }}/{{ $workload->id }}"
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
    </script>
</x-app-layout>
