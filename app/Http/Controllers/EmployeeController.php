<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
class EmployeeController extends Controller
{
    //
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
    public function register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'c_password' => 'required|same:password',
        // ]);
   
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }
   
        $input = $request->all();
        $input['passwords'] = bcrypt($input['passwords']);
        $input['last_name'] = $input['last_name'];
        $input['first_name'] = $input['first_name'];
        $input['middle_name'] = $input['middle_name'];
        $input['address'] = $input['address'];
        $input['email'] = $input['email'];
        $input['department_id'] = $input['department_id'];
        $input['city_id'] = $input['city_id'];
        $input['state_id'] = $input['state_id'];
        $input['country_id'] = $input['country_id'];
        $input['zip'] = $input['zip'];
        $input['birthdate'] = $input['birthdate'];
        $input['date_hired'] = $input['date_hired'];
        $user = Employee::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
    public function edit(Request $request)
    {
        $input = $request->all();
        $update = DB::table('employees') ->where('id', $input['emp_id'])
        ->update( 
            [ 'last_name' => $input['last_name'],
               'first_name' => $input['first_name'],
                'middle_name' => $input['middle_name'],
                'address' => $input['address'], 
                'department_id' => $input['department_id'],
                'city_id' => $input['city_id'],
                'state_id' => $input['state_id'],
                'country_id' => $input['country_id'],
                'zip' => $input['zip'],
                'birthdate' => $input['birthdate'],
                'date_hired' => $input['date_hired'],
             ]
            );
            return $this->sendResponse($update, 'User updated successfully.');
    }
    public function login(Request $request)
    {
        // if(Auth::guard('api')->attempt(['last_name' => $request->last_name, 'password' => $request->password])){ 
        //     $user = Auth::user(); 
        //     $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        //     $success['name'] =  $user->name;
   
        //     return $this->sendResponse($success, 'User login successfully.');
        // } 
        // else{ 
        //     return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        // } 

        $user = Employee::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->passwords, $user->passwords)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function allEmp()
    {
        $products = Employee::all();
        if ($products) {
            return $this->sendResponse($products, 'Employee retrieved successfully.');
        } else {
            $response = ["message" =>'Token issue'];
            return response($response, 422);
        }
        
    }
}
