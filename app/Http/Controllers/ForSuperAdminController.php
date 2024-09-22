<?php

namespace App\Http\Controllers;

use App\Models\Workload;
use App\Models\SubWorkload;
use App\Models\ListSubworkload;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;

class ForSuperAdminController extends Controller
{
    public function index($userId, $workloadId)
    {
        // Fetch the user by userId
        $user = User::findOrFail($userId); // ดึงข้อมูลผู้ใช้

        // Fetch the workload
        $workload = Workload::findOrFail($workloadId);

        // Fetch the subworkloads associated with the workload
        $subworkloads = Subworkload::where('workload_id', $workloadId)->get();
        $subworkloads_id = $subworkloads->pluck('id');

        // Fetch list_subworkloads and join with scores for the specified user
        $list_subworkloads = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('scores.file_path')
            ->whereIn('list_subworkloads.subworkload_id', $subworkloads_id)
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

        // Calculate the total score across all subworkloads
        $totalScore = $list_subworkloads->sum('score');

        // Return the view with the calculated data
        return view('manage-subworkload-list-by-id', compact('user', 'workload', 'hierarchicalData', 'totalScore'));
    }

    public function summary($userId, $workloadId)
    {
        $user = User::findOrFail($userId); // ดึงข้อมูลผู้ใช้

        // Fetch the workload
        $workload = Workload::findOrFail($workloadId);

        // Fetch the subworkloads associated with the workload
        $subworkloads = Subworkload::where('workload_id', $workloadId)->get();
        $subworkloads_id = $subworkloads->pluck('id');

        // Fetch list_subworkloads and join with scores, ordered by list_subworkloads.id
        $list_subworkloads = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('scores.file_path')
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
        return view('summary-by-id', compact('user', 'workload', 'hierarchicalData', 'totalScore'));
    }

    public function print_all_workload($userId)
    {
        $user = User::findOrFail($userId); // ดึงข้อมูลผู้ใช้

        // Fetch the workload
        $workload = Workload::get();

        // Fetch the subworkloads associated with the workload
        $subworkloads = Subworkload::get();
        $subworkloads_id = $subworkloads->pluck('id');

        // Fetch list_subworkloads and join with scores, ordered by list_subworkloads.id
        $list_subworkloads = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('scores.file_path')
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
        return view('print-all-workload', compact('user', 'workload', 'hierarchicalData', 'totalScore'));
    }
}
