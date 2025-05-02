<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $attendances = collect(); // default empty
        
        if ($query) {
            // Determine query type
            $isEmail = filter_var($query, FILTER_VALIDATE_EMAIL);
            $isPhone = preg_match('/^[0-9\-\+\(\)\s]+$/', $query);
            
            if ($isEmail || $isPhone) {
                // Build a single query with dynamic conditions
                $attendancesQuery = Attendance::query();
                
                if ($isEmail) {
                    $attendancesQuery->join('internal_users', 'attendance.internal_user_id', '=', 'internal_users.id')
                        ->where('internal_users.email', $query)
                        ->select('attendance.*')
                        ->selectRaw("'Internal' as user_type");
                } else {
                    $attendancesQuery->join('external_users', 'attendance.external_user_id', '=', 'external_users.id')
                        ->where('external_users.phone_2', $query)
                        ->select('attendance.*')
                        ->selectRaw("'External' as user_type");
                }
                
                $attendances = $attendancesQuery->get();
            }
        }
        
        return view('dashboard', compact('attendances'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
