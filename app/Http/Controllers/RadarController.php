<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Radar;
use App\Statistic;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
class RadarController extends Controller
{
   public function getRadars(){
    self::filterRadars();
    $radars = Radar::get();
      
    return response()->json($radars);
   }
   public function addRadar(){
    $statistic = Statistic::find(1);
    $statistic->all_markers = $statistic->all_markers + 1;
    $statistic->save();

    self::filterRadars();
    $lat = Input::get('lat');
    $lng = Input::get('lng');
    $radar = new Radar();
    $radar->lat = $lat;
    $radar->lng = $lng;
    $radar->save();
    return response()->json($radar);
   
   }
   public function filterRadars(){
    $radar = Radar::get();
    $time = Carbon::now();
    $time2 = new Carbon('2017-12-15 18:27:54');
    //dd($time->diffInMinutes($time2));
    foreach($radar as $r){
      $total = $time->diffInMinutes($r->created_at);
    if($total>19){
      $r->delete();
   }
   
}
   
   
}
public function getStatistic(){
  $statistic = Statistic::get();
  return response()->json($statistic);
}
}