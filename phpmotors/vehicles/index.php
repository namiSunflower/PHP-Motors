<?php
    /**
     * This is the vehicles controller
     */
    // Create or access a Session
    session_start();
    // Get the database connection file
    require_once '../library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once '../model/main-model.php';
    // Get the vehicles model
    require_once '../model/vehicles-model.php';
    //Get the functions library
    require_once '../library/functions.php';
    //Get the uploads-model library
    require_once '../model/uploads-model.php';
    //Get reviews model
    require_once '../model/reviews-model.php';


    // Get the array of classifications
    $classifications = getClassifications();

    //var_dump($classifications);
    //exit;
    
    $navList = createNavList($classifications);

    // $classificationList = '<select name="classificationId">';
    // $classificationList .= "<option disabled='disabled' selected='selected'>Choose Car Classification</option>"; 
    // //creates a list item with a link to the controller at the root of the phpmotors folder as a string. 
    // //This begins a foreach loop that will find each of the sub-arrays in the $classifications array and
    // //break them apart, one at a time, and stores each one into a new variable called $classification.
    // foreach ($classifications as $classification) {
    //     /**
    //      * This is a list item with a link that points to the controller in the phpmotors folder, but this time it is
    //      * followed by a question mark (e.g. ?) and then by a key - value pair. The key is action and the value is
    //      * the classification name inside of the $classification variable. The $classification['classificationName']
    //      * is inside of a PHP function - urlencode - which takes care of any spaces or other special characters so
    //      * they are valid HTML. The whole piece is concatenated into the string as a whole. As with all previous code
    //      * in this example, the string is being added to the $navList variable.*/
    //     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    // } //this lone right curly brace closes the foreach loop
    // //This line clolistses the unordered list.
    // $classificationList .= '</select>';

    //createClassificationArray($classifications);
    
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    switch ($action) {
      case 'addClass':
          $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  
          if (empty($classificationName)) {
              $message = '<p class="red">Please provide information for the empty form field to add a new classification.</p>';
              include '../view/add-classification.php';
              exit; 
          }
          $newClassification = addClassification($classificationName);
          if ($newClassification === 1) {
              header("Location: /phpmotors/vehicles/index.php");
              exit;
          }
          else {
              $message="<p class='red'>We ran into an issue. Please try again.</p>";
              include '../view/add-classification.php';
              exit;
          }
          break;    
      case 'addCar':
          $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
          $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
          $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          //Validate inventory stock

          $checkStock = checkStock($invStock);
          //if empty
           // Check for missing data
           if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){            
            $message = '<p class="red">Please provide information for all empty form fields to add a new car.</p>';
            include '../view/add-vehicle.php';
            exit; 
          }
          if(empty($checkStock)){
            $message = '<p class="red">Error: Invalid stock inventory value.</p>';
            include '../view/add-vehicle.php';
            exit; 
           }
         
           // Send the data to the model
           $newVehicle = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
           // Check and report the result
          if($newVehicle === 1){
             $message = "<p class='notify'>The $invMake $invModel was added successfully! Please make sure to upload a primary image for the vehicle!</p>";
             unset($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
             include '../view/add-vehicle.php';
             exit;
            } else {
            $message = "<p class='red'>Sorry, but the vehicle registration failed. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        break; 
        case 'classification-page':
          include '../view/add-classification.php';
          break;
        case 'vehicle-page':
          include '../view/add-vehicle.php';
          break;
        /* * ********************************** 
        * Get vehicles by classificationId 
        * Used for starting Update & Delete process 
        * ********************************** */ 
        case 'getInventoryItems': 
          // Get the classificationId 
          $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
          // Fetch the vehicles by classificationId from the DB 
          $inventoryArray = getInventoryByClassification($classificationId); 
          // Convert the array to a JSON object and send it back 
          echo json_encode($inventoryArray); 
          break;
        case 'mod':
          $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
          $invInfo = getInvItemInfo($invId);
          //check to see if $invInfo has any data. If not, we will set an error message
          if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
           }
           include '../view/vehicle-update.php';
           exit;
          break;
        case 'updateVehicle':
          $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
          $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
          $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
          $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          //stores primary key being passed from the form
          $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

          if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
          $message = '<p class="red">Please complete all information for the new item! Double check the classification of the item.</p>';
          include '../view/vehicle-update.php';
          exit;
          }
          $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId);
          if ($updateResult) {
            $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
          } else {
            $message = "<p class='red'>Error. The new vehicle was not updated.</p>";
            include '../view/vehicle-update.php';
            exit;
          }
          break;
        case 'del':
          $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
          $invInfo = getInvItemInfo($invId);
          if (count($invInfo) < 1) {
              $message = 'Sorry, no vehicle information could be found.';
            }
          include '../view/vehicle-delete.php';
          exit;
          break;
        case 'deleteVehicle':
          $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);  
          $deleteResult = deleteVehicle($invId);
          if ($deleteResult) {
            $message = "<p class='notify'>Congratulations the $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
          } else {
            $message = "<p class='red'>Error: $invMake $invModel was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
            }
          break;
        case 'classification':
            $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $vehicles = getVehiclesByClassification($classificationName);
            if(!count($vehicles)){
              $message = "<p class='red'>Sorry, no $classificationName vehicles could be found.</p>";
            } else {
              $vehicleDisplay = buildVehiclesDisplay($vehicles);
            }
            // Testing purposes
            // echo $vehicleDisplay;
            // exit;
            include '../view/classification.php';
          break;  
        case 'vehicle':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $invInfo = getInvItemInfo($invId);
            $carThumbnails = getThumbnail($invId);

            
            if(($carThumbnails)){
               $thumbnailDisplay = buildThumbnailDisplay($carThumbnails);
            }

            if(!count($invInfo)){
              $message = "<p class='red'>Sorry, no vehicle information could be found.</p>";
            } else {
                $vehicleDisplay = buildVehicleInfo($invInfo);
            }


            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $revInfo = getReviewsFromInvId($invId);
              
            if(!count($revInfo)){
              $message2 = "<p class='italic'>Be the first to write a review!</p>";
            } else {
              $reviewsDisplay = buildReviewsInfo($revInfo);
            }
            // Testing purposes
            // echo $vehicleDisplay;
            // exit;
            include '../view/vehicle-detail.php';
          break;       

        default:
          $classificationList = buildClassificationList($classifications);
          include '../view/vehicle-man.php';
          break;
        }           
?>
 
