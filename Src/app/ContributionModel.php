<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User as User;
use Auth;

class ContributionModel extends Model {

    protected $table = 'contribution';
    protected $fillable = [
        'id_user', 'id_project', 'confirmation',
    ];

    public function ConfirmContribution($id) {
        
    }

    public function TrueIfSent($id_project, $id_user) {

        $querry = DB::table('contribution')->where([
                    ['id_user', '=', $id_user],
                    ['id_project', '=', $id_project],
                ])
                ->get();

        if ($querry->count()) {
            return '1';
        }

        return '0';
    }

    public function TrueIfConfirm($id_project, $id_user) {
        $querry = DB::table('contribution')->where([
                    ['id_user', '=', $id_user],
                    ['id_project', '=', $id_project],
                ])
                ->first();

        if ($querry) {
            if ($querry->confirmation == 1) {
                return '1';
            } else {
                return '0';
            }
        }
    }

    public function GetNotificationContribution($id_user) {

        $querry = DB::table('projects')
                ->join('contribution', 'projects.id', '=',
                        'contribution.id_project')
                ->join('users', 'contribution.id_user', '=', 'users.id')
                ->select('projects.name', 'users.name as usersName',
                        'contribution.created_at as notificationTime',
                        'users.id as idUser', 'projects.id as idProject')
                ->where('contribution.id_user', '!=', $id_user)
                ->where('contribution.confirmation', '=', '1')
                ->where('projects.id_user', '=', $id_user)
                ->paginate(10);
        return $querry;
    }

    public function GetNotificationDescription($idProject, $idUser) {
        $querry = DB::table('projects')
                ->join('contribution', 'projects.id', '=',
                        'contribution.id_project')
                ->join('users', 'contribution.id_user', '=', 'users.id')
                ->select('projects.name', 'projects.created_at',
                        'projects.description', 'users.name as usersName',
                        'users.email', 'users.id as idUser',
                        'projects.id as idProject', 'contribution.id')
                ->where([
                    ['contribution.id_user', '=', $idUser],
                    ['projects.id', '=', $idProject],
                ])
                ->first();
        return $querry;
    }

 public function GetProjectOfContributor($id) {
  

   $querry1 = DB::table('projects')->where([
                    ['id_user', '=', $id]])
                ->get();
                return $querry1;

 }

    public static function GetCount() {
        $querry = DB::table('projects')
                ->join('contribution', 'projects.id', '=',
                        'contribution.id_project')
                ->join('users', 'contribution.id_user', '=', 'users.id')
                ->select('projects.name', 'users.name as usersName',
                        'contribution.created_at as notificationTime',
                        'users.id as idUser', 'projects.id as idProject')
                ->where('contribution.id_user', '!=', Auth::user()->id)
                ->where('contribution.confirmation', '=', '1')
                ->where('projects.id_user', '=', Auth::user()->id)
                ->paginate(3);
        return $querry;
    }

    public function searchContributedProject($search) {
        $user = User::find(Auth::user()->id);
        $contributed_projects = DB::table('projects')
                ->join('contribution', 'contribution.id_project', '=',
                        'projects.id')
                ->where('contribution.id_user', '=', $user->id)
                ->where('contribution.confirmation', '=', 0)
                ->where('projects.name', 'like', '%' . $search . '%')
                ->orWhere('projects.description', 'like', "%" . $search . "%")
                ->groupBy('projects.id')
                ->paginate(5);

        return $contributed_projects;
    }

    public function developers() {
        return $this->belongsTo('App\User', 'id_user');
    }
}
