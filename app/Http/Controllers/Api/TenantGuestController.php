<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantAppointmentUpdateRequest;
use App\Http\Requests\Tenant\TenantCreateAppointmentRequest;
use App\Http\Requests\Tenant\TenantCreateGuestRequest;
use App\Http\Requests\Tenant\TenantUpdateGuestRequest;
use App\Models\Appointment;
use App\Models\Guest;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TenantGuestController extends Controller
{
    //show guest

    public function showGuest($id){
       $tenant=Tenant::find($id);
       if ($tenant){
            $guests=$tenant->guests()->get();
           if ($guests){
               return response()
                   ->json([
                       'message'=>'Guest list retrieved successfully',
                       'guests'=>$guests
                   ], 404);
           }else{
               return response()
                   ->json([
                       'message'=>'The tenant has no guest list'
                   ], 500);
           }
       }else{
           return response()
               ->json([
                   'message'=>'The tenant does not exist in our database'
               ], 404);
       }
    }

    //add guest list

    public function createGuest(TenantCreateGuestRequest $request, $id){

        $tenant=Tenant::find($id);
        if ($tenant){
            $guest=$tenant->guest()->create([
                'name'=>$request->name,
                'identification_type'=>$request->identification_type,
                'identification_number'=>$request->identification_number,
                'email_address'=>$request->email_address,
                'cellphone_one'=>$request->cellphone_one,
                'cellphone_two'=>$request->cellphone_two,
                'address'=>$request->address,
                'vehicle_reg'=>$request->vehicle_reg,

            ]);
            if ($guest){
                return response()
                    ->json([
                        'message'=>'The guest has been successfully created',
                        'guest'=>$guest
                    ], 200);
            }else{
                return response()
                    ->json([
                        'message'=>'There was an error adding guest'
                    ], 500);
            }


        }else{
            return response()
                ->json([
                    'message'=>'The tenant does not exist in our database'
                ], 404);
        }

    }

    //update guest details here

    public function updateGuest(TenantUpdateGuestRequest $request,$id,$guest){
       $guest=Guest::where('id',$guest)->where('tenant_id',$id)->first();
        if ($guest){
           $guest->update([
               'name'=>$request->name,
               'identification_type'=>$request->identification_type,
               'identification_number'=>$request->identification_number,
               'email_address'=>$request->email_address,
               'cellphone_one'=>$request->cellphone_one,
               'cellphone_two'=>$request->cellphone_two,
               'address'=>$request->address,
               'vehicle_reg'=>$request->vehicle_reg,
           ]);
            return response()
                ->json([
                    'message'=>'The guest has been successfully updated',
                    'guest'=>$guest
                ], 200);
        }else{
            return response()
                ->json([
                    'message'=>'The guest does not exist in our database.Please check the tenant Id and Guest Id provided and try again'

                ], 404);
        }
    }

    //Delete Guest details from database

    public function destroyGuest($id, $guest){
        $guest=Guest::where('id',$guest)->where('tenant_id',$id)->first();

        if ($guest){
            $guest->delete();
            return response()
                ->json([
                    'message'=>'The guest has been successfully deleted!',
                ], 200);
        }else{
            return response()
                ->json([
                    'message'=>'The guest does not exist in our database.Please check the tenant Id and Guest Id provided and try again'

                ], 404);
        }
    }

    /*
     * Appointment
     * create, update and delete
     */

    public function createAppointment(TenantCreateAppointmentRequest $request,$id){
        $tenant=Tenant::find($id);

        if ($tenant){

            $appointment=$tenant->appointments()->create([
                'guest_id'=>$request->guest_id,
                //remember to change property and unit id when models are done
                'unit_id'=>1,
                'property_id'=>1,
                'appointment_date'=>$request->appointment_date,
                'appointment_end_date'=>$request->appointment_end_date,
                'appointment_number'=>Str::upper(Str::random(6)),
                'appointment_status_id'=>1
            ]);
            if ($appointment){
                return response()
                    ->json([
                        'message'=>'The appointment has been successfully created',
                        'appointment'=>$appointment
                    ], 200);
            }else{
                return response()
                    ->json([
                        'message'=>'There was an error adding appointment'
                    ], 500);
            }

        }else{
            return response()
                ->json([
                    'message'=>'The appointment does not exist in our database.Please check the appointment Id'

                ], 404);
        }
    }


    public function showAppointment($id){
        $tenant=Tenant::find($id);

        if ($tenant){

            $appointments=$tenant->appointments()->get();
            if ($appointments){
                return response()
                    ->json([
                        'message'=>'The appointment list has been successfully retrieved',
                        'appointments'=>$appointments
                    ], 200);
            }else{
                return response()
                    ->json([
                        'message'=>'The tenant has not created any appointments'
                    ], 200);
            }

        }else{
            return response()
                ->json([
                    'message'=>'The tenant does not exist in our database.Please check the tenant Id'

                ], 404);
        }
    }

    public function updateAppointment(TenantAppointmentUpdateRequest $request,$id){
     $appointment=Appointment::find($id);
     if ($appointment){
         $appointment->update([
             'guest_id'=>$request->guest_id,
             'appointment_date'=>$request->appointment_date,
             'appointment_end_date'=>$request->appointment_end_date
         ]);
         if ($appointment){
             return response()
                 ->json([
                     'message'=>'The appointment has been successfully updated',
                     'appointment'=>$appointment
                 ], 200);
         }else{
             return response()
                 ->json([
                     'message'=>'There was an error updating appointment'
                 ], 500);
         }
     }else{
         return response()
             ->json([
                 'message'=>'The appointment does not exist in our database.Please check the appointment Id'

             ], 404);
     }
    }

    public function destroyAppointment($id){
        $appointment=Appointment::find($id);

        if ($appointment){
            $appointment->delete();
            return response()
                ->json([
                    'message'=>'The appointment has been successfully deleted!',
                ], 200);
        }else{
            return response()
                ->json([
                    'message'=>'The appointment does not exist in our database.Please check the appointment Id'

                ], 404);
        }
    }

}
