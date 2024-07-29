<?php

namespace App\Http\Controllers;

use App\Models\Workload;
use App\Models\SubWorkload;
use App\Models\Score;
use Illuminate\Http\Request;

class WorkloadController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // ดึงข้อมูลทั้งหมด
        $workloads = Workload::all();
        $subworkloads = Subworkload::all();
        $scores = Score::where('user_id', $userId)->get();

        // สร้างการรวมข้อมูลแบบ join ด้วย PHP
        foreach ($workloads as $workload) {
            // ดึง Subworkload ที่เกี่ยวข้อง
            $workload->subworkloads = $subworkloads->where('workload_id', $workload->id);

            // กำหนดค่าเริ่มต้นเป็น 0
            $workload->totalScore = 0;

            // คำนวณคะแนนรวมของแต่ละ Subworkload
            foreach ($workload->subworkloads as $subworkload) {
                // ดึงคะแนนที่เกี่ยวข้องกับ Subworkload
                $subworkloadScores = $scores->where('subworkload_id', $subworkload->id);

                // คำนวณคะแนนรวมของ Subworkload
                $subworkload->score = $subworkloadScores->sum('score') ?: 0; // คะแนนรวมของ Subworkload

                // เพิ่มคะแนนรวมให้กับ Workload
                $workload->totalScore += $subworkload->score;
            }
        }

        // คำนวณคะแนนรวมทั้งหมดของ Workload
        $totalScore = $workloads->sum('totalScore');

        return view('workload-list', compact('workloads', 'totalScore'));
    }

    public function show($id)
    {
        $userId = auth()->id();

        $workload = Workload::findOrFail($id);
        $subworkloads = Subworkload::where('workload_id', $id)->get();
        $scores = Score::where('user_id', $userId)
            ->whereIn('subworkload_id', $subworkloads->pluck('id'))
            ->get();

        foreach ($subworkloads as $subworkload) {
            $subworkload->score = $scores->where('subworkload_id', $subworkload->id)->sum('score') ?: 0;
        }

        $totalScore = $subworkloads->sum('score');

        return view('subworkload-list', compact('workload', 'subworkloads', 'totalScore'));
    }
}
