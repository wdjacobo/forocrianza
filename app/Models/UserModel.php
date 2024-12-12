<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

// Cambiado el UserProvider en Auth.php por este modelo en lugar del que trae Shield por defecto
class UserModel extends ShieldUserModel
{

    protected $useSoftDeletes = false; // Desactivamos soft deletes
}
