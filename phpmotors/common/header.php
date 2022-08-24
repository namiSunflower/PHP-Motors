<img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo" id="logo">
<!--?php //if(isset($cookieFirstname)){
    echo "<span>Welcome $cookieFirstname</span>";
    /} ?> -->

<?php if (isset($_SESSION['clientData'])) {
    echo "<a id='welcome' href='/phpmotors/accounts/?action=login'>Welcome ". $_SESSION['clientData']['clientFirstname']."</a>";
    }
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_SESSION['clientData'])){
        echo "<div id='flex-span'><a> " . $_SESSION['clientData']['clientFirstname'] . "</a>  |  <a href='/phpmotors/accounts/?action=Logout'>Logout</a></div>";
    }
    else{
        echo "<a href='/phpmotors/accounts/?action=login-page'>My Account</a>";
    }

?>
<!-- If a site visitor (the client) is not logged in, the "My Account" link should be present and operational 
(as it currently exists).
When the client is "logged in" the "My Account" link should be replaced with a "Log out" link that points to the
accounts controller and passes the appropriate name value pair to trigger the logout event.
This code area can also be where the welcome message and link are displayed or hidden -->

