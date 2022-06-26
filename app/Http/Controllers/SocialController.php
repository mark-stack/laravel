<?php
 
namespace App\Http\Controllers;
 
use Socialite;
use App\Models\User;
use Auth;


class SocialController extends Controller{

    public function redirect_google(){

        //redirect
        return Socialite::driver('google')->redirect();
    }

    public function callback_google(){
        
        //$getInfo = Socialite::driver('google')->user();
        $getInfo = Socialite::driver('google')->stateless()->user();

        //Response is array of USER,REDIRECT,FLASH MSG
        $user = $this->createUser($getInfo);

        auth()->login($user);
        
        //User was created
        if($user != null){

            if(Auth::user()->isAdmin()){
                return redirect()->to('/admin');
            }

            if(Auth::user()->isUser()){
                //check session for remembering project from landing page
                $project = session('project');

                if($project){
                    return redirect('/user/'.$project);
                }
                else{
                    return redirect('/user');
                }
            }
        }
        //User not created
        else{
            return redirect('/');
        }
    }

    public function redirect_linkedin(){

        //redirect
        return Socialite::driver('linkedin')->redirect();
    }

    public function callback_linkedin(){
        
        $getInfo = Socialite::driver('linkedin')->stateless()->user();
        
        //Response is array of USER,REDIRECT,FLASH MSG
        $user = $this->createUser($getInfo);
        

        auth()->login($user);
        
        //User was created
        if($user != null){

            if(Auth::user()->isAdmin()){
                return redirect()->to('/admin');
            }

            if(Auth::user()->isUser()){
                //check session for remembering project from landing page
                $project = session('project');

                if($project){
                    return redirect('/user/'.$project);
                }
                else{
                    return redirect('/user');
                }
                
            }
        }
        //User not created
        else{
            return redirect('/');
        }
    }

    function createUser($getInfo){
    
        $user = User::where('email', $getInfo->email)->first();
       
        if (!$user) {
            
            $first_name = explode(' ',$getInfo->name)[0];
            $last_name = explode(' ',$getInfo->name)[1];

            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'first_name' => $first_name,
                'last_name' => $last_name,
            ]);

        }

        return $user;
    }

}

