<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {

        $attendances = Attendance::with('user')->get();

        // Current Bangladesh time
        $now = Carbon::now('Asia/Dhaka');
    
        // Define check-in time limits
        $normalCheckInStart = Carbon::createFromTime(9, 0, 0, 'Asia/Dhaka');
        $normalCheckInEnd = Carbon::createFromTime(10, 0, 0, 'Asia/Dhaka');
        $adminApprovalStart = Carbon::createFromTime(10, 0, 1, 'Asia/Dhaka');
        $adminApprovalEnd = Carbon::createFromTime(12, 50, 0, 'Asia/Dhaka');
    
        // Determine the check-in phase
        if ($now->between($normalCheckInStart, $normalCheckInEnd)) {
            $checkInPhase = 'normal';
        } elseif ($now->between($adminApprovalStart, $adminApprovalEnd)) {
            $checkInPhase = 'admin_approval';
        } else {
            $checkInPhase = 'closed';
        }
    
        return view('attendances.index', compact('attendances', 'checkInPhase'));
    }

    public function checkIn(Request $request)
    {
        $attendance = Attendance::firstOrCreate(
            ['user_id' => auth()->id(), 'date' => Carbon::now()->toDateString()],
            ['check_in' => Carbon::now()->toTimeString()]
        );

        return redirect()->back()->with('success', 'Checked in successfully!');
    }

    public function checkOut(Request $request)
    {
        $attendance = Attendance::where('user_id', auth()->id())
            ->where('date', Carbon::now()->toDateString())
            ->first();

        if ($attendance) {
            $attendance->update(['check_out' => Carbon::now()->toTimeString()]);
            return redirect()->back()->with('success', 'Checked out successfully!');
        }

        return redirect()->back()->with('error', 'You need to check in first.');
    }
}
