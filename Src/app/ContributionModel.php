<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContributionModel extends Model
{
    
     protected $table = 'contribution';

      protected $fillable = [
        'id_user', 'id_project','confirmation',
    ];






public function ConfirmContribution($id){

}



public function TrueIfSent($id_project,$id_user){

 $querry = DB::table('contribution')->where([
                    ['id_user', '=', $id_user],
                    ['id_project', '=', $id_project],

                ])
               ->get();

               if($querry->count()){
               	   return '1';
               	}
               
        return '0';
}


public function TrueIfConfirm($id_project,$id_user){
  $querry = DB::table('contribution')->where([
                    ['id_user', '=', $id_user],
                    ['id_project', '=', $id_project],

                ])
               ->first();

               if($querry){
                   if($querry->confirmation==1){
                       return '1';
                 
                 }
                 else{
                  return '0';
                 }
                }
               
}



public function GetNotificationContribution($id_user){

 $querry= DB::table('projects')
            ->join('users', 'projects.id_user', '=', 'users.id')
            ->join('contribution', 'projects.id', '=', 'contribution.id_project')
            ->select('projects.name', 'projects.created_at','users.name as users_name','projects.description','projects.name','contribution.created_at as notification_time')
            ->where('contribution.id_user','=',$id_user)
            ->get();

return $querry;
}


}
