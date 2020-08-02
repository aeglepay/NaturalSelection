<?php

use App\Models\Menu;

function menus($section = null)
{
    $menus_json = file_get_contents(base_path('menus.json'));
    $menus = json_decode($menus_json);

    return is_null($section) ? $menus : $menus[$section];
}

function header_menus()
{
    $menus = Menu::all();
    // usort($menus, function ($prev, $next) {
    //     return $next['order'] <=> $prev['order'];
    // });

    return $menus;
}

function icons($section = null)
{
    $icons_json = file_get_contents(base_path('icons.json'));
    $icons = json_decode($icons_json);

    return is_null($section) ? $icons : $icons[$section];
}

function resources($section = null)
{
    $resources_json = file_get_contents(base_path('resources.json'));
    $resources = json_decode($resources_json);

    return is_null($section) ? $resources : $resources[$section];
}

function api_resources($section = null)
{
    $resources_json = file_get_contents(base_path('api_resources.json'));
    $resources = json_decode($resources_json);

    return is_null($section) ? $resources : $resources[$section];
}
