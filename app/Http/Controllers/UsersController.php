<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller {
    public function listManagers(Request $request) {
        // dd($request);
        $type = 'Manager';
        $userType = "User Type: " . $type;
        return view('dashboard', compact('userType'));
    }

    public function listDoctors(Request $request) {
        // dd($request);
        $type = 'Doctor';
        $userType = "User Type: " . $type;
        return view('dashboard', compact('userType'));
    }

    public function listPatients(Request $request) {
        // dd($request);
        $type = 'Patient';
        $userType = "User Type: " . $type;
        return view('dashboard', compact('userType'));
    }

    public function listAgents(Request $request) {
        // dd($request);
        $type = 'Supper Agent';
        $userType = "User Type: " . $type;
        return view('dashboard', compact('userType'));
    }
}
