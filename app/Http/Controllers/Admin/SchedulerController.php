<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Offer;
use App\Models\Room;
use App\Models\Lesson;

class SchedulerController extends Controller
{
    //

    public function index(Request $request){
        $offerId=$request->offerId;
        $offer=Offer::find($offerId);
        return Inertia::render('Admin/Scheduler',[
            'offer'=>$offer
        ]);
    }

    public function availableRooms(Request $request){
        $offer=$request->all()['offer'];
        $dates=$request->all()['dates'];

        $roomTypes=array_unique(array_column($dates,'room_type'));
        $dayOfWeeks=array_unique(array_column($dates,'dow'));
        $rooms=Room::whereIn('type',$roomTypes)->where('seat', '>=', $offer['seat'])->get();
        foreach($dates as $i=>$d){
            $dates[$i]['rooms']=Lesson::whereBetween('start_at',[$d['start_time'],$d['end_time']])
                ->orWhereBetween('finish_at',[$d['start_time'],$d['end_time']])
                ->get();
            $dates[$i]['selected']=[];
        };
        return response()->json([
            'rooms'=>$rooms,
            'selectedDates'=>$dates
        ]);
    }
}
