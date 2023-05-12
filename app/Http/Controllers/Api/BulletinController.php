<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bulletin;

class BulletinController extends Controller
{
    public function index()
    {
        $bulletins = Bulletin::paginate(request('per_page'));
        return response()->json($bulletins);
    }

    public function getBulletins(Request $request)
    {
        $perPage = 10;
        $page = $request->input('page', 1);

        $bulletins = Bulletin::paginate($perPage, ['*'], 'page', $page);

        return response()->json($bulletins);
    }
    public function getBulletin(Request $request)
    {
        $bulletin = Bulletin::where('id', $request->id)->first();

        return response()->json($bulletin);
    }
    public function getNewBulletins()
    {
        $bulletins = Bulletin::orderByDesc('date')->take(4)->get();

        return response()->json($bulletins);
    }
}
