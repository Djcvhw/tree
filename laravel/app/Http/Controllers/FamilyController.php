<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Family;
use App\Unit;

class FamilyController extends Controller
{
    public function index()
    {
        return view('index', ['title' => 'Главная', 'families' => Family::all(), 'units' => Unit::all()]);
    }
    public function create_family(Request $request)
    {
        if($request->ajax()){
            $family = Family::create($request->all());
            return json_encode(array('message' => 'Семья создана', 'family' => $family));
        }
        return json_encode('message', 'Bad response');
    }

    public function create_unit(Request $request)
    {
        if ($request->ajax()) {
            $unit = Unit::create($request->all());
            return json_encode(array('message' => 'Человек создан', 'unit' => $unit));
        }
        return json_encode('message', 'Bad response');
    }

    private function get_parents($id, &$resarray, $p1, $p2)
    {
        $punit = Unit::where('id', '=', $p1)->orWhere('id', '=', $p2)->get()->toArray();
        foreach ($punit as $key => $value) {
            $resarray[] = $value;
            FamilyController::get_parents($value['id'], $resarray, $value['parent_1'], $value['parent_2']);
            if (($p1 != 0) && ($p2 != 0) && $value['parent_1'] != 0 && $value['parent_2'] != 0){
                $super = 'select * from unit where (((parent_1='.$value['parent_1'].') and (parent_2 = '.$value['parent_2'].')) OR ((parent_1='.$value['parent_2'].') and (parent_2 = '.$value['parent_1'].'))) AND id <> '.$value['id'];
                $cunit = DB::select($super);
                foreach ($cunit as $key1 => $value1) {
                    $resarray[] = json_decode(json_encode($value1), true);
                }
            }
        }
    }

    public function get_tree($id)
    {
        $resarray = array();
        $unit = Unit::where('id', '=', $id)->get()->toArray();
        $resarray[] = $unit[0];
        $super = 'select * from unit where (((parent_1='.$unit[0]['parent_1'].') and (parent_2 = '.$unit[0]['parent_2'].')) OR ((parent_1='.$unit[0]['parent_2'].') and (parent_2 = '.$unit[0]['parent_1'].'))) AND id <> '.$unit[0]['id'];
        $cunit = DB::select($super);
        foreach ($cunit as $key => $value) {
            $resarray[] = json_decode(json_encode($value), true);
        }
        FamilyController::get_parents($id, $resarray, $unit[0]['parent_1'], $unit[0]['parent_2']);
        for ($i=0; $i < count($resarray); $i++) { 
            $id = $resarray[$i]['id'];
            $resarray[$i]['id'] = -$i;
            if ($resarray[$i]['parent_1'] == 0) {
                $resarray[$i]['parent_1'] = 'void';
            }
            if ($resarray[$i]['parent_2'] == 0) {
                $resarray[$i]['parent_2'] = 'void';
            }
            for ($j=0; $j < count($resarray); $j++) { 
                if($resarray[$j]['parent_1'] == $id && $resarray[$j]['parent_1'] >= 0){
                    $resarray[$j]['parent_1'] = -$i;
                }
                if($resarray[$j]['parent_2'] == $id && $resarray[$j]['parent_2'] >= 0){
                    $resarray[$j]['parent_2'] = -$i;
                }
            }
        }
        for ($i=0; $i < count($resarray); $i++) { 
            if($resarray[$i]['parent_1'] < 0){
                $resarray[$i]['parent_1'] = -$resarray[$i]['parent_1'];
            }
            if($resarray[$i]['parent_2'] < 0){
                $resarray[$i]['parent_2'] = -$resarray[$i]['parent_2'];
            }
            if ($resarray[$i]['id'] < 0) {
                $resarray[$i]['id'] = -$resarray[$i]['id'];
            }
        }
        return json_encode($resarray);
    }
}
