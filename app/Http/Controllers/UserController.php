<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\ListSubworkload;
use App\Models\Workload;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('manage', compact('users'));
    }

    public function create()
    {
        return view('create-user');
    }

    public function store(Request $request)
    {

        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
            'rank' => 'required|integer',
            'professor_group' => 'required',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
            'rank' => $validatedData['rank'],
            'professor_group' => $validatedData['professor_group'],
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'เพิ่มผู้ใช้งานสำเร็จ!');
    }

    public function edit($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Return the edit view with the user data
        return view('edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|string',
            'rank' => 'required|integer',
            'professor_group' => 'required',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update user data
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Update password only if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->role = $validatedData['role'];
        $user->rank = $validatedData['rank'];
        $user->professor_group = $validatedData['professor_group'];

        // Save the updated user data
        $user->save();

        // Redirect back with success message
        return redirect()->route('manage')->with('success', 'อัปเดตผู้ใช้งานสำเร็จ!');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manage')->with('success', 'ลบผู้ใช้สำเร็จแล้ว');
    }

    public function destroy_score($id, $userId, $index)
    {
        try {
            // สมมติว่าคุณส่ง index และ subworkload_id มาทาง JSON

            // ค้นหา score ตาม subworkload_id
             $score = Score::where('subworkload_id', $id)
                ->where('user_id', $userId)
                ->firstOrFail();

            // แปลง file_path เป็น array
            $filePaths = json_decode($score->file_path, true);

            // ตรวจสอบว่า index อยู่ในขอบเขต
            if (isset($filePaths[$index])) {
                // ลบไฟล์ที่ต้องการตาม index
                unset($filePaths[$index]);

                // รีเซ็ต array ให้มีค่าตามลำดับ
                $filePaths = array_values($filePaths);

                // แปลงกลับเป็น JSON และบันทึก
                $score->file_path = json_encode($filePaths);
                $score->save();

                return response()->json(['message' => 'ลบไฟล์สำเร็จ'], 200);
            } else {
                return response()->json(['message' => 'ไม่พบเรคคอร์ดที่ต้องการ'], 404);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'ไม่พบเรคคอร์ดที่ต้องการ'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()], 500);
        }
    }

    public function destroy_subjects($id, $userId)
    {
        try {
            // ค้นหา score ที่มี id ตรงกัน
            $score = Score::where('subworkload_id', $id)->where('user_id', $userId)->first();
            $list_subject = ListSubworkload::where('id', $id)->where('create_by', $userId)->first();
            // ตั้งค่า file_path เป็น NULL
            $score->delete();
            $list_subject->delete();

            return response()->json(['message' => 'ลบภาระงานสำเร็จ'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'ไม่พบเรคคอร์ดที่ต้องการ'], 404);
        }
    }

    // UserController.php
    public function searchUsers(Request $request)
    {
        $query = $request->get('query', '');

        $users = User::where('name', 'LIKE', "%{$query}%")->where('rank', '2')->get(['id', 'name']);

        return response()->json($users);
    }


    public function fetchUserWorkloads($userId)
    {
        $workloads = Workload::where('user_id', $userId)->get();

        return response()->json([
            'workloads' => $workloads
        ]);
    }
}
