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
        $files = $request->file('files'); // Get the files

        // Validate the request
        $request->validate([
            'scores.*' => 'required|numeric',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,xlsx,xls,doc,docx|max:2048',
        ]);

        foreach ($scores as $subworkloadId => $score) {
            $score = (float) $score;
            $existingScore = Score::where('user_id', $userId)
                ->where('subworkload_id', $subworkloadId)
                ->first();

            // Initialize file path
            $filePath = null;

            // Handle the file upload for the current subworkload
            if (isset($files[$subworkloadId]) && $files[$subworkloadId]->isValid()) {
                $filePath = $files[$subworkloadId]->store('uploads'); // Store file and get path
            }

            if ($existingScore) {
                $existingScore->score = $score;
                $existingScore->file_path = $filePath ?: $existingScore->file_path; // Update file path only if a new file was uploaded
                $existingScore->save();
            } else {
                Score::create([
                    'user_id' => $userId,
                    'subworkload_id' => $subworkloadId,
                    'score' => $score,
                    'file_path' => $filePath,
                ]);
            }

            // Handle ListSubworkload scoring as you did before
            $listSubworkloads = ListSubworkload::where('subworkload_id', $subworkloadId)->get();
            foreach ($listSubworkloads as $listSubworkload) {
                $totalScore = $score * $listSubworkload->factor;

                $existingTotalScore = Score::where('user_id', $userId)
                    ->where('subworkload_id', $listSubworkload->id)
                    ->first();

                if ($existingTotalScore) {
                    $existingTotalScore->score = (float) $totalScore;
                    $existingTotalScore->file_path = $filePath ?: $existingTotalScore->file_path;
                    $existingTotalScore->save();
                } else {
                    Score::create([
                        'user_id' => $userId,
                        'subworkload_id' => $listSubworkload->id,
                        'score' => (float) $totalScore,
                        'file_path' => $filePath,
                    ]);
                }
            }
        }

        return redirect()->route('workloads.summary', $workloadId)
            ->with('success', 'กรุณาตรวจสอบข้อมูลให้ครบถ้วนอีกครั้งก่อนกดยืนยัน');
    }
}
