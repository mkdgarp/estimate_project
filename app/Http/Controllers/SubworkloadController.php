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
        $main = $request->input('main'); // Get the subjects

        // เพิ่ม year และ times จาก request
        $year = $request->input('year');
        $times = $request->input('times');
        $professor_group = $request->input('professor_group');

        // Validate the request
        $request->validate([
            'scores.*' => 'required|numeric',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,xlsx,xls,doc,docx|max:2048',
            'subjects.*.name' => 'required|string',  // Validate subject names
            'subjects.*.files' => 'array',
            'subjects.*.files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,xlsx,xls,doc,docx|max:2048', // Validate individual files
            'main.*.files' => 'array',
            'main.*.files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,xlsx,xls,doc,docx|max:2048', // Validate individual files
        ]);
        // a
        // Process subjects and their respective files

        if ($main) {
            foreach ($main as $parentId => $subject) {
                \Log::info('Received subject:', $subject);

                // Check if the subject already exists
                $existingSubject = ListSubworkload::where('id', $subject['list_subworkload_id'])
                    ->where('year', $year)
                    ->where('times', $times)
                    ->where('create_by', $userId)
                    ->first();

                $parentId = $subject['list_subworkload_id'];

                // Initialize file path for subjects
                $filePathsSubjects = []; // เก็บเส้นทางไฟล์ใน array

                // Handle file upload for subjects
                if ($request->hasFile("main.$parentId.files")) {
                    for ($x = 0; $x <= 4; $x++) {
                        if ($request->hasFile("main.$parentId.files.$x")) {
                            $file = $request->file("main.$parentId.files.$x");
                            $filePath = $file->store('public/uploads/' . $userId);
                            $filePath = str_replace('public/', '', $filePath);
                            $filePathsSubjects[] = ($filePath) ? $filePath : ""; // เพิ่มเส้นทางไฟล์ใน array
                        }
                    }
                }

                // Update or create the score for the subject
                $existingScore = Score::where('user_id', $userId)
                    ->where('subworkload_id', $existingSubject->id)
                    ->first();

                if ($existingScore) {
                    // แปลง file_path เก่ากลับมาเป็น array
                    $oldFilePaths = json_decode($existingScore->file_path, true) ?: [];

                    // รวมไฟล์เก่ากับไฟล์ใหม่
                    $combinedFilePaths = array_merge($oldFilePaths, $filePathsSubjects);
                    $existingScore->file_path = json_encode(array_values(array_filter($combinedFilePaths))); // กรองค่าและรีเซ็ต index


                    $existingScore->save();
                }
            }
        }

        //สร้างใหม่เสมอ
        if ($subjects) {
            foreach ($subjects as $parentId => $subject) {
                \Log::info('Received subject:', $subject);

                if (!empty($subject['name']) && !empty($subject['factor']) && isset($subject['score'])) {
                    // Check if the subject already exists
                    $existingSubject = ListSubworkload::where('name', $subject['name'])
                        ->where('subworkload_id', $subject['subworkload_id'])
                        ->where('create_by', $userId)
                        ->where('list_subworkloads_child_id', $subject['list_id'])
                        ->where('year', $year)
                        ->where('times', $times)
                        ->first();

                    // Create or update the subject
                    if (!$existingSubject) {
                        $existingSubject = ListSubworkload::create([
                            'name' => $subject['name'],
                            'subworkload_id' => $subject['subworkload_id'],
                            'factor' => $subject['factor'],
                            'create_by' => $userId,
                            'sort_order' => $subject['sort_order'],
                            'created_at' => now(),
                            'updated_at' => now(),
                            'is_child' => 0,
                            'year' => $year,
                            'times' => $times,
                            'professor_group' => $professor_group,
                        ]);
                    }

                    // Initialize file path for subjects
                    $filePathsSubjects = []; // เก็บเส้นทางไฟล์ใน array

                    // Handle file upload for subjects
                    if ($request->hasFile("subjects.$parentId.files")) {
                        for ($x = 0; $x <= 4; $x++) {
                            if ($request->hasFile("subjects.$parentId.files.$x")) {
                                $file = $request->file("subjects.$parentId.files.$x");
                                $filePath = $file->store('public/uploads/' . $userId);
                                $filePath = str_replace('public/', '', $filePath);
                                $filePathsSubjects[] = ($filePath) ? $filePath : ""; // เพิ่มเส้นทางไฟล์ใน array
                            }
                        }
                    }

                    // Update or create the score for the subject
                    $existingScore = Score::where('user_id', $userId)
                        ->where('subworkload_id', $existingSubject->id)
                        ->first();

                    if ($existingScore) {
                        $existingScore->score = (float) $subject['score'];
                        $existingScore->file_path = !empty($filePathsSubjects) ? json_encode($filePathsSubjects) : $existingScore->file_path; // ถ้ามีไฟล์อัปโหลดก็ใช้

                        $existingScore->save();
                    } else {
                        Score::create([
                            'user_id' => $userId,
                            'subworkload_id' => $existingSubject->id,
                            'score' => (float) $subject['score'],
                            'file_path' => !empty($filePathsSubjects) ? json_encode($filePathsSubjects) : null,
                            'year' => $year,
                            'times' => $times,
                        ]);
                    }
                } else {
                    throw new \Exception('Invalid subject data: missing name, factor or score');
                }
            }
        }

        // Logic for redirection (same as before)
        if ($request->input('user_id')) {
            if ($request->input('is_staff')) {
                $url = route('staff-manage-subworkload-list-by-id', [
                    'userId' => $request->input('user_id'),
                    'workloadId' => $workloadId,  // Correct parameter name
                ]);

                // Manually append the query string
                $url .= "?times=$times&year=$year&professor_group=$professor_group";

                // return  'อัพเดตข้อมูลสำเร็จ staff';
                // return redirect()->route('staff-manage-subworkload-list-by-id', [
                //     'userId' => $request->input('user_id'),
                //     'workloadId' => $workloadId,
                // ])->with('success', 'อัพเดตข้อมูลสำเร็จ!');
                return redirect($url)->with('success', 'กรุณาตรวจสอบข้อมูลให้ครบถ้วนอีกครั้งก่อนกดยืนยัน');
            } else {
                $url = route('summary-by-id', [
                    'userId' => $request->input('user_id'),
                    'workloadId' => $workloadId,  // Correct parameter name
                ]);

                // Manually append the query string
                $url .= "?times=$times&year=$year&professor_group=$professor_group";

                // return  'อัพเดตข้อมูลสำเร็จ admin';
                // return redirect()->route('summary-by-id', [
                //     'userId' => $request->input('user_id'),
                //     'workloadId' => $workloadId,
                // ])->with('success', 'กรุณาตรวจสอบข้อมูลให้ครบถ้วนอีกครั้งก่อนกดยืนยัน');
                return redirect($url)->with('success', 'กรุณาตรวจสอบข้อมูลให้ครบถ้วนอีกครั้งก่อนกดยืนยัน');
            }
        } else {
            $url = route('workloads.summary', [
                'id' => $workloadId,  // Correct parameter name
            ]);

            // Manually append the query string
            $url .= "?times=$times&year=$year&professor_group=$professor_group";

            // Redirect to the URL with the success message
            return redirect($url)->with('success', 'กรุณาตรวจสอบข้อมูลให้ครบถ้วนอีกครั้งก่อนกดยืนยัน');
        }
    }
}
