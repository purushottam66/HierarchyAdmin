<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('generate_menu')) {
    function generate_menu($hierarchy, $parent_id = null) {
        $menu = '';
        foreach ($hierarchy as $item) {
            if ($item['reporting_to'] == $parent_id) {
                $menu .= '<li>';
                $menu .= '<a href="javascript:void(0);"><span class="nav-title">' . $item['name'] . ' (' . $item['role'] . ')</span></a>';
                $submenu = generate_menu($hierarchy, $item['user_id']);
                if ($submenu) {
                    $menu .= '<ul>' . $submenu . '</ul>';
                }
                $menu .= '</li>';
            }
        }
        return $menu;
    }
}