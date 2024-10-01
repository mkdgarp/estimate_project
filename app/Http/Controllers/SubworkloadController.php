<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Models\ListSubworkload;
use App\Models\Subworkload;
use App\Models\Workload;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


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

    // public function updateScores(Request $request)
    // {
    //     // กำหนด userId จาก request หรือจาก auth
    //     $userId = $request->input('user_id') ?? auth()->id();

    //     $workloadId = $request->input('workload_id');
    //     $scores = $request->input('scores');
    //     $files = $request->file('files'); // Get the files
    //     // $ref_child_id = $request->input('ref_child_id'); // Get the files

    //     // Validate the request
    //     $request->validate([
    //         'scores.*' => 'required|numeric',
    //         'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,xlsx,xls,doc,docx|max:2048',
    //     ]);

    //     foreach ($scores as $subworkloadId => $score) {
    //         $checkcheck = ListSubworkload::join('subworkloads', 'subworkloads.id', '=', 'list_subworkloads.subworkload_id')
    //             ->join('workloads', 'workloads.id', '=', 'subworkloads.workload_id')
    //             ->where('list_subworkloads.id', $subworkloadId) // กรองด้วย list_subworkloads.id
    //             ->where('workloads.id', $workloadId) // กรองด้วย workloads.id
    //             // ->select('list_subworkloads.*') // เลือกเฉพาะฟิลด์ที่ต้องการจาก list_subworkloads
    //             ->first();


    //         if (!$checkcheck) {
    //             // ถ้า subworkload ไม่สัมพันธ์กับ workload_id นี้ ก็ข้ามการประมวลผล
    //             continue;
    //         }

    //         $existingScore = Score::where('user_id', $userId)
    //             ->where('subworkload_id', $subworkloadId)
    //             ->first();

    //         // Initialize file path
    //         $filePath = null;

    //         // Handle the file upload for the current subworkload
    //         if (isset($files[$subworkloadId]) && $files[$subworkloadId]->isValid()) {
    //             // Store file in public/uploads/{userId} and get the full path
    //             $filePath = $files[$subworkloadId]->store('public/uploads/' . $userId);

    //             // Remove 'public/' from the path to store in the database
    //             $filePath = str_replace('public/', '', $filePath);
    //         }

    //         if ($existingScore) {
    //             $existingScore->score = (float) $score;
    //             $existingScore->file_path = $filePath ?: $existingScore->file_path; // Update file path only if a new file was uploaded
    //             $existingScore->save();
    //         } else {
    //             Score::create([
    //                 'user_id' => $userId,
    //                 'subworkload_id' => $subworkloadId,
    //                 'score' => (float) $score,
    //                 'file_path' => $filePath,
    //             ]);
    //         }


    //         // Handle ListSubworkload scoring as you did before
    //         $listSubworkloads = ListSubworkload::join('subworkloads', 'subworkloads.id', '=', 'list_subworkloads.subworkload_id')
    //             ->join('workloads', 'workloads.id', '=', 'subworkloads.workload_id')
    //             ->where('list_subworkloads.id', $subworkloadId) // กรองด้วย list_subworkloads.id
    //             ->where('workloads.id', $workloadId) // กรองด้วย workloads.id
    //             ->select('list_subworkloads.*') // เลือกเฉพาะฟิลด์ที่ต้องการจาก list_subworkloads
    //             ->get();
    //         foreach ($listSubworkloads as $listSubworkload) {
    //             // $totalScore = $score * $listSubworkload->factor;

    //             $existingTotalScore = Score::where('user_id', $userId)
    //                 ->where('subworkload_id', $listSubworkload->id)
    //                 ->first();

    //             if ($existingTotalScore) {
    //                 $existingTotalScore->score = (float) $score;
    //                 $existingTotalScore->file_path = $filePath ?: $existingTotalScore->file_path;
    //                 $existingTotalScore->save();
    //             } else {
    //                 Score::create([
    //                     'user_id' => $userId,
    //                     'subworkload_id' => $listSubworkload->id,
    //                     'score' => (float) $score,
    //                     'file_path' => $filePath,
    //                 ]);
    //             }
    //         }
    //     }

    //     if ($request->input('user_id')) {
    //         return redirect()->route('summary-by-id', [
    //             'userId' => $request->input('user_id'),
    //             'workloadId' => $workloadId,
    //         ])->with('success', 'กรุณาตรวจสอบข้อมูลให้ครบถ้วนอีกครั้งก่อนกดยืนยัน');
    //     } else {
    //         return redirect()->route('workloads.summary', $workloadId)
    //             ->with('success', 'กรุณาตรวจสอบข้อมูลให้ครบถ้วนอีกครั้งก่อนกดยืนยัน');
    //     }
    // }

    public function updateScores(Request $request)
    {
        // กำหนด userId จาก request หรือจาก auth
        $userId = $request->input('user_id') ?? auth()->id();
        $workloadId = $request->input('workload_id');
        $scores = $request->input('scores');
        $files = $request->file('files'); // Get the files
        $subjects = $request->input('subjects'); // Get the subjects

        // Validate the request
        $request->validate([
            'scores.*' => 'required|numeric',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,xlsx,xls,doc,docx|max:2048',
            'subjects.*.name' => 'required|string',  // Validate subject names
        ]);

        // Process subjects and their respective files
        if ($subjects) {
            foreach ($subjects as $parentId => $subject) {
                \Log::info('Received subject:', $subject);

                if (!empty($subject['name']) && !empty($subject['factor']) && isset($subject['score'])) {
                    // Check if the subject already exists
                    $existingSubject = ListSubworkload::where('name', $subject['name'])
                        ->where('subworkload_id', $subject['subworkload_id'])
                        ->where('create_by', $userId)
                        ->where('list_subworkloads_child_id', $subject['list_id'])
                        ->first();

                    // Create or update the subject
                    $existingSubject = ListSubworkload::create([
                        'name' => $subject['name'],
                        'subworkload_id' => $subject['subworkload_id'],
                        'factor' => $subject['factor'],
                        'create_by' => $userId,
                        'sort_order' => $subject['sort_order'],
                        'created_at' => now(),
                        'updated_at' => now(),
                        'is_child' => 0,
                    ]);

                    // Initialize file path for subjects
                    $filePathSubjects = null;

                    // Handle file upload for subjects
                    if ($request->hasFile("subjects.$parentId.files")) {
                        $file = $request->file("subjects.$parentId.files");
                        $filePathSubjects = $file->store('public/uploads/' . $userId);
                        $filePathSubjects = str_replace('public/', '', $filePathSubjects);
                    }

                    // Update or create the score for the subject
                    $existingScore = Score::where('user_id', $userId)
                        ->where('subworkload_id', $existingSubject->id)
                        ->first();

                    if ($existingScore) {
                        $existingScore->score = (float) $subject['score'];
                        $existingScore->file_path = $filePathSubjects ?: $existingScore->file_path;
                        $existingScore->save();
                    } else {
                        Score::create([
                            'user_id' => $userId,
                            'subworkload_id' => $existingSubject->id,
                            'score' => (float) $subject['score'],
                            'file_path' => $filePathSubjects,
                        ]);
                    }
                } else {
                    throw new \Exception('Invalid subject data: missing name, factor or score');
                }
            }
        }

        if ($scores) {
            // Process scores and their respective files
            foreach ($scores as $subworkloadId => $score) {
                $checkcheck = ListSubworkload::join('subworkloads', 'subworkloads.id', '=', 'list_subworkloads.subworkload_id')
                    ->join('workloads', 'workloads.id', '=', 'subworkloads.workload_id')
                    ->where('list_subworkloads.id', $subworkloadId)
                    ->where('workloads.id', $workloadId)
                    ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
                    ->first();

                if (!$checkcheck) {
                    continue; // Skip if the workload does not match
                }

                $existingScore = Score::where('user_id', $userId)
                    ->where('subworkload_id', $subworkloadId)
                    ->first();

                // Initialize file path for scores
                $filePath = null;

                // Handle file upload for scores
                if (isset($files[$subworkloadId]) && $files[$subworkloadId]->isValid()) {
                    $filePath = $files[$subworkloadId]->store('public/uploads/' . $userId);
                    $filePath = str_replace('public/', '', $filePath);
                }

                // Update or create the score
                if ($existingScore) {
                    $existingScore->score = (float) $score;
                    $existingScore->file_path = $filePath ?: $existingScore->file_path; // Only update if a new file was uploaded
                    $existingScore->save();
                } else {
                    Score::create([
                        'user_id' => $userId,
                        'subworkload_id' => $subworkloadId,
                        'score' => (float) $score,
                        'file_path' => $filePath,
                    ]);
                }

                // Update child scores
                $listSubworkloads = ListSubworkload::join('subworkloads', 'subworkloads.id', '=', 'list_subworkloads.subworkload_id')
                    ->join('workloads', 'workloads.id', '=', 'subworkloads.workload_id')
                    ->where('list_subworkloads.id', $subworkloadId)
                    ->where('workloads.id', $workloadId)
                    ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
                    ->select('list_subworkloads.*')
                    ->get();

                foreach ($listSubworkloads as $listSubworkload) {
                    $existingTotalScore = Score::where('user_id', $userId)
                        ->where('subworkload_id', $listSubworkload->id)
                        ->first();

                    if ($existingTotalScore) {
                        $existingTotalScore->score = (float) $score;
                        $existingTotalScore->file_path = $filePath ?: $existingTotalScore->file_path;
                        $existingTotalScore->save();
                    } else {
                        Score::create([
                            'user_id' => $userId,
                            'subworkload_id' => $listSubworkload->id,
                            'score' => (float) $score,
                            'file_path' => $filePath,
                        ]);
                    }
                }
            }

            // Redirect based on user_id
            if ($request->input('user_id')) {
                if ($request->input('is_staff')) {
                    return redirect()->route('staff-manage-subworkload-list-by-id', [
                        'userId' => $request->input('user_id'),
                        'workloadId' => $workloadId,
                    ])->with('success', 'อัพเดตข้อมูลสำเร็จ!');
                } else {
                    return redirect()->route('summary-by-id', [
                        'userId' => $request->input('user_id'),
                        'workloadId' => $workloadId,
                    ])->with('success', 'กรุณาตรวจสอบข้อมูลให้ครบถ้วนอีกครั้งก่อนกดยืนยัน');
                }
            } else {
                return redirect()->route('workloads.summary', $workloadId)
                    ->with('success', 'กรุณาตรวจสอบข้อมูลให้ครบถ้วนอีกครั้งก่อนกดยืนยัน');
            }
        } else {
            return redirect()->route('workloads.summary', $workloadId)
                ->with('success', 'กรุณาตรวจสอบข้อมูลให้ครบถ้วนอีกครั้งก่อนกดยืนยัน');
        }
    }
}
