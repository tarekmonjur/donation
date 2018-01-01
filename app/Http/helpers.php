<?php
/**
 * Created by PhpStorm.
 * User: Tarek Monjur
 * Date: 12/13/2017
 * Time: 4:44 PM
 */

function canAccess($url)
{
    $permission = session('permissions');
    if(is_array($permission)) {
        if (in_array($url, $permission)) {
            return true;
        } else {
            return false;
        }
    }else{
        return false;
    }

}