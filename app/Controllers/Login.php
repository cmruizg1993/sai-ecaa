<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use \Firebase\JWT\JWT;

class Login extends BaseController
{
    use ResponseTrait;
    
    public function index()
    {
        helper('encryption');  
        $userModel = new UserModel();
  
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
          
        $user = $userModel->where('user', $username)->first();
        
        if(is_null($user)) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }

        //$hash  = password_hash($password, PASSWORD_DEFAULT);

        $hash = $user['password'];
        $pwd_verify = password_verify($password, $hash);

        //$pwd_verify = $user['password'] == encrypt($password);
  
        if(!$pwd_verify) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }
        
        $key = $_ENV['JWT_SECRET'];
        $iat = time(); // current timestamp value
        $exp = $iat + 2592000;
        //return $this->respond($key);
        $payload = array(
            "iss" => "SAI_ECAA",
            "aud" => "SAI_ECAA_APP",
            "sub" => "Authentication",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "user_id" => $user['id'],
            "username" => $user['user']
        );
         
        $token = JWT::encode($payload, $key, 'HS256');
 
        $response = [
            'token' => $token,
            'expires_at'=> $exp
        ];
         
        return $this->respond($response, 200);
    }
}
