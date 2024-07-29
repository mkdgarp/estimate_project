<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $workload->name }}
        </h2>
    </x-slot>

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
                    <form method="POST" action="{{ route('subworkloads.updateScores') }}">
                        @csrf
                        <input type="hidden" name="workload_id" value="{{ $workload->id }}">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ภาระงานย่อย</th>
                                    <th>จำนวน</th>
                                    <th width='100px'>คะแนน</th>
                                    <td>หมายเหตุ</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subworkloads as $index => $subworkload)
                                    <tr>
                                        <td>{{ $subworkload->name }}</td>
                                        <td>{{ $index +1 }}</td>
                                        <td>
                                            <input type="number" name="scores[{{ $subworkload->id }}]"
                                                value="{{ $subworkload->score }}" min="0" class="form-control">
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                {{-- <tr>
                                    <td colspan="1">ผลรวม</td>
                                    <td colspan="2">{{ $totalScore }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                        <div class="mt-4 text-center">
                            <x-primary-button type="submit" class="btn btn-primary">บันทึกคะแนน</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
