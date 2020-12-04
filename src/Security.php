<?php 

namespace App;

use App\Entity\Users;
use App\Services\Session;

class Security 
{

    public function __invoke()
    {
        $user = (new Session)->getLoggedUser();
        if (is_admin()) {
            if (!$user instanceof Users || ($user instanceof Users && $user->getRole() !== "admin")) {
                return "Unauthorized";
            }
        }
    }

}