<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cluster;
use App\Models\GeographicArea;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        return view('admin.users.index');
    }

    public function edit(User $user){

        $profile = $user->profile;

        $clusters = Cluster::all();

        $delegates = User::role(['admin', 'super-admin'])->get();

        $geographicAreas = GeographicArea::all();

        return view('admin.users.edit', compact('user', 'profile', 'clusters', 'delegates', 'geographicAreas'));
    }

    public function update(Request $request, User $user){
        $request->validate([
            'sap_number' => 'required|numeric',
            'crm_number' => 'required|numeric',
            'cluster_id' => 'required|numeric|exists:clusters,id',
            'delegate_id' => 'required|numeric|exists:users,id',
            'geographic_area_id' => 'required|numeric|exists:geographic_areas,id',
            'max_orders_per_month' => 'required|numeric',
            'unlimited' => 'required|boolean',
            'sales_org' => 'required|string',
        ]);

        $user->profile->update($request->all());

        if (!$user->active) {
            $user->active = true;
            $user->save();
        }

        return redirect()->route('admin.users.edit', $user)
            ->with('flash.banner', 'La información del usuario ha sido actualizada.');
    }

    public function ban(User $user){

        if ($user->isBanned()) {
            
            $user->unban();

            session()->flash('flash.banner', 'El usuario ha sido desbloqueado.');

        }else{

            $user->ban([
                'expired_at' => now()->addDays(30),
            ]);

            session()->flash('flash.banner', 'El usuario ha sido bloqueado por 30 días.');

        }
        
        
        return redirect()->route('admin.users.index');
    }

}
