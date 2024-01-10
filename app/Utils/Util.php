<?php
namespace App\Utils;

use Storage;
use DB;
use App\Models\Currency;

class Util
{

    public function getPermissions($user)
    {
        $permissions = [];
        foreach ($user->permissions()->get() as $perm) {
            $permissions[] = $perm->name;
        }
        return $permissions;
    }

    

}
