<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::query()
            ->when(request('search'),function ($query,$search){
                $query->where('name','like', '%'.$search.'%');
            })
            ->paginate(10)->withQueryString()
            ->through(fn($user)=>[
                'id'=>$user->id,
                'name'=>$user->name,
                'last_name'=>$user->last_name,
                'email'=>$user->email,
                'cellphone'=>$user->cellphone,
                'status'=>$user->status
            ]);
        $filters=request()->only(['search']);

        return inertia::render('admin.users.admins.index', compact('users','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user=User::findOrFail($id);
        return inertia::render('admin.users.admins.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $user=User::findOrFail($id);

        if ($user->status){
            $user->update(['status'=>0]);
            activity()
                ->causedBy(Auth::user())
                ->performedOn($user)
                ->useLog('updated')
                ->log('Disabled ' .$user->name. ' account');
        }else{
            $user->update(['status'=>1]);
            activity()
                ->causedBy(Auth::user())
                ->performedOn($user)
                ->useLog('updated')
                ->log('Disabled ' .$user->name. ' account');
        }

        return  redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
