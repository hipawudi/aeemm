<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bulletin;

class BulletinController extends Controller
{
    public function index(){
        $bulletins=Bulletin::paginate(request('per_page'));
        return response()->json($bulletins);
    }
}
