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






public function SaveContributionRequest($id,$id_user){
   
   



}



public function ConfirmContribution($id){

}



public function trueifsent($id_project,$id_user){

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


}
