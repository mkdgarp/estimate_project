<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class SubworkloadController extends Controller
{
    public function updateScores(Request $request)
    {
        $userId = auth()->id();
        $workloadId = $request->input('workload_id');
        $scores = $request->input('scores');

        // อัพเดตคะแนนสำหรับแต่ละ subworkload
        foreach ($scores as $subworkloadId => $score) {
            $score = (float) $score;
            $existingScore = Score::where('user_id', $userId)
                ->where('subworkload_id', $subworkloadId)
                ->first();

            if ($existingScore) {
                $existingScore->score = $score;
                $existingScore->save();
            } else {
                Score::create([
                    'user_id' => $userId,
                    'subworkload_id' => $subworkloadId,
                    'score' => $score,
                ]);
            }
        }

        return redirect()->route('workloads.show', $workloadId)->with('success', 'คะแนนได้ถูกอัพเดตแล้ว');
    }
}