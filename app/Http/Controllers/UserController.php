<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class UserController extends Controller
{
    public function index(UserRequest $request){
        return Response::json($request);
    }
}
