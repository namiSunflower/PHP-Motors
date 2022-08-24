<?php
    /**
     * This is the main controller
     */
    // Create or access a Session
    session_start();
    // Get the database connection file
    require_once 'library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once 'model/main-model.php';
    //Get the functions library
    require_once 'library/functions.php';


    // Get the array of classifications
    $classifications = getClassifications();

    //var_dump($classifications);
    //exit;
    $navList = createNavList($classifications);
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($action == NULL){
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    // Check if the firstname cookie exists, get its value
    if(isset($_COOKIE['firstname'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    switch ($action){
        case 'something': 
        break;
        default:
         include 'view/home.php';
     }


?>