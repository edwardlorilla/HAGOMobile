<?php
/**
 * Created by PhpStorm.
 * User: Lorilla
 * Date: 14/10/2017
 * Time: 2:16 AM
 */
function style_ts($path)
{
    try {
        $ts = '?v=' . File::lastModified(public_path() . $path);
    } catch (Exception $e) {
        $ts = '';
    }
    return '<link rel="stylesheet" href="' . $path . $ts . '">';
}
function script_ts($path)
{
    try {
        $ts = '?v=' . File::lastModified(public_path() . $path);
    } catch (Exception $e) {
        $ts = '';
    }
    return '<script type="text/javascript" src="'. $path . $ts .'"></script>';
}