<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class PortalController extends Controller
{
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    private function logEvent($action, $userId = null) {
        DB::table('logs')->insert([
            'user_id' => $userId,
            'action' => $action,
            'created_at' => now()
        ]);
    }

    public function showRegister() { return view('register'); }

    public function register(Request $request) {
        $id = DB::table('users')->insertGetId([
            'student_id' => $request->student_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'course' => $request->course,
        ]);
        $this->logEvent('Registered New Student Account', $id);
        return redirect('/login');
    }

    public function showLogin() { return view('login'); }

    public function login(Request $request) {
        $user = DB::table('users')->where('email', $request->email)->first();
        
        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user_id', $user->id);
            $this->logEvent('User Logged In', $user->id);
            return redirect('/dashboard');
        }
        
        $this->logEvent('Failed Login Attempt - Email: ' . $request->email);
        return back();
    }

    public function logout() {
        $this->logEvent('User Logged Out', Session::get('user_id'));
        Session::forget('user_id');
        return redirect('/login');
    }

    public function showProfile() {
        if(!Session::has('user_id')) return redirect('/login');
        $user = DB::table('users')->where('id', Session::get('user_id'))->first();
        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request, $id) {
    DB::table('users')->where('id', $id)->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'course' => $request->course,
    ]);

    DB::table('logs')->insert(['user_id' => session('user_id'), 'action' => 'Updated profile of user ID ' . $id, 'created_at' => now()]);

    return redirect('/dashboard');
    }

    public function dashboard() {
   $user = DB::table('users')->where('id', session('user_id'))->first();

    $logs = DB::table('logs')
                ->join('users', 'logs.user_id', '=', 'users.id')
                ->select('logs.*', 'users.first_name', 'users.last_name')
                ->orderBy('logs.created_at', 'desc')
                ->get();
    
    return view('dashboard', ['user' => $user, 'logs' => $logs]);
    }
    public function editProfile($id) {
    $user = DB::table('users')->where('id', $id)->first();
    return view('profile', ['user' => $user]);
    }

    public function deleteUser($id) {
    DB::table('logs')->where('user_id', $id)->delete();
    DB::table('users')->where('id', $id)->delete();
    
    return redirect('/dashboard');
    }
    
}

