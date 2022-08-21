<?php
    // var_dump($_GET['request']);

    if(isset($_GET['request'])){
        if(!empty($_GET["request"])) {
            $routes = explode('/',$_GET['request']);
            $len = count($routes);
            $main_route = $routes[0];
            if(file_exists("view/$main_route.php")) {
                if($len == 2 && !empty($routes[1])) {
                    if ($main_route == "del_ad" || $main_route == "edit_ad" || $main_route == "view_ad") {
                        $ad_id = $routes[1];
                        include("view/$main_route.php");
                    } 
                    else
                        include("view/404.php");
                }
                elseif ($len == 1 || empty($routes[1])) {
                    include("view/$main_route.php");
                }
            }
            else {
                include("view/404.php");
            }
        }
        else {
            include("view/login.php");
        }
    }

?>