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


        $list_subworkloads = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('scores.file_path')
            ->selectRaw('IFNULL(scores.score, 0) * list_subworkloads.factor as finalScore')
            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $subworkloads_id)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();



        $workload1 = Workload::where('id', 1)->first();
        $z1 = Subworkload::where('workload_id', $workload1->id)->get();
        $x1 = $z1->pluck('id');
        $list_1 = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join1) use ($userId) {
                $join1->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('scores.*')
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('scores.file_path')
            ->selectRaw('IFNULL(scores.score, 0) * list_subworkloads.factor as finalScore')

            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $x1)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();


        $z2 = Subworkload::where('workload_id', 2)->get();
        $x2 = $z2->pluck('id');
        $list_2 = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('scores.*')
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('scores.file_path')
            ->selectRaw('IFNULL(scores.score, 0) * list_subworkloads.factor as finalScore')

            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $x2)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();

        $z3 = Subworkload::where('workload_id', 3)->get();
        $x3 = $z3->pluck('id');
        $list_3 = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('scores.*')
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('scores.file_path')
            ->selectRaw('IFNULL(scores.score, 0) * list_subworkloads.factor as finalScore')

            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $x3)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();

        $z4 = Subworkload::where('workload_id', 4)->get();
        $x4 = $z4->pluck('id');
        $list_4 = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('scores.*')
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('scores.file_path')
            ->selectRaw('IFNULL(scores.score, 0) * list_subworkloads.factor as finalScore')

            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $x4)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();

        $z5 = Subworkload::where('workload_id', 5)->get();
        $x5 = $z5->pluck('id');
        $list_5 = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('scores.*')
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('scores.file_path')
            ->selectRaw('IFNULL(scores.score, 0) * list_subworkloads.factor as finalScore')

            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $x5)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();

        $z6 = Subworkload::all();
        $x6 = $z6->pluck('id');
        $list_6 = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('scores.*')
            ->selectRaw('IFNULL(scores.score, 0) as score')
            ->selectRaw('scores.file_path')
            ->selectRaw('IFNULL(scores.score, 0) * list_subworkloads.factor as finalScore')

            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $x6)
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

        // Calculate the total score across all subworkloads
        $totalScore = $list_subworkloads->sum('score');
        $total_1 = $list_1->sum('finalScore');
        $total_2 = $list_2->sum('finalScore');
        $total_3 = $list_3->sum('finalScore');
        $total_4 = $list_4->sum('finalScore');
        $total_5 = $list_5->sum('finalScore');
        $total_subjects = $list_6->sum('finalScore');

        // Return the view with the calculated data
        return view('print-all-workload', compact('user', 'workload', 'hierarchicalData', 'totalScore', 'total_1', 'total_2', 'total_3', 'total_4', 'total_5','total_subjects'));
    }
}
