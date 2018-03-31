<?php session_start();?>
<?php include('common.php');?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Carpool</title>
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="manifest" href="/manifest.json">
<link rel="stylesheet" href="src/css/getmdl-select.min.css">
<script defer src="src/js/getmdl-select.min.js"></script>
<link rel="stylesheet"
          href="node_modules/material-components-web/dist/material-components-web.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:800,700" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src = "https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-blue.min.css" />
    <link rel="stylesheet" href="src/css/app.css">
  <link rel="stylesheet" href="src/css/feed.css">
</head>
<body class="mdc-typography">
<div id="app">
  <div class="mdc-layout mdc-js-layout mdc-layout--fixed-header">
    <header class="nav1 mdc-layout__header" >
      <div class="  mdc-layout__header-row">
        <span class="mdc-layout-title"><a class="mdc-navigation__link"style="font-size:20px;" href="/">Carpool</a></span>
        <div class="mdc-layout-spacer"></div>
        <nav class="mdc-navigation mdc-layout--large-screen-only">
            <a class=" mdc-navigation__link " style="font-size:20px;" id="home" href=""><i class="material-icons" ">home</i> Home</a>
          <?php if(isset($_SESSION["email"])){ echo '<a class=" mdc-navigation__link " style="font-size:20px;" id="account" href="/"><i class="material-icons">settings</i> Account Settings</a>
          <a class=" mdc-navigation__link " style="font-size:20px;" id="logout" href="logout.php">Logout</a>';}?>
          <?php if(!isset($_SESSION["email"])){echo '<a class=" mdc-navigation__link " style="font-size:20px;" id="login_1" href="/">Login</a>
          <a class="register mdc-navigation__link" style="font-size:20px;"  href="/" id="sign_up">Register</a>';}?>
          <a class="mdc-navigation__link" href="/help"><button class="mdc-button mdc-js-button mdc-button--raised mdc-button--colored mdc-color--blue">Help</button></a>
            <button class="enable-notifications mdc-button mdc-js-button mdc-button--raised mdc-button--colored mdc-color--accent" id="push">
              Enable Notifications
            </button>
             </nav>
      </div>
    </header>
    <div class="mdc-layout__drawer">
      <span class="mdc-layout-title">Carpool</span>
      <nav class="mdc-navigation">
          <a class="mdc-navigation__link" id="login_2" href="/">Login</a>
        <a class="mdc-navigation__link" id="sign_up1" href="/">Register!</a>
        <a class="mdc-navigation__link" href="/">Find a ride</a>
          <a class="mdc-navigation__link" href="/">Offer a ride</a>
          <a class="mdc-navigation__link" href="/help">Help</a>
        <div class="drawer-option">
          <button class="enable-notifications mdc-button mdc-js-button mdc-button--raised mdc-button--colored mdc-color--accent">
            Enable Notifications
          </button>
        </div>
      </nav>
    </div>
    <div class="grid">
            <div class="mdc-card mdc-shadow--6dp" id="logon">
              <div class="mdc-card__title mdc-color--primary mdc-color-text--white">
                <h2 class="mdc-card__title-text">Log In</h2>
              </div>
              <div class="mdc-card__supporting-text">
                <form action="login.php" method="POST">
                  <div class="mdc-textfield mdc-js-textfield mdc-textfield--floating-label">
                    <input class="mdc-textfield__input" type="email" id="email1" name="email12" />
                    <label class="mdc-textfield__label" for="username">Email</label>
                  </div>
                  <div class="mdc-textfield mdc-js-textfield mdc-textfield--floating-label">
                    <input class="mdc-textfield__input" type="password" id="userpass" name="password3" />
                    <label class="mdc-textfield__label" for="userpass">Password</label>
                  </div>
                  <div class="mdc-card__actions">
                  <input type="submit" class="mdc-button mdc-button--colored mdc-button--raised mdc-js-button mdc-js-ripple-effect" value="Log in" name="log_in">
                  <button class="mdc-button mdc-button--raised mdc-button--colored mdc-js-button mdc-js-ripple-effect">Forget Password?</button>
                    </div>
                </form>
              </div>
      </div>
      <div class="mdc-card mdc-shadow--2dp " id="form1">
              <div class="mdc-card__title mdc-color--primary mdc-color-text--white">
                <h2 class="mdc-card__title-text">Sign Up</h2>
              </div>
              <div class="mdc-card__supporting-text">
                <form action="signup.php" method="POST" id="sign_form">
                  <div class="mdc-textfield mdc-js-textfield mdc-textfield--floating-label">
                    <input class="mdc-textfield__input" type="text" id="firstname" name="firstname" value="" required/>
                    <label class="mdc-textfield__label" for="username">First Name</label>
                </div>
                  <div class="mdc-textfield mdc-js-textfield mdc-textfield--floating-label">
                    <input class="mdc-textfield__input" type="text" id="lastname" name="lastname" value="" required/>
                    <label class="mdc-textfield__label" for="username">Last Name</label>
                  </div>
                  <div class="mdc-textfield mdc-js-textfield mdc-textfield--floating-label">
                    <input class="mdc-textfield__input" type="Email" id="email" name="email" required/>
                    <label class="mdc-textfield__label" for="userpass">Email</label>
                  </div>
                  <div class="mdc-textfield mdc-js-textfield mdc-textfield--floating-label">
                      <input class="mdc-textfield__input" type="password" id="passw"name="password"required />
                      <label class="mdc-textfield__label" for="username">Password</label>
                    </div>

                  <div class="mdc-textfield mdc-js-textfield mdc-textfield--floating-label">
                      <input class="mdc-textfield__input" type="password" id="passw2"name="password2"required />
                      <label class="mdc-textfield__label" for="username">Confirm Password</label>
                    </div>
                    <div class="mdc-textfield mdc-js-textfield mdc-textfield--floating-label">
                      <label class="mdc-textfield__label" for="username">Mobile No.</label>
                      <input class="mdc-textfield__input" type="number" id="upload1"name="phonenumber" required/>
                                         </div>
                                        <div class="mdc-card__actions mdc-card--border">
                <input type="submit" class="mdc-button mdc-button--colored mdc-js-button mdc-button--raised mdc-js-ripple-effect" id="cone" name="sign_up" value="Sign up">
               </div>
                </form>
              </div>
               </div>
        <div class="mdc-card mdc-shadow--6dp" id="matrix">
        <div class="mdc-card__title mdc-color--primary mdc-color-text--white">
              <h2 class="mdc-card__title-text"><i class="material-icons">settings </i> Distance And Time</h2>
            </div>
            <div class="mdc-card__supporting-text" style="height:260px;">
              <h5 id="details" style="text-align:center;"></h5>
              <h5 id="distance" style="text-align:center;">Distance:</h5>
              <h5 id="time" style="text-align:center;">Time:</h5>
            </div>
        </div>
        <div class="mdc-cell-12-col" id="ride_map">
         <div class="mdc-card mdc-shadow--6dp " id="f_ride">
            <div class="mdc-card__title mdc-color--primary mdc-color-text--white">
              <h2 class="mdc-card__title-text"><i class="material-icons">search </i> Find a ride</h2>
            </div>
            <div class="mdc-card__supporting-text" style="height:260px;">
              <form action="#" >
                <div class="mdc-textfield mdc-js-textfield mdc-textfield--floating-label">
                  <input class="mdc-textfield__input" type="text" id="from" placeholder="From" required/>
                  <label class="mdc-textfield__label" for="username">From</label>
                </div>
                <div class="mdc-textfield mdc-js-textfield mdc-textfield--floating-label">
                    <input class="mdc-textfield__input" type="text" id="to" placeholder="To" required/>
                    <label class="mdc-textfield__label" for="username">To</label>
                  </div>
                  <div class="mdc-textfield mdc-js-textfield mdc-textfield--floating-label getmdc-select getmdc-select__fix-height">
                    <input type="text" value="" class="mdc-textfield__input" id="sample2" readonly>
                    <input type="hidden" value="" name="sample2">
                    <i class="mdc-icon-toggle__label material-icons">keyboard_arrow_down</i>
                    <label for="sample2" class="mdc-textfield__label">When</label>
                    <ul for="sample2" class="mdc-menu mdc-menu--bottom-left mdc-js-menu">
                        <li class="mdc-menu__item" data-val="DEU">Now</li>
                        <li class="mdc-menu__item" data-val="BLR">Schedule for Later!</li>
                    </ul>
                </div>
              </form>
            </div>
            <div class="mdc-card__actions ">
              <button class="mdc-button mdc-button--colored mdc-button--raised mdc-js-button mdc-js-ripple-effect" id="search1">Search</button>
            </div>
      </div>
      <div class="mdc-card mdc-shadow--6dp " id="map"></div>
      </div>
      <?php if(!isset($_SESSION['email'])){echo
      '<div id="first">
    <div class="demo-card-wide mdc-cell mdc-card mdc-shadow--2dp" id="front">
        <div class="mdc-card__title">
          <h2 class="mdc-card__title-text"><p>Share a ride</p></h2>
          <button class="mdc-button mdc-button-js mdc-button-flat" id="next"><svg fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
            <path d="M0 0h24v24H0z" fill="none"/>
        </svg></button>
        <button class="mdc-button mdc-button-js mdc-button-flat" id="previous" ><svg fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
          <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
          <path d="M0 0h24v24H0z" fill="none"/>
      </svg></button>
        </div>
        <div class="mdc-card__supporting-text">
         <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
        </div>
        <div class="mdc-card__actions mdc-card--border">
          <a class="mdc-button mdc-button--colored mdc-js-button mdc-js-ripple-effect" id="ride">
            <i class="material-icons">search</i>Find a ride
          </a>
          <a class="mdc-button mdc-button--colored mdc-js-button mdc-js-ripple-effect">
              <i class="material-icons">add_circle_outline</i>Offer a ride
             </a>
        </div>
      </div>
      <div class="demo-card-wide mdc-cell mdc-card mdc-shadow--2dp" id="front1">
          <div class="mdc-card__title">
            <h2 class="mdc-card__title-text"><p>Rent A Car</p></h2>
            <button class="mdc-button mdc-button-js mdc-button-flat" id="previous" ><svg fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
              <path d="M0 0h24v24H0z" fill="none"/>
          </svg></button>
          <button class="mdc-button mdc-button-js mdc-button-flat" id="next"><svg fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
            <path d="M0 0h24v24H0z" fill="none"/>
        </svg></button>
          </div>
          <div class="mdc-card__supporting-text">
            <p>Choose from a wide variety of vehicles to reach your destination!</p>
             </div>
          <div class="mdc-card__actions mdc-card--border">
            <a class="mdc-button mdc-button--colored mdc-js-button mdc-js-ripple-effect">
             <i class="material-icons">add_circle_outline</i>Rent A car Or A Bike
            </a>
          </div>
          </div>
          </div>';}
          else
          { $email=$_SESSION["email"];
            $sql="select * from users where email='$email'";
            $result=mysqli_query($con,$sql);
            if(!$result)
            {
              $h="Query was not successfull";
              echo '<p>"I am here! in not"</p>';
            }
            else
            {
              $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
              $f=$row["first_name"];
              $l=$row["last_name"];
              $h='Welcome '.$f.' '.$l.'!';
              }

           echo '<div style="text-align:center;"><h2 class="mdc-text mdc-color-text--teal">'.$h.'<h2></div>
           <div id="hello2">
           <div class=" mdc-card mdc-shadow--2dp " id="loggedin">
           <div class="mdc-card__title mdc-color--primary mdc-color-text--white">
             <h2 class="mdc-card__title-text "><p>Search for a ride</p></h2>
           </div>
           <div class="mdc-card__supporting-text">
            <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
           </div>
           <div class="mdc-card__actions mdc-card--border">
             <a class="mdc-button mdc-button--colored mdc-button-raised mdc-js-button mdc-js-ripple-effect" id="ride">
               <i class="material-icons">search</i>Find a ride
             </a>
            </div>
         </div><div class="mdc-card mdc-shadow--2dp" id="loggedin">
         <div class="mdc-card__title">
           <h5 class="mdc-card__title-text mdc-color-text--black"><p>Offer a Ride</p></h5>
         </div>
         <div class="mdc-card__supporting-text">
          <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
         </div>
         <div class="mdc-card__actions mdc-card--border">
           <a class="mdc-button mdc-button--colored mdc-js-button mdc-button-raised mdc-js-ripple-effect">
               <i class="material-icons">add_circle_outline</i>Offer a ride
              </a>
         </div>
       </div><div class="mdc-card mdc-shadow--2dp" id="loggedin">
       <div class="mdc-card__title">
         <h5 class="mdc-card__title-text mdc-color-text--black"><p>Find your ride summary</p></h5>
       </div>
       <div class="mdc-card__supporting-text">
        <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
       </div>
       <div class="mdc-card__actions mdc-card--border">
         <a class="mdc-button mdc-button--colored mdc-js-button mdc-js-ripple-effect mdc-button-raised" id="ride">
           <i class="material-icons">search</i>Ride Summary
         </a>
       </div>
     </div></div>';
            }
            ?>
              <div class="hello mdc-cell-12-col" >
          <footer class = "mdc-mega-footer">
              <div class = "mdc-mega-footer__top-section">
                 <div class = "mdc-mega-footer__left-section">
                    <button class = "mdc-button mdc-js-button mdc-button--raised mdc-js-ripple-effect mdc-button--twitter"><i class="fa fa-twitter fa-fw"></i> Twitter</button>
                    <button class = "mdc-button mdc-js-button mdc-button--raised mdc-js-ripple-effect mdc-button--facebook"><i class="fa fa-facebook fa-fw"></i>Facebook</button>
                    <button class = "mdc-button mdc-js-button mdc-button--raised mdc-js-ripple-effect mdc-button--twitter">3</button>
                 </div>
                 <div class = "mdc-mega-footer__right-section">
                    <a href = "">Link 1</a>
                    <a href = "">Link 2</a>
                    <a href = "">Link 3</a>
                 </div>
              </div>
              <div class = "mdc-mega-footer__middle-section">
                 <div class = "mdc-mega-footer__drop-down-section">
                    <h1 class = "mdc-mega-footer__heading">Heading </h1>
                    <ul class = "mdc-mega-footer__link-list">
                       <li><a href = "">Link A</a></li>
                       <li><a href = "">Link B</a></li>
                    </ul>
                 </div>
                 <div class = "mdc-mega-footer__drop-down-section">
                    <h1 class = "mdc-mega-footer__heading">Heading </h1>
                    <ul class = "mdc-mega-footer__link-list">
                       <li><a href = "">Link C</a></li>
                       <li><a href = "">Link D</a></li>
                    </ul>
                 </div>
              </div>
              <div class = "mdc-mega-footer__bottom-section">
                 <div class = "mdc-logo">
                    Bottom Section
                 </div>
                 <ul class = "mdc-mega-footer__link-list">
                    <li><a href = "">Link A</a></li>
                    <li><a href = "">Link B</a></li>
                 </ul>
              </div>
           </footer>
          </div>
          </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script>
  var map, infoWindow,autocomplete2,autocomplete1,marker,marker2,marker1,directionsService,directionsDisplay,service;
  function fillinAddress2()
  {
    var place=autocomplete2.getPlace();
    marker2.setPosition(place.geometry.location);
  }
  function fillinAddress1()
  {
    infoWindow.close();
    marker.setVisible(false);
    var place=autocomplete1.getPlace();
    marker1.setPosition(place.geometry.location);
    }
      function initMap() {
        service = new google.maps.DistanceMatrixService();
         directionsService = new google.maps.DirectionsService();
         directionsDisplay = new google.maps.DirectionsRenderer();
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 10
        });
        directionsDisplay.setMap(map);
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        var pos={};
         var a="";var b="";
         var d=" ";
        var adress;
        marker2 = new google.maps.Marker({
          map: map,
          });
          marker1 = new google.maps.Marker({
          map: map,
         });
        var input1=document.getElementById("from");
        var input2=document.getElementById('to');
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
           pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
             marker = new google.maps.Marker({
          map: map,
          position: pos
        });
            a=(position.coords.latitude);
            b=(position.coords.longitude);
            d="https://maps.googleapis.com/maps/api/geocode/json?latlng="+a+","+b+"&key=AIzaSyCKJv1twtfS4PpoUnQoXcHlFcWIK5yvUbk";
         $.getJSON(d,function(data)
      {
     adress = data.results[0].formatted_address;
     infoWindow.setContent(adress);
      }
    );
    var circle = new google.maps.Circle({
              center: pos,
              radius: position.coords.accuracy
            });
            autocomplete1 = new google.maps.places.Autocomplete(input1,{types: ['geocode']});
    autocomplete2 = new google.maps.places.Autocomplete(input2,{types: ['geocode']});
       autocomplete1.setTypes(['(cities)']);
autocomplete1.setComponentRestrictions({'country': 'in'});
autocomplete1.addListener('place_changed', fillinAddress1);
autocomplete2.setTypes(['(cities)']);
autocomplete2.setComponentRestrictions({'country': 'in'});
autocomplete2.addListener('place_changed', fillinAddress2);
            autocomplete1.setBounds(circle.getBounds());
            autocomplete2.setBounds(circle.getBounds());
              infoWindow.setPosition(pos);
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          }
         );
    $("#from").focus(function(){
$(this).parent().get(0).MaterialTextfield.change(adress);
}); } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      } $("#search1").click(function(){
        $("#matrix").show();
    var desti=$("#to").val();
    var otig=$("#from").val();
    marker1.setVisible(false);
    marker2.setVisible(false);
    marker.setVisible(false);
    var h={
      origin: desti,
  destination:otig,
  travelMode: 'DRIVING',
  drivingOptions: {
    departureTime: new Date(Date.now()+360000),
    trafficModel: 'pessimistic'
  },
  unitSystem: google.maps.UnitSystem.METRIC
    };
    service.getDistanceMatrix(
  { origins: [desti],
  destinations:[otig],
  travelMode: 'DRIVING',
  drivingOptions: {
    departureTime: new Date(Date.now()+360000),}},function(response,status){
      if (status == 'OK') {
    var origins = response.originAddresses;
    var destinations = response.destinationAddresses;

    for (var i = 0; i < origins.length; i++) {
      var results = response.rows[i].elements;
      for (var j = 0; j < results.length; j++) {
        var element = results[j];
        var distance = element.distance.text;
        var duration = element.duration.text;
        var from = origins[i];
        var to = destinations[j];
        $("#details").text("Distance and time required between "+from+" and "+to+".");
        $("#distance").text("Distance: "+distance);
        $("#time").text("Duration: "+duration);
        }
    }
  }
  });
    directionsService.route(h,function(result,status)
  {
    if (status == 'OK') {
      directionsDisplay.setDirections(result);
    }
  });
    });
       </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKJv1twtfS4PpoUnQoXcHlFcWIK5yvUbk&libraries=places&callback=initMap">
        </script>
        <script src="node_modules/material-components-web/dist/material-components-web.js"></script>
<script>mdc.autoInit()</script>
<script src="src/js/app.js"></script>
<script src="src/js/errors.js"></script>
<script src="src/js/feed.js"></script>
</body>
</html>