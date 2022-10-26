<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminManagersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $managers=Manager::query()
            ->when(request('search'),function ($query,$search){
                $query->where('name','like', '%'.$search.'%');
            })
            ->paginate(10)->withQueryString()
            ->through(fn($manager)=>[
                'id'=>$manager->id,
                'name'=>$manager->name,
                'last_name'=>$manager->last_name,
                'email'=>$manager->email,
                'cellphone'=>$manager->cellphone,
                'status'=>$manager->status
            ]);
        $filters=request()->only(['search']);
        return inertia::render('/admin/users/managers/index', compact('managers','filters'));
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
        $manager=Manager::where('id',$id)->with('company')->with('company.location')->firstOrFail();


        return inertia::render('admin/users/managers/show', compact('manager'));

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

        $manager=Manager::findOrFail($id);
        if ($manager->status==1){
            $manager->update(['status'=>0]);
            activity()
                ->causedBy(Auth::user())
                ->performedOn($manager)
                ->useLog('updated')
                ->log('Disabled ' .$manager->name. ' account');
        }else{
            $manager->update(['status'=>1]);
            activity()
                ->causedBy(Auth::user())
                ->performedOn($manager)
                ->useLog('updated')
                ->log('Enabled ' .$manager->name. ' account');
        }



        return  redirect()->back()
            ->with('status','User successfully deactivated');
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
