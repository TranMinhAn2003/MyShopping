<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;


class AjaxController extends Controller
{
public function changeStatus(Request $request)
    {
$post=$request->input();
$changes='\App\Services\\'.ucfirst($post['model']).'Service';
if (class_exists($changes)){
    $change=app($changes);
    }
    $flag=$change->updateStatus($post);
        return response()->json(['flag'=>$flag]);
    }


}

