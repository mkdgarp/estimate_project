<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ภาระงาน') }}
        </h2>
    </x-slot>
{{-- {{dd($hierarchicalData)}} --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ $user }} --}}
                    <table class="table table-bordered">
                        <thead>
                            {{-- <tr>
                                <td style="border-right: 0"></td>
                                <th style="border-left: 0" colspan="2">ชื่อ</th>
                            </tr> --}}
                        </thead>
                        <tbody>
                            @foreach ($user as $index => $users)
                                <tr >
                                    <td class="bg-secondary-subtle" style="border-right: 0"></td>
                                    <td class="bg-secondary-subtle" style="border-left: 0" colspan="4">
                                        <h5><b>{{ $users->name }}</b></h5>
                                    </td>
                                </tr>
                                @foreach ($workloads as $workload)
                                {{ $workload->totalScore }}
                                    <tr>
                                        <td>{{ $workload->id }}</td>
                                        <td>{{ $workload->name }}</td>
                                        <td>
                                            <a href="../manage-subworkload-list-by-id/{{$users->id}}/{{$workload->id}}"
                                                class="btn btn-warning w-100">แก้ไขข้อมูล</a>
                                        </td>
                                        <td>
                                            <a href="../view-report-by-id/{{$users->id}}/{{$workload->id}}"
                                                class="btn btn-secondary w-100">รายงานสรุป</a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="text-white"><td style="border-right: 0;border-left: 0;" class="text-white">xxxxxxx<br></td></tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
