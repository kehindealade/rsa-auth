<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use phpseclib\Crypt\RSA;
use App\Admin;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function login()
    {
        return view('admin.auth.login');
    }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function loginadmin(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

        $rsa = new RSA();
      
        
       $publicKey = file_get_contents(base_path() . DIRECTORY_SEPARATOR . 'Publickey.php');
       $rsa->loadKey($publicKey); //Load the public key
       $rsa->setPublicKey(); 

       $text = $request->password; //The user's entered password
       $ciperText = $rsa->encrypt($text); //Encrypt the user's entered password from login form

       $privateKey = file_get_contents(base_path() . DIRECTORY_SEPARATOR . 'Privatekey.php');
       $rsa->loadKey($privateKey); //Load the private key

       $checkEmail = Admin::where('email', $request->email)->first(); //Check if the user's entered email is correct

       if($checkEmail != null){ //If correct
         $pwdFromDb = $checkEmail->password; //Saved RSA Hash from the Database for the user
         $pwdFromForm = $ciperText; //RSA hash from the user's login form input

        $checkedDb = $rsa->decrypt($pwdFromDb); //Decrypt the RSA HASH from the database
        $checkedForm = ($rsa->decrypt($pwdFromForm)); //Decrypt the RSA hash from the user's input 

        if($checkedDb == $checkedForm){ // Checks if they are equal , if equal, G2G
          Auth::guard('admin')->loginUsingId($checkEmail->id, true); //Login the user manually
          return redirect()->intended(route('admin.dashboard')); 
        }else{
          return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors("Credentials incorrect");
         }

       }else{
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors("Credentials incorrect");
       }
    }

     public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.auth.login');
    }
}
