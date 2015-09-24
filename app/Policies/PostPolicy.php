<?php

namespace App\Policies;

class PostPolicy
{

    //Este es en el caso que queremos que un admin tenga acceso a todos los post
    //pero si es admisnitrador este tendra acceso a todo el sistema por tanto
    //lo vamos a declarar dentro del servicesProvider
    /*public function before ($user, $post)
    {
       if($user->isAdmin())
       {
           return true;
       }
        if($user->isGuest())
        {
            return false;
        }
    }*/

    public function update ($user, $post)
    {
        return $user->isAuthor($post);
    }
}
