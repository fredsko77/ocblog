<?php 

namespace App;

use App\Controller\AbstractController;
use App\Controller\Admin\DashboardController;
use App\Entity\Users;
use App\Services\Session;

class Security extends AbstractController 
{

    public function __invoke()
    {
        $user = (new Session)->getLoggedUser();
        if (is_admin()) {
            if ( !(new Session)->isLoggedUser() ) {
                return $this->redirect( generate_url('auth.login') );
            }
            if (!$user instanceof Users || ($user instanceof Users && $user->getRole() !== "admin")) {
                return "Unauthorized";
            }
        }
        if (get_current_url() === "/admin") {
            return (new DashboardController)->index();
        }
    }

}