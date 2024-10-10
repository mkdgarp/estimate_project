<?php

namespace App\Http\Controllers;

use App\Models\Workload;
use App\Models\SubWorkload;
use App\Models\ListSubworkload;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;

class WorkloadController extends Controller
{
    // public function index()
    // {
    //     $userId = auth()->id();

    //     // Fetch all workloads, subworkloads, list_subworkloads, and scores
    //     $workloads = Workload::all();
    //     $subworkloads = Subworkload::all();
    //     $listSubworkloads = ListSubworkload::all();
    //     $scores = Score::where('user_id', $userId)->get();

    //     // Create a collection with the joined data
    //     foreach ($workloads as $workload) {
    //         // Fetch related Subworkloads
    //         $workload->subworkloads = $subworkloads->where('workload_id', $workload->id);

    //         // Initialize totalScore as 0
    //         $workload->totalScore = 0;

    //         // Process each Subworkload
    //         foreach ($workload->subworkloads as $subworkload) {
    //             // Fetch related list_subworkloads
    //             $relatedListSubworkloads = $listSubworkloads->where('subworkload_id', $subworkload->id);

    //             // Initialize subworkload score
    //             $subworkload->score = 0;

    //             // Sum scores from related list_subworkloads
    //             foreach ($relatedListSubworkloads as $listSubworkload) {
    //                 $score = $scores->where('subworkload_id', $listSubworkload->id)->first();
    //                 $subworkload->score += $score ? (int) $score->score : 0; // Ensure score is an integer
    //             }

    //             // Add to totalScore for the Workload
    //             $workload->totalScore += $subworkload->score;
    //         }
    //     }

    //     // Calculate the total score for all Workloads
    //     $totalScore = (int) $workloads->sum('totalScore'); // Ensure totalScore is an integer

    //     return view('workload-list', compact('workloads', 'totalScore'));
    // }

    public function index(Request $request)
    {
        $userId = auth()->id();

        // รับค่าปีและจำนวนครั้งจากฟอร์ม
        $year = $request->input('year', date('Y')); // ใช้ปีปัจจุบันเป็นค่าเริ่มต้น
        $times = $request->input('times', 1); // ใช้ครั้งที่ 1 เป็นค่าเริ่มต้น

        // Fetch workloads, subworkloads, list_subworkloads, and scores
        $workloads = Workload::all();
        $subworkloads = Subworkload::all();

        // กรองข้อมูลใน ListSubworkload โดยใช้ year และ times
        $listSubworkloads = ListSubworkload::where('year', $year)
            ->where('times', $times)
            ->get();

        $scores = Score::where('user_id', $userId)->get();

        // Create a collection with the joined data
        foreach ($workloads as $workload) {
            // Fetch related Subworkloads
            $workload->subworkloads = $subworkloads->where('workload_id', $workload->id);

            // Initialize totalScore as 0
            $workload->totalScore = 0;

            // Process each Subworkload
            foreach ($workload->subworkloads as $subworkload) {
                // Fetch related list_subworkloads
                $relatedListSubworkloads = $listSubworkloads->where('subworkload_id', $subworkload->id);

                // Initialize subworkload score
                $subworkload->score = 0;

                // Sum scores from related list_subworkloads
                foreach ($relatedListSubworkloads as $listSubworkload) {
                    // Fetch the score and calculate total score * factor
                    $score = $scores->where('subworkload_id', $listSubworkload->id)->first();
                    $subworkload->score += $score ? (float) $score->score * $listSubworkload->factor : 0;
                }

                // Add to totalScore for the Workload
                $workload->totalScore += $subworkload->score;
            }
        }

        // Calculate the total score for all Workloads
        $totalScore = (float) $workloads->sum('totalScore'); // Ensure totalScore is a float

        return view('workload-list', compact('workloads', 'totalScore', 'year', 'times'));
    }


    public function calTotalScorePerWorkload($id, $workloadId)
    {
        $userId = $id;

        // Fetch all workloads, subworkloads, list_subworkloads, and scores
        $workloads = Workload::where('id', $workloadId)->get();
        $subworkloads = Subworkload::all();
        $listSubworkloads = ListSubworkload::all();
        $scores = Score::where('user_id', $userId)->get();

        // Create a collection with the joined data
        foreach ($workloads as $workload) {
            // Fetch related Subworkloads
            $workload->subworkloads = $subworkloads->where('workload_id', $workload->id);

            // Initialize totalScore as 0
            $workload->totalScore = 0;

            // Process each Subworkload
            foreach ($workload->subworkloads as $subworkload) {
                // Fetch related list_subworkloads
                $relatedListSubworkloads = $listSubworkloads->where('subworkload_id', $subworkload->id);

                // Initialize subworkload score
                $subworkload->score = 0;

                // Sum scores from related list_subworkloads
                foreach ($relatedListSubworkloads as $listSubworkload) {
                    // Fetch the score and calculate total score * factor
                    $score = $scores->where('subworkload_id', $listSubworkload->id)->first();
                    $subworkload->score += $score ? (float) $score->score * $listSubworkload->factor : 0;
                }

                // Add to totalScore for the Workload
                $workload->totalScore += $subworkload->score;
            }
        }

        // Calculate the total score for all Workloads
        $totalScore = (float) $workloads->sum('totalScore'); // Ensure totalScore is a float

        return view('workload-list', compact('workloads', 'totalScore'));
    }

