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
    public function index(Request $request, $userId, $workloadId)
    {
        // Fetch the user by userId
        $user = User::findOrFail($userId); // ดึงข้อมูลผู้ใช้
        $allUser = User::where('rank', '2')->where('id', '<>', "$userId")->get();
        // Fetch the workload
        $workload = Workload::findOrFail($workloadId);
        $year = $request->input('year', date('Y')); // ใช้ปีปัจจุบันเป็นค่าเริ่มต้น
        $times = $request->input('times', 1); // ใช้ครั้งที่ 1 เป็นค่าเริ่มต้น
        $professor_group = $request->input('professor_group', 1); // ใช้ครั้งที่ 1 เป็นค่าเริ่มต้น
        // Fetch the subworkloads associated with the workload
        $subworkloads = Subworkload::where('workload_id', $workloadId)->get();
        $subworkloads_id = $subworkloads->pluck('id');

        // Fetch list_subworkloads and join with scores for the specified user
        $list_subworkloads = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
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
        return view('manage-subworkload-list-by-id', compact('user', 'workload', 'hierarchicalData', 'totalScore', 'allUser'));
    }

    public function staff(Request $request, $userId, $workloadId)
    {
        // Fetch the user by userId
        $user = User::findOrFail($userId); // ดึงข้อมูลผู้ใช้
        $allUser = User::where('rank', '2')->where('id', '<>', "$userId")->get();
        // Fetch the workload
        $workload = Workload::findOrFail($workloadId);
        $year = $request->input('year', date('Y')); // ใช้ปีปัจจุบันเป็นค่าเริ่มต้น
        $times = $request->input('times', 1); // ใช้ครั้งที่ 1 เป็นค่าเริ่มต้น
        $professor_group = $request->input('professor_group', 1); // ใช้ครั้งที่ 1 เป็นค่าเริ่มต้น
        // Fetch the subworkloads associated with the workload
        $subworkloads = Subworkload::where('workload_id', $workloadId)->get();
        $subworkloads_id = $subworkloads->pluck('id');

        // Fetch list_subworkloads and join with scores for the specified user
        $list_subworkloads = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
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
        return view('staff-manage-subworkload-list-by-id', compact('user', 'workload', 'hierarchicalData', 'totalScore', 'allUser'));
    }

    public function summary(Request $request, $userId, $workloadId)
    {
        $user = User::findOrFail($userId); // ดึงข้อมูลผู้ใช้
        $year = $request->input('year', date('Y')); // ใช้ปีปัจจุบันเป็นค่าเริ่มต้น
        $times = $request->input('times', 1); // ใช้ครั้งที่ 1 เป็นค่าเริ่มต้น
        $professor_group = $request->input('professor_group', 1); // ใช้ครั้งที่ 1 เป็นค่าเริ่มต้น
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
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

    public function print_all_workload(Request $request, $userId)
    {
        $user = User::findOrFail($userId); // ดึงข้อมูลผู้ใช้

        $year = $request->input('year', date('Y')); // ใช้ปีปัจจุบันเป็นค่าเริ่มต้น
        $times = $request->input('times', 1); // ใช้ครั้งที่ 1 เป็นค่าเริ่มต้น
        $professor_group = $request->input('professor_group', 1); // ใช้ครั้งที่ 1 เป็นค่าเริ่มต้น

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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $x5)
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $x5)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();

        $z6 = Subworkload::where('workload_id', 5)->get();
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $x6)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();

        $z7 = Subworkload::where('workload_id', 5)->get();
        $x7 = $z7->pluck('id');
        $list_7 = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('scores.*')
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
            ->whereIn('list_subworkloads.subworkload_id', $x7)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();

        $zz = Subworkload::all();
        $xx = $zz->pluck('id');
        $list_xx = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('scores.*')
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
            ->whereIn('list_subworkloads.subworkload_id', $xx)
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
        $total_6 = $list_6->sum('finalScore');
        $total_7 = $list_7->sum('finalScore');
        $total_subjects = $list_xx->sum('finalScore');

        // Return the view with the calculated data
        return view('print-all-workload', compact('user', 'workload', 'hierarchicalData', 'totalScore', 'total_1', 'total_2', 'total_3', 'total_4', 'total_5', 'total_6', 'total_7', 'total_subjects'));
    }

    public function print_all_workload_superadmin(Request $request, $userId)
    {
        $user = User::findOrFail($userId); // ดึงข้อมูลผู้ใช้
        $year = $request->input('year', date('Y')); // ใช้ปีปัจจุบันเป็นค่าเริ่มต้น
        $times = $request->input('times', 1); // ใช้ครั้งที่ 1 เป็นค่าเริ่มต้น
        $professor_group = $request->input('professor_group', 1); // ใช้ครั้งที่ 1 เป็นค่าเริ่มต้น

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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $x5)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();

        // $z5 = Subworkload::where('workload_id', 5)->get();
        // $x5 = $z5->pluck('id');
        // $list_5 = ListSubworkload::select('list_subworkloads.*')
        //     ->leftJoin('scores', function ($join) use ($userId) {
        //         $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
        //             ->where('scores.user_id', $userId);
        //     })
        //     ->selectRaw('scores.*')
        //     ->selectRaw('IFNULL(scores.score, 0) as score')
        //     ->selectRaw('scores.file_path')
        //     ->selectRaw('IFNULL(scores.score, 0) * list_subworkloads.factor as finalScore')
        //     ->where(function ($query) use ($year) {
        //         $query->where('list_subworkloads.year', $year)
        //             ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
        //     })
        //     ->where(function ($query) use ($times) {
        //         $query->where('list_subworkloads.times', $times)
        //             ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
        //     })
        //     ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
        //     ->whereIn('list_subworkloads.subworkload_id', $x5)
        //     ->orderBy('list_subworkloads.sort_order', 'desc')
        //     ->orderBy('list_subworkloads.id', 'asc')
        //     ->get();

        $z6 = Subworkload::where('workload_id', 6)->get();
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
            ->where(function ($query) use ($year) {
                $query->where('list_subworkloads.year', $year)
                    ->orWhereNull('list_subworkloads.year'); // ใช้ orWhereNull แทน whereIn
            })
            ->where(function ($query) use ($times) {
                $query->where('list_subworkloads.times', $times)
                    ->orWhereNull('list_subworkloads.times'); // ใช้ orWhereNull แทน whereIn
            })
            ->whereIn('list_subworkloads.create_by', [$userId, 'SYSTEM'])
            ->whereIn('list_subworkloads.subworkload_id', $x6)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();

        $z7 = Subworkload::where('workload_id', 7)->get();
        $x7 = $z7->pluck('id');
        $list_7 = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('scores.*')
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
            ->whereIn('list_subworkloads.subworkload_id', $x7)
            ->orderBy('list_subworkloads.sort_order', 'desc')
            ->orderBy('list_subworkloads.id', 'asc')
            ->get();

        $zz = Subworkload::all();
        $xx = $zz->pluck('id');
        $list_xx = ListSubworkload::select('list_subworkloads.*')
            ->leftJoin('scores', function ($join) use ($userId) {
                $join->on('list_subworkloads.id', '=', 'scores.subworkload_id')
                    ->where('scores.user_id', $userId);
            })
            ->selectRaw('scores.*')
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
            ->whereIn('list_subworkloads.subworkload_id', $xx)
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
        $total_6 = $list_6->sum('finalScore');
        $total_7 = $list_7->sum('finalScore');
        $total_subjects = $list_xx->sum('finalScore');

        // Return the view with the calculated data
        return view('print-all-workload-superadmin', compact('user', 'workload', 'hierarchicalData', 'totalScore', 'total_1', 'total_2', 'total_3', 'total_4', 'total_5', 'total_6', 'total_7', 'total_subjects'));
    }

    // public function move_subject($subworkloadId, $own_userid, $final_userid)
    // {

    //     $ListSubWorkload = ListSubworkload::where('subworkload_id', $subworkloadId)->where('create_by', $own_userid)->get();

    //     foreach ($ListSubWorkload as $ListSubWorkloads) {
    //         $oldscore = Score::where('user_id', $own_userid)->where('subworkload_id', $ListSubWorkloads->id)->first();
    //         $oldscore->user_id = $final_userid;
    //         $oldscore->save();

    //         $ListSubWorkloads->create_by = $final_userid;
    //         $ListSubWorkloads->save();
    //     }
    // }
    public function move_subject_inuser($list_subworkload, $own_userid, $to_subworkload)
    {

        $ListSubWorkload = ListSubworkload::where('id', $list_subworkload)->first();

        // foreach ($ListSubWorkload as $ListSubWorkloads) {
        // $oldscore = Score::where('user_id', $own_userid)->where('subworkload_id', $ListSubWorkloads->id)->first();
        // $oldscore->user_id = $final_userid;
        // $oldscore->save();

        $ListSubWorkload->subworkload_id = $to_subworkload;
        $ListSubWorkload->save();
        // }
    }
}
