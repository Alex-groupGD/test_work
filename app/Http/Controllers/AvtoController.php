<?php

namespace App\Http\Controllers;
use App\Http\Controllers\UserController;
use App\Http\Requests\avto_request;
use App\Http\Requests\avtoup_request;
use App\Http\Requests\UserRequest;
use App\Models\avto;
use App\Models\User;
use Illuminate\Http\Request;

class AvtoController extends Controller
{
    public function create(User $user)
    {
        return view('avto_new' , compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\avto  $avto
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function edit(avto $avto)
    {
        return view('avto_new',compact('avto'));
    }

    public function update(avtoup_request $request, avto $avto)
    {
       /* $user = User::where('id','=',$avto->user_id)->get();*/
        User::up_avto($request,$avto);
        return redirect()->route('users.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */

    public function store(avto_request $request , User $user)
    {
        //foreach ($user as $use=>$value)
        $avtos = new User();
        $avtos::avto_create($request,$user);

        $avtos = User::av_where_us($user);
        return view('my_avto',compact('avtos'),compact('user'));
    }


    public function destroy($avto)
    {
        User::delete_avto($avto);
        return redirect()->route('users.index');
    }
}
