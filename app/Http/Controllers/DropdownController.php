<?php
namespace App\Models;



namespace App\Http\Controllers;




use App\Models\User;
use App\Models\Avto;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DropdownController extends Controller
{


    public function index()
    {
        $users = User::get_users();
        $avto = Avto::on_parking();
        $user_count = User::get_user_count();
        if($user_count == 0 ){
            return view('sign');
        }
        else {
            return view('parking', compact('users') , compact('avto'));
        }

    }

    public function data(Request $request)
    {

        if ($request->has('cat_id')) {
            if ($request->has('cat_id')) {
                $parentId = $request->get('cat_id');
                $data = Avto::off_parking($parentId);
                return $data;
            }

        }
    }

    public function avto(Request $request)
    {
        $users = User::get_users();
        Avto::status_on($request);
        $avto = Avto::on_parking();
        return view('parking', compact('users') , compact('avto'));
    }

    public function avto_out(avto $avt)
    {
        $users = User::get_users();
        Avto::status_off($avt);
        $avto = Avto::on_parking();
        return view('parking', compact('users') , compact('avto'));

    }

}

