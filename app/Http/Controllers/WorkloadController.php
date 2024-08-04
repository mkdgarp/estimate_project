<?php

namespace App\Http\Controllers;

use App\Models\Workload;
use App\Models\SubWorkload;
use App\Models\ListSubworkload;
use App\Models\Score;
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

    public function index()
    {
        $userId = auth()->id();

        // Fetch all workloads, subworkloads, list_subworkloads, and scores
        $workloads = Workload::all();
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

    public function show($id)
    {
        $userId = auth()->id();

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
            ->whereIn('list_subworkloads.subworkload_id', $subworkloads_id)
            ->orderBy('list_subworkloads.id', 'asc') // Order by list_subworkloads.id ascending
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

        // Calculate the total score across all subworkloads
        $totalScore = $list_subworkloads->sum('score');

        // Return the view with the calculated data
        return view('subworkload-list', compact('workload', 'hierarchicalData', 'totalScore'));
    }
}
