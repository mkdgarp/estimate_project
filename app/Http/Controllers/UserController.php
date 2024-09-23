<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
            'rank' => $validatedData['rank'],
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'เพิ่มผู้ใช้งานสำเร็จ!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manage')->with('success', 'ลบผู้ใช้สำเร็จแล้ว');
    }

    public function destroy_score($id, $userId)
    {
        try {
            // ค้นหา score ที่มี id ตรงกัน
            $score = Score::where('subworkload_id', $id)->where('user_id', $userId)->first();

            // ตรวจสอบว่ามีไฟล์ที่ต้องลบอยู่หรือไม่
            // if ($score->file_path) {
            //     // สร้างเส้นทางเต็มของไฟล์ที่ต้องการลบ
            //     $filePath = public_path('storage/' . $score->file_path);

            //     // เช็คว่ามีไฟล์อยู่จริงหรือไม่ และถ้ามีให้ลบไฟล์
            //     if (file_exists($filePath)) {
            //         unlink($filePath); // ลบไฟล์
            //     }
            // }

            // ตั้งค่า file_path เป็น NULL
            $score->file_path = NULL;
            $score->save();

            return response()->json(['message' => 'ลบไฟล์สำเร็จ'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'ไม่พบเรคคอร์ดที่ต้องการ'], 404);
        }
    }
}
