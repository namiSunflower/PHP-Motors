<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>PHP Motors Homepage</title>
    <meta name="description" content="This is for enhancement 1 of CSE 340">
    <link href="/phpmotors/css/small.css" rel="stylesheet">
    <link href="/phpmotors/css/large.css" rel="stylesheet">
  </head>
  <body>
      <div id="wrapper">
          <header>
              <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php';?>
            </header>
            <nav>
                <?php 
                //Modularization code
                //require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/nav.php';
                    echo $navList;
                ?>
            </nav>
            
            <main>
                <h1>Welcome to PHP Motors!</h1>
                <div id="text">
                    <h3>DMC Delorean</h3>
                    <h4>3 Cup holders</h4>
                    <h4>Superman doors</h4>
                    <h4>Fuzzy dice!</h4>
                </div>
                <div id="container">
                    <img src="/phpmotors/images/vehicles/delorean.jpg" id="delorean" alt="2d image of delorean car">
                    <img src="/phpmotors/images/site/own_today.png" id="cta" alt="button to buy car">
                </div>
                    <div id="flex">
                            <div id="reviews">
                                <h2>DMC Delorean Reviews</h2>
                                <ul>
                                    <li>"So fast its almost like traveling in time." (4/5)</li>
                                    <li>"Coolest ride on the road." (4/5)</li>
                                    <li>"I'm feeling Marty McFly!" (5/5)</li>
                                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                                    <li>"80s livin and I love it!" (5/5)</li>
                                </ul>
                            </div>
                            <div id="upgrades">
                                <h2>Delorean Upgrades</h2>
                                <div id="grid">
                                    <div>
                                        <div class="figure"><img src="/phpmotors/images/upgrades/flux-cap.png" alt="2d image of a flux capacitor"></div>
                                        <div class="figcaption"><a href="#">Flux Capacitor</a></div>
                                    </div>
                                    <div>
                                        <div class="figure"><img src="/phpmotors/images/upgrades/flame.jpg" alt="2d image of a flame"></div>
                                        <div class="figcaption"><a href="#">Flame Decals</a></div>
                                    </div>
                                    <div>
                                        <div class="figure"><img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="image of a bumper sticker saying 'hello world'"></div>
                                        <div class="figcaption"><a href="#">Bumper Stickers</a></div>
                                    </div>
                                    <div>
                                        <div class="figure"><img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="image of a hub cap"></div>
                                        <div class="figcaption"><a href="#">Hub Caps</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';?>
            </footer>
        </div>
  </body>
</html>
