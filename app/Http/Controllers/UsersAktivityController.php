<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsersAktivity;



class UsersAktivityController extends Controller
{
    public function index()
    {
        $user = User::select()->count();
        $activity_log = UsersAktivity::with('user')->limit(10)->orderBy('id', 'DESC')->get();
        return view('user_activity.index', compact('user', 'activity_log'));
    }

    public function data()
    {
        $activity_log = UsersAktivity::orderBy('id', 'desc')->get();
        
        return dataTables()
            ->of($activity_log)
            ->addIndexColumn()
            ->addColumn('time', function ($activity_log) {
                return $activity_log->created_at;
            })            
            ->addColumn('name_user', function ($activity_log) {
                return $activity_log->user->name ?? '';
            })
            ->addColumn('description', function ($activity_log) {
                return $activity_log->description ?? '';
            })
            ->make(true);
    }

    

}
