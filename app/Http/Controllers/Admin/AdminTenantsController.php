<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminTenantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $tenants=Tenant::query()
            ->when(request('search'),function ($query,$search){
                $query->where('name','like', '%'.$search.'%');
            })
            ->paginate(10)->withQueryString()
            ->through(fn($tenant)=>[
                'id'=>$tenant->id,
                'name'=>$tenant->name,
                'last_name'=>$tenant->last_name,
                'email'=>$tenant->email,
                'cellphone'=>$tenant->cellphone,
                'status'=>$tenant->status
            ]);
        $filters=request()->only(['search']);
        return inertia::render('admin.users.tenants.index', compact('tenants','filters'));
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
        $tenant=Tenant::where('id',$id)->with('type')->firstOrFail();

        return inertia::render('admin.users.tenants.show', compact('tenant'));
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
       $tenant=Tenant::findOrFail($id);
       if ($tenant->status){
           $tenant->update(['status'=>0]);
           activity()
               ->causedBy(Auth::user())
               ->performedOn($tenant)
               ->useLog('updated')
               ->log('Disabled ' .$tenant->name. ' account');
       }else{
           $tenant->update(['status'=>1]);
           activity()
               ->causedBy(Auth::user())
               ->performedOn($tenant)
               ->useLog('updated')
               ->log('Enabled ' .$tenant->name. ' account');
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
