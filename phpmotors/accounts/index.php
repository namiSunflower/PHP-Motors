<?php
    /**
     * This is the accounts controller
     */
    // Create or access a Session
    session_start();
    // Get the database connection file
    require_once '../library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once '../model/main-model.php';
    // Get the accounts model
    require_once '../model/accounts-model.php';
    //Get the functions library
    require_once '../library/functions.php';
    //Get the reviews model
    require_once '../model/reviews-model.php';


    // Get the array of classifications
    $classifications = getClassifications();

    //var_dump($classifications);
    //exit;
    
    $navList = createNavList($classifications);

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    switch ($action) {
        case 'register':
            // Filter and store the data
              $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
              $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
              $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
              $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            
            //Validate email & password
              $clientEmail = checkEmail($clientEmail);
              $checkPassword = checkPassword($clientPassword);

              $existingEmail = checkExistingEmail($clientEmail);

            // Check for existing email address in the table
              if($existingEmail){
                $message = '<p class="red">That email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
              }
            // Check for missing data
              if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
                $message = '<p class="red">Please provide information for all empty form fields and make sure email entered is correct.</p>';
                include '../view/registration.php';
                exit;
              }
              if(empty($checkPassword)){
                $message = '<p class="red">Error: Invalid password input.</p>';
                include '../view/registration.php';
                exit;
            }
            
            // Hash the checked password
              $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            // Send the data to the model
              $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
            
            // Check and report the result
              if($regOutcome === 1){
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                //$message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
                //include '../view/login.php';
                header('Location: /phpmotors/accounts/?action=login-page');
                exit;
              } else {
                $message = "<p class='red'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
              }
        case 'Login':
          $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
          $clientEmail = checkEmail($clientEmail);
          $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $passwordCheck = checkPassword($clientPassword);

          if(empty($clientEmail) || empty($passwordCheck)){
            $message = '<p class="red">Please provide a valid email address and password..</p>';
            include '../view/login.php';
            exit;   
          }     
              
          // A valid password exists, proceed with the login process
          // Query the client data based on the email address
          $clientData = getClient($clientEmail);
          // Compare the password just submitted against
          // the hashed password for the matching client
          $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
          // If the hashes don't match create an error
          // and return to the login view
          if(!$hashCheck) {
            $message = '<p class="red">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
          }
          // A valid user exists, log them in
          $_SESSION['loggedin'] = TRUE;
          // Remove the password from the array
          // the array_pop function removes the last
          // element from an array
          array_pop($clientData);
          // Store the array into the session
          $_SESSION['clientData'] = $clientData;
          if(isset($_SESSION['message'])){
            unset($_SESSION['message']);
          }
          $clientId = $_SESSION['clientData']['clientId'];
          $clientReviews = getReviewsFromClientId($clientId);
  
  
          if(!count($clientReviews)){
            $message2 = '<p class="red">No reviews have been added yet.</p>';
          }
          else{
            $displayClientReviews = buildReviewDisplay($clientReviews);
          }

          // Send them to the admin view
          include '../view/admin.php';
          exit;
          break;
        case 'Logout':
          session_unset();
          session_destroy();
          include '../index.php';
          exit;
          break;
        case 'login-page':
          //fix so person logged in person can't access this
          include '../view/login.php';
          session_unset();
          session_destroy();
          break;
        case 'register-page':
          include '../view/registration.php';
          break;
        case 'updateAccount':
          // Filter and store the data
          $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
          $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT)); 
          //Validate email
          $checkEmail = checkEmail($clientEmail);

          $existingEmail = checkExistingEmail($clientEmail);
          
          //Check if the email address is different than the one in the session. If yes, check that the new email address does not already exist in the clients table (the same process as during registration).

          // Check for existing email address in the table
          if($clientEmail != $_SESSION['clientData']['clientEmail']){
            if($existingEmail){
              $message = '<p class="red">Sorry, that email address already exists.</p>';
              include '../view/client-update.php';
              exit;
          }}
          // Check for missing data
          if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $message = '<p class="red">Please do not submit a blank form field.</p>';
            include '../view/client-update.php';
            exit;
          }
          if(empty($checkEmail)){
            $message = '<p class="red">Please enter a valid email address.</p>';
            include '../view/client-update.php';
            exit;
          }
          
          // Send the data to the model
          $updateAccountOutcome = updateAccount($clientFirstname, $clientLastname, $checkEmail, $clientId);
          // Check and report the result
          if($updateAccountOutcome){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $message = "<p class='notify'>$clientFirstname, your account has successfully been updated.</p>";
            $_SESSION['message'] = $message;
            //update client info based on ID
            $clientData = updateClient($clientId);
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            header('Location: /phpmotors/accounts/');
            exit;
            } else {
              $message = "<p class='red'>Sorry $clientFirstname, we could not update your information. Please try again.</p>";
              include '../view/client-update.php';
              exit;
            }
            break;
        case 'updatePassword':
              // Filter and store the data
              $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                
              //Validate email & password
              $checkPassword = checkPassword($clientPassword);
              $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT)); 

              $clientData = updateClient($clientId);
              // Compare the password just submitted against
              // the hashed password for the matching client
              $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
              // Check for missing data
              if(empty($clientPassword)){
                $message2 = '<p class="red">Please enter a password.</p>';
                include '../view/client-update.php';
                exit;
              }
              if(empty($checkPassword)){
                $message2 = '<p class="red">Please make sure your password matches the desired pattern.</p>';
                include '../view/client-update.php';
                exit;
              }
              //If password matches the same hashed password, produce an error informing user to change it to a new password
              if($hashCheck){
                $message2 = "<p class='red'>Please make sure the new password is not the same as the one that's currently used.</p>";
                include '../view/client-update.php';
                exit;
              }
              // Hash the checked password
              $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
              // Send the data to the model
              $updatePasswordOutcome = updatePassword($hashedPassword, $clientId);
              // Check and report the result
              array_pop($clientData);
              if($updatePasswordOutcome){
                $clientFirstname = $_SESSION['clientData']['clientFirstname'];
                $message = "<p class='notify'>$clientFirstname, your password has successfully been updated.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/accounts/');
                exit;
                } else {
                  $message2 = "<p class='red'>Sorry $clientFirstname, your password was not updated successfully.</p>";
                  include '../view/client-update.php';
                  exit;
                }
                break;
            case 'client-update':
                include '../view/client-update.php';
                break;
        default:
        if(isset($_SESSION['message'])){
          unset($_SESSION['message']);
        }
        $clientId = $_SESSION['clientData']['clientId'];
        $clientReviews = getReviewsFromClientId($clientId);


        if(!count($clientReviews)){
          $message2 = '<p class="red">No reviews have been added yet.</p>';
        }
        else{
          $displayClientReviews = buildReviewDisplay($clientReviews);
        }
        include '../view/admin.php';
        break;
    }
?>