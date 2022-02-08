<?php

declare(strict_types=1);

namespace App\Services;
use App\Events\UserLoginEvent;
use App\Models\User;
use App\Contracts\Social;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User as BaseContract;

class SocialService implements Social
{

    /**
     * @param BaseContract $socialUser
     * @param string $network
     * @return string
     * @throws \Exception
     */
    public function loginUser(BaseContract $socialUser, string $network): string
    {
        $user = User::where('email', $socialUser->getEmail())->first();
        if($user){
            $user->name = $socialUser->getName();
            $user->avatar = $socialUser->getAvatar();

            if ($user->save()){
                \Auth::loginUsingId($user->id);
                return route('account');
            }
        } else {
            //регистрируем с данными вк
            $password = Hash::make(Factory::create()->password(8)); // отправить на почту пользователю или попросить поменять в лк
            $created = User::create(
                [
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'avatar'=>$socialUser->getAvatar(),
                    'password'=> $password
                ]
            );

            if($created){
                \Auth::loginUsingId($created->id);
                event(new UserLoginEvent($created));
                return route('account');
            }

            return route('register');
        }
    throw new \Exception("You get error was network: " . $network);

    }
}
