<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use phpseclib\Crypt\RSA;

class CheckEncryptionRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /* $unencryptedData = $value;
        $rsa = new RSA();
       
        $publicKey = file_get_contents(base_path() . DIRECTORY_SEPARATOR . 'Publickey.php');
        $rsa->loadKey($publicKey);
        $rsa->setPublicKey();

        $text = $unencryptedData;
        $ciperText = $rsa->encrypt($text);

        $privateKey = file_get_contents(base_path() . DIRECTORY_SEPARATOR . 'Privatekey.php');
        $rsa->loadKey($privateKey);

        dd($rsa->decrypt($ciperText)); */
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
