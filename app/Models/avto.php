<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Avto extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'marka',
        'model',
        'color',
        'gos_num',


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


    public function user()
    {
        return $this->belongsTo(User::class );
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

    public static function up_avto($request , $avto){
        DB::table('avtos')->where('id','=',$avto->id)->update($request->only(['marka','model','color','gos_num']));
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

    public static function off_parking($parentId){
        $avto = DB::table('avtos')->where('user_id', $parentId)->where('status','=',0)->get();
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
    public static function  get_avto_count($avto){

        $user_id = DB::table('avtos')->where('id','=',$avto)->value('user_id');
        $user_count_avto = DB::table('avtos')->where('user_id','=',$user_id)->count();

      return $user_count_avto;
    }

    public static function get_user_id_avto($avto){
        return  DB::table('avtos')->where('id','=',$avto)->value('user_id');
    }
}





