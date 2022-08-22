<?php

// var_dump($_GET['request']);

if(isset($_GET['request'])){
    if(!empty($_GET["request"])) {
        $routes = explode('/',$_GET['request']);
        $len = count($routes);
        $main_route = $routes[0];
        if($main_route == "ajax") {
            include("ajax-req.php");
        }
        else {
            $main_route = str_replace("-","_",$main_route);
            if(file_exists("view/$main_route.php")) {
                    if($len == 2 && !empty($routes[1])) {
                        if ($main_route == "del_ad" || $main_route == "edit_ad" || $main_route == "view_ad") {
                            $ad_id = $routes[1];
                            include("view/$main_route.php");
                        } 
                        elseif ($main_route == "del_user" || $main_route == "edit_user") {
                            $u_id = $routes[1];
                            include("view/$main_route.php");
                        }
                        elseif ($main_route == "del_as") {
                            $as_id = $routes[1];
                            include("view/$main_route.php");
                        }
                        else
                            include("view/404.php");
                    }
                    elseif ($len == 1 || empty($routes[1])) {
                        if ($main_route != "navbar" && $main_route != "login") {
                            include("view/header.php");
                            include("view/$main_route.php");
                        }
                        else
                            include("view/$main_route.php");

                    }
                }
                else {
                    include("view/404.php");
                }
            }
        }
        else {
            include("view/login.php");
        }
    }

?>