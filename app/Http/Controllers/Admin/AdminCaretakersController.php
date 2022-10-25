<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CaretakerCollection;
use App\Models\Caretaker;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminCaretakersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $caretakers=Caretaker::query()
            ->when(request('search'),function ($query,$search){
                $query->where('name','like', '%'.$search.'%');
            })
            ->paginate(10)->withQueryString()
            ->through(fn($caretaker)=>[
                'id'=>$caretaker->id,
                'name'=>$caretaker->name,
                'last_name'=>$caretaker->last_name,
                'email'=>$caretaker->email,
                'cellphone'=>$caretaker->cellphone,
                'status'=>$caretaker->status
            ]);
        $filters=request()->only(['search']);

        return inertia::render('admin.users.caretakers.index', compact('caretakers','filters'));
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

        $caretaker=Caretaker::findOrFail($id);
        return inertia::render('caretakers.show', compact('caretaker'));
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
        $caretaker=Caretaker::findOrFail($id);

        if ($caretaker->status){
            $caretaker->update(['status'=>0]);
        }else{
            $caretaker->update(['status'=>1]);
        }
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
