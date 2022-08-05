<?php

 namespace App\Http\Controllers\API;

 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 use App\Models\User;
 use Illuminate\Auth\Events\Logout;
 use Illuminate\Support\Facades\Auth;
 use Carbon\Carbon;


 class UserController extends Controller
 {

     public $successStatus = 200;

     public function login(){
       // valid only for 1 minutes
        // $timenow = Carbon::now();
        // return $timenow->diffInMinutes($this->created_at)  < 5;
         if(Auth::attempt(['nim' => request('nim'), 'password' => request('password')])){
             $user = Auth::user();
        //     $acces_token['token'] =  $user->createToken('nApp')->accessToken;
             $data['user'] = $user;
            //  $acces_token['token']->expires_at = Carbon::now()->addWeeks(5);
            //  $acces_token['token']->save();
             return response()->json([
                'data' => $data,
          //      'acces_token' => $acces_token,
                'pesan' => 'Login Berhasil',
                // 'token_type' => 'Bearer',
                // 'expires_at' => Carbon::parse($acces_token['token']->accesToken->expires_at)
            ], $this->successStatus);
         }
         else{
             return response()->json(['error'=>'DATA TIDAK ADA'], 401);
         }
     }

    //  public function register(Request $request)
    //  {
    //      $validated = Validator::make($request->all(), [
    //          'nim' => 'required',
    //          'email' => 'required|email',
    //          'password' => 'required',
    //          'c_password' => 'required|same:password',
    //      ]);

    //      if ($validated->fails()) {
    //          return response()->json(['error'=>$validated->errors()], 401);
    //      }

    //      $input = $request->all();
    //      $input['password'] = bcrypt($input['password']);
    //      $user = User::create($input);
    //      $success['token'] =  $user->createToken('nApp')->accessToken;
    //      $success['name'] =  $user->name;

    //      return response()->json(['success'=>$success], $this->successStatus);
    //  }

     public function details()
     {
         $user = Auth::user();
         return response()->json(['success' => $user], $this->successStatus);
     }

     public function logout(Request $request)
      {
        if (Auth::user()) {
            $user = Auth::user()->token();
            $user->revoke();

            return response()->json([
                'success' => false,
                'message' => 'Logout Successfully',
            ]);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Logout Failed',
            ]);
        }
     }

 }