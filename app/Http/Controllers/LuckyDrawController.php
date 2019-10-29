<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LuckyDraw;
use Illuminate\Support\Facades\DB;

class LuckyDrawController extends Controller
{
    public function index(){

        return view('machine.system');
    }

    public function members(){
        $members = DB::table('members')
            ->join('members_numbers', 'members.id', '=', 'members_numbers.member_id')
            ->select('members.*', 'members_numbers.*')
            ->get();

        return view('members.index', compact('members'));
    }

    public function store(Request $request){
        $lucky_number = LuckyDraw::create($request->except('_token'));

        Flash::success('Lucky number saved successfully.');

        return view('machine.system');
    }

    public function draw(Request $request){

        $members = DB::table('members')
            ->join('members_numbers', 'members.id', '=', 'members_numbers.member_id')
            ->select('members.*', 'members_numbers.*')
            ->get();

        if($request['type'] == '1st') {
            $number_array = [];
            foreach ($members as $member) {
                array_push($number_array, $member->member_id);
            }
            $count = array_count_values($number_array);
            $max = array_keys($count, max($count));
            $winner = array_rand($max);

            $lucky = DB::table('members')->where('id', $max[$winner])->get();

            return response()->json($lucky[0]->name);
        }else{
            $number_array = [];
            foreach ($members as $member) {
                array_push($number_array, $member->winning_number);
            }
            $winner = array_rand($number_array);

            return response()->json($number_array[$winner]);
        }
    }
}
