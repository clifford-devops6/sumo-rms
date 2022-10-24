<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminUsersController extends Controller
{
    //retrieve managers

    public function managers(){
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
                'cellphone'=>$manager->cellphone
            ]);
        $filters=request()->only(['search']);

        return inertia::render('/admin/users/managers', compact('managers','filters'));
    }
}
