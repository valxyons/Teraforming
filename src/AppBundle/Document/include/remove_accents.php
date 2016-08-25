<?php
/**
 * Created by PhpStorm.
 * User: valentin
 * Date: 25/08/16
 * Time: 18:52
 */

function remove_accents($str, $encoding = 'utf-8')
{
    $str = htmlentities($str, ENT_NOQUOTES, $encoding);

    $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);

    // Remplacer les ligatures tel que : Œ, Æ ...
    // Exemple "Å“" => "oe"
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    // Supprimer tout le reste
    $str = preg_replace('#&[^;]+;#', '', $str);
    // Supprimer les espaces
    $str = preg_replace('/\s/', '', $str);
    $str = preg_replace("/[^a-zA-Z0-9]+/", "", $str);

    return $str;
}
