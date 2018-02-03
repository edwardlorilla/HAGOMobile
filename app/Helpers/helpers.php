<?php
namespace App\Helpers;
use App\User;

/**
 * Created by PhpStorm.
 * User: Lorilla
 * Date: 14/10/2017
 * Time: 2:16 AM
 */
function check($firebase)
{
    return 2 === User::where('firebase_uid', $firebase)->first()->role_id;
}
?>