    // public function summary()
    // {
    //     $userId = auth()->id();

    //     // Fetch all workloads, subworkloads, list_subworkloads, and scores
    //     $workloads = Workload::all();
    //     $subworkloads = Subworkload::all();
    //     $listSubworkloads = ListSubworkload::all();
    //     $scores = Score::where('user_id', $userId)->get();

    //     // Create a collection with the joined data
    //     foreach ($workloads as $workload) {
    //         // Fetch related Subworkloads
    //         $workload->subworkloads = $subworkloads->where('workload_id', $workload->id);

    //         // Initialize totalScore as 0
    //         $workload->totalScore = 0;

    //         // Process each Subworkload
    //         foreach ($workload->subworkloads as $subworkload) {
    //             // Fetch related list_subworkloads
    //             $relatedListSubworkloads = $listSubworkloads->where('subworkload_id', $subworkload->id);

    //             // Initialize subworkload score
    //             $subworkload->score = 0;

    //             // Sum scores from related list_subworkloads
    //             foreach ($relatedListSubworkloads as $listSubworkload) {
    //                 // Fetch the score and calculate total score * factor
    //                 $score = $scores->where('subworkload_id', $listSubworkload->id)->first();
    //                 $subworkload->score += $score ? (float) $score->score * $listSubworkload->factor : 0;
    //             }

    //             // Add to totalScore for the Workload
    //             $workload->totalScore += $subworkload->score;
    //         }
    //     }

    //     // Calculate the total score for all Workloads
    //     $totalScore = (float) $workloads->sum('totalScore'); // Ensure totalScore is a float

    //     return view('summary/{id}', compact('workloads', 'totalScore'));
    // }


    // public function show($id)
    // {
    //     $userId = auth()->id();

    //     // Fetch the workload
    //     $workload = Workload::findOrFail($id);

    //     // Fetch the subworkloads associated with the workload
    //     $subworkloads = Subworkload::where('workload_id', $id)->get();
    //     $subworkloads_id = $subworkloads->pluck('id');

    //     // Fetch the list_subworkloads associated with the subworkloads
    //     $list_subworkloads = ListSubworkload::whereIn('subworkload_id', $subworkloads_id)->get();

    //     // Fetch the scores for the authenticated user related to the list_subworkloads
    //     $scores = Score::where('user_id', $userId)
    //         ->whereIn('subworkload_id', $list_subworkloads->pluck('id'))
    //         ->get();

    //     // Initialize hierarchical data array
    //     $hierarchicalData = [];

    //     foreach ($subworkloads as $subworkload) {
    //         // Sum the scores for each subworkload
    //         $subworkloadScore = $scores->where('subworkload_id', $subworkload->id)->sum('score');

    //         // Default to 0 if no scores are found
    //         $subworkload->score = $subworkloadScore ?: 0;

    //         // Prepare the subworkload data
    //         $subworkloadArray = [
    //             'subworkload' => $subworkload,
    //             'list_subworkloads' => []
    //         ];

    //         // Populate list_subworkloads for each subworkload
    //         foreach ($list_subworkloads as $list_subworkload) {
    //             if ($list_subworkload->subworkload_id == $subworkload->id) {
    //                 $subworkloadArray['list_subworkloads'][] = $list_subworkload;
    //             }
    //         }

    //         // Add the subworkload data to hierarchicalData
    //         $hierarchicalData[] = $subworkloadArray;
    //     }

    //     // Calculate the total score across all subworkloads
    //     $totalScore = $subworkloads->sum('score');

    //     // Return the view with the calculated data
    //     return view('subworkload-list', compact('workload', 'hierarchicalData', 'totalScore'));
    // }

    public function show(Request $request, $workloadId)
    {
        $userId = auth()->id();

        // ดึงค่า year และ times จาก request
        $year = $request->input('year');
        $times = $request->input('times');
        $professor_group = $request->input('professor_group');

        // Fetch the workload โดยใช้ workloadId แทน userId
        $workload = Workload::findOrFail($workloadId);

        // Fetch the subworkloads ที่เกี่ยวข้องกับ workload
        $subworkloads = Subworkload::where('workload_id', $workloadId)->get();
        $subworkloads_id = $subworkloads->pluck('id');

        // Fetch list_subworkloads และ join กับ scores โดยใช้เงื่อนไข user_id, year, และ times
        $list_subworkloads = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('scores.file_path')
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $subworkloads_id)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();

