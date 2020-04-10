<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use phpseclib\Crypt\RSA;

class AdminController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');
    }

    public function getDashboard(){
    	return view('admin.dashboard');
    }

    public function showSecureForm(){
        return view('secure');
    }
    public function validateSecure(Request $request){
        try{
        $rsa = new RSA();
       
        $privateKey = file_get_contents(base_path() . DIRECTORY_SEPARATOR . 'Privatekey.php');
        $rsa->loadKey($privateKey);
        $key = '0x' . $request->payload;
        $decryptedData = $rsa->decrypt($request->payload);
        
        echo $decryptedData;
        
        }catch(\Throwable $error){
            return redirect()->back()->withErrors("Wrong Encrypted Key");
        }
    }

    
}
