<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'family',
        'name_father',
        'telephone',
        'gehder',
        'adress',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avtos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(avto::class, 'user_id','id');
    }

    public function get_users()
    {
        return DB::table('users')->get();
    }

    public static function user_create($request){

        $user = DB::table('users')->insert($request->only(['family','name','name_father','telephone','gender','adress']));
        $user_id = DB::table('users')->where('telephone','=',$request->telephone)->get('id');
        foreach ($user_id as $user=>$value)
        return $value;
    }




    public static function up_user($request , $user){
        DB::table('users')->where('id','=',$user->id)->update($request->only(['family','name','name_father','telephone'/*,'gender'*/,'adress']));
    }


    public static function delete_user($user){
         DB::table('users')->where('id','=',$user->id)->delete();
    }

    public static function get_user_count(){
        return DB::table('users')->count();
    }

    public static function  get_users_avto($avto){

        $user_id = Avto::get_user_id_avto($avto);
        $user = DB::table('users')->where('id','=',$user_id)->value('id');

        return $user;
    }


}
