<?php

namespace App\Http\Controllers;

use App\Mail\Test;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class TestController extends BaseController {

    function test() {
        Mail::to('test@truc.fr')->send($t = new Test('toto'));

        return $t;
    }
}
