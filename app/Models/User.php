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

    public static function avto_create($request , $user){

            return DB::table('avtos')->insert(['marka' => $request->get('marka'),
                                                    'model' => $request->get('model'),
                                                    'color' => $request->get('color'),
                                                    'gos_num' => $request->get('gos_num'),
                                                    'user_id' => $user->id,]);
    }


    public static function show_avtos($user){
        $avtos = DB::table('avtos')->where('user_id' ,'=' , $user->id)->get();
        return $avtos;
    }


    public static function up_user($request , $user){
        DB::table('users')->where('id','=',$user->id)->update($request->only(['family','name','name_father','telephone'/*,'gender'*/,'adress']));
    }

    public static function up_avto($request , $avto){
       DB::table('avtos')->where('id','=',$avto->id)->update($request->only(['marka','model','color','gos_num']));
    }

    public static function delete_user($user){
         DB::table('users')->where('id','=',$user->id)->delete();
    }

    public static function delete_avto($avto){
         DB::table('avtos')->where('id','=',$avto)->delete();
    }


    public static function av_where_us($user){
        $avtos = DB::table('avtos')->where('user_id','=',$user->id)->get();
        return $avtos;
    }

    public static function on_parking(){
        $avto = DB::table('avtos')->where('status','=',1)->get();
        return $avto;
    }

    public static function status_on($request){
        $avto = DB::table('avtos')->where('id','=',$request->subcategory_id)->update(['status' => 1]);
        return $avto;
    }
    public static function status_off($avt){
        $avto = DB::table('avtos')->where('id','=',$avt->id)->update(['status' => 0]);
        return $avto;
    }
}
