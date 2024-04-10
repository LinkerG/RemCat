<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\TestEvent;

class TestEventController extends Controller
{
    function testingEvent(){
        event(new TestEvent());

        return view("shareLocation");
    }
}
