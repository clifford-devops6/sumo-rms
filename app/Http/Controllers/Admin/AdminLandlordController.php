<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Landlord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminLandlordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $landlords=Landlord::query()
            ->when(request('search'),function ($query,$search){
                $query->where('name','like', '%'.$search.'%');
            })
            ->paginate(10)->withQueryString()
            ->through(fn($landlord)=>[
                'id'=>$landlord->id,
                'name'=>$landlord->name,
                'last_name'=>$landlord->last_name,
                'email'=>$landlord->email,
                'cellphone'=>$landlord->cellphone,
                'status'=>$landlord->status
            ]);
        $filters=request()->only(['search']);
        return  inertia::render('admin.users.landlords.index', compact('landlords','filters'));
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
        $landlord=Landlord::findOrFail($id);

        return inertia::render('admin.users.landlords.show', compact('landlord'));
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

        $landlord=Landlord::findOrFail($id);
        if ($landlord->status){
            $landlord->update(['status'=>0]);
            activity()
                ->causedBy(Auth::user())
                ->performedOn($landlord)
                ->useLog('updated')
                ->log('Disabled ' .$landlord->name. ' account');
        }else{
            $landlord->update(['status'=>1]);
            activity()
                ->causedBy(Auth::user())
                ->performedOn($landlord)
                ->useLog('updated')
                ->log('Enabled ' .$landlord->name. ' account');
        }

        return redirect()->back();

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
