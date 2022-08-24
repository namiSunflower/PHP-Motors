<?php
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}
// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}
//Check if inventory stock is less than 9999 and at least greater than or equal to 1
function checkStock($invStock){
    $valStock = filter_var(
        $invStock, 
        FILTER_VALIDATE_INT, 
        array(
            'options' => array(
                'min_range' => 1, 
                'max_range' => 9999
            )
        )
    );
    return $valStock;
}
//build navigation links
function createNavList($classifications){
     // Build a navigation bar using the $classifications array
    //creates an unordered list as a string and assigns it to the $navList variable.
    $navList = '<ul>';
    //creates a list item with a link to the controller at the root of the phpmotors folder as a string. 
    //The string is then added to the value already stored in the variable. 
    //That's what the .= operator does, it adds to a variable.
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    //This begins a foreach loop that will find each of the sub-arrays in the $classifications array and
    //break them apart, one at a time, and stores each one into a new variable called $classification.
    foreach ($classifications as $classification) {
        /**
         * This is a list item with a link that points to the controller in the phpmotors folder, but this time it is
         * followed by a question mark (e.g. ?) and then by a key - value pair. The key is action and the value is
         * the classification name inside of the $classification variable. The $classification['classificationName']
         * is inside of a PHP function - urlencode - which takes care of any spaces or other special characters so
         * they are valid HTML. The whole piece is concatenated into the string as a whole. As with all previous code
         * in this example, the string is being added to the $navList variable.*/
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
        .urlencode($classification['classificationName']).
        "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    } //this lone right curly brace closes the foreach loop
    //This line closes the unordered list.
    $navList .= '</ul>';
    //Testing purposes
    //echo $navList;
    //exit;
    return $navList;
}
// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
}
//Build a display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= "<a href='/phpmotors/vehicles/?action=vehicle&invId=$vehicle[invId]'><img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
     $dv .= '<hr>';
     $dv .= "<a href='/phpmotors/vehicles/?action=vehicle&invId=$vehicle[invId]'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
     $comma = number_format($vehicle['invPrice']);
     $dv .= "<span>$$comma</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
    // <a href='/phpmotors/vehicles/?action=classification&classificationName="
    // .urlencode($classification['classificationName']).
    // "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a>
}

//Build full info for one vehicle
function buildVehicleInfo($invInfo){
    $dv = '<div id="parent-div">';   
    $dv .= "<div><img src='$invInfo[imgPath]' alt='image of a $invInfo[invMake] $invInfo[invModel] on phpmotors.com' class='invImage'>";
    $comma = number_format($invInfo['invPrice']);
    $dv .= "</div>";
    $dv .= "<div class='alternate'>
    <div><h3>$$comma</h3></div>
    <div>$invInfo[invDescription]</div>
    <div>Color: $invInfo[invColor]</div>
    <div># in Stock: $invInfo[invStock]</div>
    </div>";
    $dv .= '</div>';
    return $dv;
}

/* * ********************************
*  Functions for working with images
* ********************************* */
// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
   }
// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
   }
// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
   }
// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
   }

// Processes images by getting paths and creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
   }

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
   } // ends resizeImage function

//Build thumbnail display inside vehicle detail page
function buildThumbnailDisplay($image) { 
    $dv = '<div><h3 class="none">Vehicle Thumbnails</h3>'; 
    $dv .= '<div id="tn">';
    foreach($image as $img){
        $dv .= '<div>';
        $dv .= "<img src='$img[imgPath]' alt='thumbnail of image'>";
        $dv .= '</div>';
     }
    $dv .= '</div></div>';
    return $dv;
   }

//Build reviews list
function buildReviewsInfo($revInfo){
    $dv = '<div id="review-div">';   
    foreach ($revInfo as $info) {
        $dv .= '<div class="yellow">';
        $dv .= "<div>" . substr($info['clientFirstname'], 0, 1) . $info['clientLastname'];
        $dv .= "<span class='small_font'> wrote on " . date('d F,Y \a\t g:i A', strtotime($info['reviewDate'])) . ":</span></div>";
        $dv .= "<div class='white'>$info[reviewText]</div>";
        $dv .= '</div>';
        //echo date('d F,y', strtotime($info['reviewDate']));
        // print_r($info);
    }
    $dv .= '</div>';
    return $dv;
}

//Build a display of reviews for one specific client within an unordered list
function buildReviewDisplay($reviews){
    $ul = '<ul id="rev-display">';
    foreach ($reviews as $review) {
     $ul .= '<li>';
     $ul .= "$review[invMake] $review[invModel] ";
     $ul .= "(Reviewed on " . date('d F,Y \a\t g:i A', strtotime($review['reviewDate'])) . "): " ;
     $ul .= "<a href='/phpmotors/reviews/?action=mod&reviewId=$review[reviewId]'>Edit</a>";
     $ul .= ' | ';
     $ul .= "<a href='/phpmotors/reviews/?action=del&reviewId=$review[reviewId]'>Delete</a>";
     $ul .= '</li>';
    }
    $ul .= '</ul>';
    return $ul;
}
?>