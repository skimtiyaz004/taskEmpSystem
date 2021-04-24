<?php

namespace App\Http\Controllers;

use App\Models\City;
use DB;
use App\Models\Cuntry;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\States;
 

class AdminController extends Controller
{
    public function EmployeeList()
    {
         
    }
    public function departmentList()
    {
        $departments=Department::all();
         return view('departments')->with(compact('departments'));
    }

    public function addDepartment(Request $request )
    {
        //  dd($request->name());
        $add= new Department();
        $add->name=$request->name;
        $add->save();
        return redirect()->back()->with('success','Department Added');
    }
    public function editDepartment($id,Request $request)
    {
         
        $update = DB::table('departments') ->where('id', $id)->update( [ 'name' => $request->name]);
        return redirect()->back()->with('success','Department Updated');
    }

    public function stateList()
    {
        $countries=Cuntry::all();
         
        $states = DB::table('states')
        ->join('cuntries', 'cuntries.id', '=', 'states.country_id')
        ->select('states.*', 'cuntries.name as cname')
        ->get();
        // dd($results);
        return view('states')->with(compact('countries','states'));
    }
    public function addState(Request $request)
    {
          $add=new States();
          $add->country_id=$request->cname;
          $add->name=$request->name;
          $add->save();
          return redirect()->back()->with('success','State Updated');
    }
    public function cityList()
    {
        $countries=Cuntry::all();
         
        $states = DB::table('states')
        ->join('cuntries', 'cuntries.id', '=', 'states.country_id')
        ->select('states.*', 'cuntries.name as cname')
        ->get();
        $cityList = DB::table('cities')
        ->join('states', 'cities.state_id', '=', 'states.id')
        ->select('cities.*', 'states.name as sname')
        ->get();
        //  dd($cityList);
        return view('city')->with(compact('countries','states','cityList'));
    }
    public function getStateByCountry($id)
    {
    //    $States=States::where();
       $States=DB::table('states')
       ->select('name','id')
       ->where('country_id',$id)
       ->get();
        echo json_encode($States);
    }
    public function addcity(Request $request)
    {
          $add=new City();
          $add->state_id=$request->sname;
          $add->name=$request->name;
          $add->save();
          return redirect()->back()->with('success','City Added');
    }
}
