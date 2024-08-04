<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Models\ListSubworkload;

class SubworkloadController extends Controller
{
    // public function updateScores(Request $request)
    // {
    //     $userId = auth()->id();
    //     $workloadId = $request->input('workload_id');
    //     $scores = $request->input('scores');

    //     // อัพเดตคะแนนสำหรับแต่ละ subworkload
    //     foreach ($scores as $subworkloadId => $score) {
    //         $score = (float) $score;
    //         $existingScore = Score::where('user_id', $userId)
    //             ->where('subworkload_id', $subworkloadId)
    //             ->first();

    //         if ($existingScore) {
    //             $existingScore->score = $score;
    //             $existingScore->save();
    //         } else {
    //             Score::create([
    //                 'user_id' => $userId,
    //                 'subworkload_id' => $subworkloadId,
    //                 'score' => $score,
    //             ]);
    //         }
    //     }

    //     return redirect()->route('workloads.show', $workloadId)->with('success', 'คะแนนได้ถูกอัพเดตแล้ว');
    // }

    public function updateScores(Request $request)
    {
        $userId = auth()->id();
        $workloadId = $request->input('workload_id');
        $scores = $request->input('scores');

        // Update or create scores for each subworkload
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

            // Calculate and update scores for list_subworkloads
            $listSubworkloads = ListSubworkload::where('subworkload_id', $subworkloadId)->get();
            foreach ($listSubworkloads as $listSubworkload) {
                $totalScore = $score * $listSubworkload->factor;

                // Update or create score for list_subworkloads
                $existingTotalScore = Score::where('user_id', $userId)
                    ->where('subworkload_id', $listSubworkload->id)
                    ->first();

                if ($existingTotalScore) {
                    $existingTotalScore->score = (float) $totalScore; // Ensure score is a float
                    $existingTotalScore->save();
                } else {
                    Score::create([
                        'user_id' => $userId,
                        'subworkload_id' => $listSubworkload->id,
                        'score' => (float) $totalScore, // Ensure score is a float
                    ]);
                }
            }
        }

        return redirect()->route('workloads.show', $workloadId)->with('success', 'Scores have been updated successfully.');
    }
}