        // จัดระเบียบข้อมูลแบบ hierarchical
        $hierarchicalData = [];

        foreach ($subworkloads as $subworkload) {
            // เตรียมข้อมูล subworkload
            $subworkloadArray = [
                'subworkload' => $subworkload,
                'list_subworkloads' => $list_subworkloads->filter(function ($list_subworkload) use ($subworkload) {
                    return $list_subworkload->subworkload_id == $subworkload->id;
                })
            ];

            // เพิ่มข้อมูลลงใน hierarchicalData
            $hierarchicalData[] = $subworkloadArray;
        }

        // คำนวณคะแนนรวมของ subworkloads
        $totalScore = $list_subworkloads->sum('score');

        // ส่งข้อมูลไปที่ view
        return view('subworkload-list', compact('workload', 'hierarchicalData', 'totalScore'));
    }


    public function summary(Request $request, $id)
    {
        $userId = auth()->id();
        // ดึงค่า year และ times จาก request
        $year = $request->input('year');
        $times = $request->input('times');
        $professor_group = $request->input('professor_group');
        // Fetch the workload
        $workload = Workload::findOrFail($id);

        // Fetch the subworkloads associated with the workload
        $subworkloads = Subworkload::where('workload_id', $id)->get();
        $subworkloads_id = $subworkloads->pluck('id');

        // Fetch list_subworkloads and join with scores, ordered by list_subworkloads.id
        $list_subworkloads = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('scores.file_path')
            ->selectRaw('IFNULL(scores.score, 0) * list_subworkloads.factor as finalScore')
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $subworkloads_id)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();


        // Organize hierarchical data
        $hierarchicalData = [];

        foreach ($subworkloads as $subworkload) {
            // Prepare the subworkload data
            $subworkloadArray = [
                'subworkload' => $subworkload,
                'list_subworkloads' => $list_subworkloads->filter(function ($list_subworkload) use ($subworkload) {
                    return $list_subworkload->subworkload_id == $subworkload->id;
                })
            ];

            // Add the subworkload data to hierarchicalData
            $hierarchicalData[] = $subworkloadArray;
        }
        $finalScore = $list_subworkloads->sum('finalScore');
        // Calculate the total score across all subworkloads
        $totalScore = $list_subworkloads->sum('score');

        // Return the view with the calculated data
        return view('summary', compact('workload', 'hierarchicalData', 'totalScore', 'finalScore'));
    }

    public function view_report(Request $request)
    {
        // Fetch the search query from the request
        $query = $request->get('query', null);  // Default to null if no query
        // รับค่าปีและจำนวนครั้งจากฟอร์ม
        $year = $request->input('year', date('Y')); // ใช้ปีปัจจุบันเป็นค่าเริ่มต้น
        $times = $request->input('times', 1); // ใช้ครั้งที่ 1 เป็นค่าเริ่มต้น

        // Fetch all workloads and subworkloads
        $workloads = Workload::get();
        $subworkloads = Subworkload::get();
        $subworkloads_id = $subworkloads->pluck('id');

        // Fetch users (only rank == 2), and filter by the search query if present
        $userQuery = User::where('rank', '2');
        if ($query) {
            $userQuery->where('name', 'LIKE', "%{$query}%");
        }
        $user = $userQuery->get();

        // Fetch list_subworkloads and join with scores for each user
        $list_subworkloads = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($user) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->whereIn('scores.user_id', $user->pluck('id'));
            })
            ->where('year', $year)
            ->where('times', $times)
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('list_subworkloads.factor')
            ->selectRaw('scores.user_id')  // Include user_id in the selection
            ->whereIn('list_subworkloads.subworkload_id', $subworkloads_id)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();

        // Calculate total scores per user
        $arrTotalScore = [];
        foreach ($list_subworkloads as $list_subworkload) {
            $userId = $list_subworkload->user_id;
            $score = $list_subworkload->score * $list_subworkload->factor;

            if (!isset($arrTotalScore[$userId])) {
                $arrTotalScore[$userId] = 0; // Initialize total score for this user
            }

            $arrTotalScore[$userId] += $score; // Sum scores
        }

        // Organize hierarchical data
        $hierarchicalData = [];
        foreach ($subworkloads as $subworkload) {
            $subworkloadArray = [
                'subworkload' => $subworkload,
                'list_subworkloads' => $list_subworkloads->filter(function ($list_subworkload) use ($subworkload) {
                    return $list_subworkload->subworkload_id == $subworkload->id;
                })
            ];
            $hierarchicalData[] = $subworkloadArray;
        }

        // Return the view with the calculated data and search query (if any)
        return view('view-report', compact('workloads', 'hierarchicalData', 'user', 'arrTotalScore', 'query'));
    }
}
