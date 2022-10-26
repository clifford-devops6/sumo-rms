<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Activitylog\Models\Activity;

class AdminLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $activities = Activity::query()
            ->when(request('search'),function ($query,$search){
                $query->where('log_name','like', '%'.$search.'%');
            })->orderBy('created_at','ASC')
            ->paginate(10)->withQueryString()
            ->through(fn($activity)=>[
                'id'=>$activity->id,
                'name'=>$activity->log_name,
                'description'=>$activity->description,
                'event'=>$activity->event,
                'created_at'=>$activity->created_at,
                'subject'=>$activity->subject->name,
                'causer'=>$activity->causer->name,


            ]);;

          $filters=request()->only(['search']);


        return  inertia::render('admin.activity-logs.index', compact('activities','filters'));
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
        $activity=Activity::findOrFail($id);

        dd($activity->subject);
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
