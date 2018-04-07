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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKJv1twtfS4PpoUnQoXcHlFcWIK5yvUbk&libraries=places"></script>
<link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css" type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:800,700" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src = "https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-blue.min.css" />
    <link rel="stylesheet" href="src/css/app.css"/>
  <link rel="stylesheet" href="src/css/feed.css"/>
</head>
<body>
<div id="app">
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="nav1 mdl-layout__header" >
      <div class="  mdl-layout__header-row">
        <span class="mdl-layout-title"><a class="mdl-navigation__link"style="font-size:20px;" href="/">Carpool</a></span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation mdl-layout--large-screen-only">
            <a class=" mdl-navigation__link " style="font-size:20px;" id="home" href=""><i class="material-icons" ">home</i> Home</a>
          <?php if(isset($_SESSION["email"])){ echo '<a class=" mdl-navigation__link " style="font-size:20px;" id="account" href="/"><i class="material-icons">settings</i> Account Settings</a>
          <a class=" mdl-navigation__link " style="font-size:20px;" id="logout" href="logout.php">Logout</a>';}?>
          <?php if(!isset($_SESSION["email"])){echo '<a class=" mdl-navigation__link " style="font-size:20px;" id="login_1" href="/">Login</a>
          <a class="register mdl-navigation__link" style="font-size:20px;"  href="/" id="sign_up">Register</a>';}?>
          <a class="mdl-navigation__link" href="/help"><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--blue">Help</button></a>
            <button class="enable-notifications mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--accent" id="push">
              Enable Notifications
            </button>
             </nav>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Carpool</span>
      <nav class="mdl-navigation">
          <a class="mdl-navigation__link" id="login_2" href="/">Login</a>
        <a class="mdl-navigation__link" id="sign_up1" href="/">Register!</a>
        <a class="mdl-navigation__link" href="/">Find a ride</a>
          <a class="mdl-navigation__link" href="/">Offer a ride</a>
          <a class="mdl-navigation__link" href="/help">Help</a>
        <div class="drawer-option">
          <button class="enable-notifications mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--accent">
            Enable Notifications
          </button>
        </div>
      </nav>
    </div>
    <div class="grid">
    <div class="mdl-cell-12-col"  id="redirect1">
      <div  class="mdl-card mdl-shadow--2dp" id="error4" style="margin:0 auto;margin-top:10px;width:80%;">
      <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                <h2 class="mdl-card__title-text">Errors</h2>
                </div>
                <div class="mdl-card__supporting-text" style="text-align:center;" id="error5">
              </div>
          </div>
            <div class="mdl-card mdl-shadow--6dp" id="logon">
              <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                <h2 class="mdl-card__title-text">Log In</h2>
              </div>
              <div class="mdl-card__supporting-text">
                <form id="log_form" >
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="email" id="email1" name="email12" />
                    <label class="mdl-textfield__label" for="username">Email</label>
                  </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="password" id="userpass" name="password3" />
                    <label class="mdl-textfield__label" for="userpass">Password</label>
                  </div>
                  <div class="mdl-card__actions">
                  <input type="submit" class="mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect" id="log_in" value="Log in" name="log_in">
                  <button class="mdl-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect">Forget Password?</button>
                    </div>
                </form>
              </div>
      </div>
          </div>
      <div class="mdl-cell-12-col" style="display:flex;" id="redirect">
      <div  class="mdl-card mdl-shadow--2dp" id="error">
        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                <h2 class="mdl-card__title-text">Errors</h2>
                </div>
                <div class="mdl-card__supporting-text" id="error1">
              </div>
          </div>
            <div class="mdl-card mdl-shadow--2dp " id="form1">
              <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                <h2 class="mdl-card__title-text">Sign Up</h2>
              </div>
              <div class="mdl-card__supporting-text">
                <form  id="sign_form">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="firstname" name="firstname" value="" />
                    <label class="mdl-textfield__label" for="username">First Name</label>
                   </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="lastname" name="lastname" value="" />
                    <label class="mdl-textfield__label" for="username">Last Name</label>
                  </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="Email" id="email" name="email" />
                    <label class="mdl-textfield__label" for="userpass">Email</label>
                  </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="password" id="passw" name="password"  />
                      <label class="mdl-textfield__label" for="username">Password</label>
                    </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="password" id="passw2"name="password2"  />
                      <label class="mdl-textfield__label" for="username">Confirm Password</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <label class="mdl-textfield__label" for="username">Mobile No.</label>
                      <input class="mdl-textfield__input " type="text" id="phonemumber" name="phonenumber" value=""/>
                                         </div>
                                        <div class="mdl-card__actions mdl-card--border">
                <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-button--raised mdl-js-ripple-effect" id="cone" name="sign_up" value="Sign up">
               </div>
                </form>
              </div>
               </div>
              </div>
        <div class="mdl-card mdl-shadow--6dp" id="matrix">
        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
              <h2 class="mdl-card__title-text"><i class="material-icons">settings </i> Distance And Time</h2>
            </div>
            <div class="mdl-card__supporting-text" style="height:260px;">
              <h5 id="details" style="text-align:center;"></h5>
              <h5 id="distance" style="text-align:center;">Distance:</h5>
              <h5 id="time" style="text-align:center;">Time:</h5>
            </div>
        </div>
        <div class="mdl-cell-12-col" id="ride_map">
         <div class="mdl-card mdl-shadow--6dp " id="f_ride">
            <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
              <h2 class="mdl-card__title-text"><i class="material-icons">search </i> Find a ride</h2>
            </div>
            <div class="mdl-card__supporting-text" style="height:260px;">
              <form action="#" >
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="from" placeholder="From" required/>
                  <label class="mdl-textfield__label" for="username">From</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="to" placeholder="To" required/>
                    <label class="mdl-textfield__label" for="username">To</label>
                  </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                    <input type="text" value="" class="mdl-textfield__input" id="sample2" readonly>
                    <input type="hidden" value="" name="sample2">
                    <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                    <label for="sample2" class="mdl-textfield__label">When</label>
                    <ul for="sample2" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                        <li class="mdl-menu__item" data-val="DEU">Now</li>
                        <li class="mdl-menu__item" data-val="BLR">Schedule for Later!</li>
                    </ul>
                </div>
              </form>
            </div>
            <div class="mdl-card__actions ">
              <button class="mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect" id="search1">Search</button>
            </div>
      </div>
      <div class="mdl-card mdl-shadow--6dp " id="ride2">
            <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
              <h2 class="mdl-card__title-text"><i class="material-icons">search </i> Offer a ride</h2>
            </div>
            <div class="mdl-card__supporting-text"  style="height:345px;">
              <form id="offer_form" >
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="off_from" placeholder="From" />
                  <label class="mdl-textfield__label" for="username">From</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="off_to" placeholder="To" />
                    <label class="mdl-textfield__label" for="username">To</label>
                  </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="number" id="seats" min="1"/>
                    <label class="mdl-textfield__label" for="username">No. of Seats</label>
                  </div>
                  <div styel="display:flex;">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
                    <label style="margin-left:0px;" for="username">Date Of Journey</label>
                  <input class="mdl-textfield__input" type="text" id="off_date"/>
                  </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
                    <label style="margin-left:0px;" for="username">Time Of Journey</label>
                  <input class="mdl-textfield__input" type="time" id="off_time" />
                  </div>
                  </div>
              </form>
            </div>
            <div class="mdl-card__actions ">
              <button class="mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect" id="search2">Continue!</button>
            </div>
      </div>
      <div class="mdl-card mdl-shadow--6dp " id="map"></div>
      </div>
      <?php if(!isset($_SESSION['email'])){echo
      '<div id="first">
    <div class="demo-card-wide mdl-cell mdl-card mdl-shadow--2dp" id="front">
        <div class="mdl-card__title">
          <h2 class="mdl-card__title-text"><p>Share a ride</p></h2>
          <button class="mdl-button mdl-button-js mdl-button-flat" id="next"><svg fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
            <path d="M0 0h24v24H0z" fill="none"/>
        </svg></button>
        <button class="mdl-button mdl-button-js mdl-button-flat" id="previous" ><svg fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
          <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
          <path d="M0 0h24v24H0z" fill="none"/>
      </svg></button>
        </div>
        <div class="mdl-card__supporting-text">
         <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
        </div>
        <div class="mdl-card__actions mdl-card--border">
          <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="ride">
            <i class="material-icons">search</i>Find a ride
          </a>
          <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="off_ride">
              <i class="material-icons">add_circle_outline</i>Offer a ride
             </a>
        </div>
      </div>
      <div class="demo-card-wide mdl-cell mdl-card mdl-shadow--2dp" id="front1">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text"><p>Rent A Car</p></h2>
            <button class="mdl-button mdl-button-js mdl-button-flat" id="previous" ><svg fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
              <path d="M0 0h24v24H0z" fill="none"/>
          </svg></button>
          <button class="mdl-button mdl-button-js mdl-button-flat" id="next"><svg fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
            <path d="M0 0h24v24H0z" fill="none"/>
        </svg></button>
          </div>
          <div class="mdl-card__supporting-text">
            <p>Choose from a wide variety of vehicles to reach your destination!</p>
             </div>
          <div class="mdl-card__actions mdl-card--border">
            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
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

           echo '<div style="text-align:center;"><h2 class="mdl-text mdl-color-text--teal">'.$h.'<h2></div>
           <div id="hello2">
           <div class=" mdl-card mdl-shadow--2dp " id="loggedin">
           <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
             <h2 class="mdl-card__title-text "><p>Search for a ride</p></h2>
           </div>
           <div class="mdl-card__supporting-text">
            <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
           </div>
           <div class="mdl-card__actions mdl-card--border">
             <a class="mdl-button mdl-button--colored mdl-button-raised mdl-js-button mdl-js-ripple-effect" id="ride">
               <i class="material-icons">search</i>Find a ride
             </a>
            </div>
         </div><div class="mdl-card mdl-shadow--2dp" id="loggedin">
         <div class="mdl-card__title">
           <h5 class="mdl-card__title-text mdl-color-text--black"><p>Offer a Ride</p></h5>
         </div>
         <div class="mdl-card__supporting-text">
          <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
         </div>
         <div class="mdl-card__actions mdl-card--border">
           <a class="mdl-button mdl-button--colored mdl-js-button mdl-button-raised mdl-js-ripple-effect">
               <i class="material-icons">add_circle_outline</i>Offer a ride
              </a>
         </div>
       </div><div class="mdl-card mdl-shadow--2dp" id="loggedin">
       <div class="mdl-card__title">
         <h5 class="mdl-card__title-text mdl-color-text--black"><p>Find your ride summary</p></h5>
       </div>
       <div class="mdl-card__supporting-text">
        <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
       </div>
       <div class="mdl-card__actions mdl-card--border">
         <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button-raised" id="ride">
           <i class="material-icons">search</i>Ride Summary
         </a>
       </div>
     </div></div>';
            }
            ?>
              <div class="hello mdl-cell-12-col" >
          <footer class = "mdl-mega-footer">
              <div class = "mdl-mega-footer__top-section">
                 <div class = "mdl-mega-footer__left-section">
                    <button class = "mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--twitter"><i class="fa fa-twitter fa-fw"></i> Twitter</button>
                    <button class = "mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--facebook"><i class="fa fa-facebook fa-fw"></i>Facebook</button>
                    <button class = "mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--twitter">3</button>
                 </div>
                 <div class = "mdl-mega-footer__right-section">
                    <a href = "">Link 1</a>
                    <a href = "">Link 2</a>
                    <a href = "">Link 3</a>
                 </div>
              </div>
              <div class = "mdl-mega-footer__middle-section">
                 <div class = "mdl-mega-footer__drop-down-section">
                    <h1 class = "mdl-mega-footer__heading">Heading </h1>
                    <ul class = "mdl-mega-footer__link-list">
                       <li><a href = "">Link A</a></li>
                       <li><a href = "">Link B</a></li>
                    </ul>
                 </div>
                 <div class = "mdl-mega-footer__drop-down-section">
                    <h1 class = "mdl-mega-footer__heading">Heading </h1>
                    <ul class = "mdl-mega-footer__link-list">
                       <li><a href = "">Link C</a></li>
                       <li><a href = "">Link D</a></li>
                    </ul>
                 </div>
              </div>
              <div class = "mdl-mega-footer__bottom-section">
                 <div class = "mdl-logo">
                    Bottom Section
                 </div>
                 <ul class = "mdl-mega-footer__link-list">
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
<script src="src/js/app.js"></script>
<script src="src/js/errors.js"></script>
<script src="src/js/feed.js"></script>
<script src="src/js/map.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
 <script>
  $(document).ready(function(){
var a=new Date(Date.now());
if(a.getHours()<10||a.getMinutes()<10)
{
  a="0"+a.getHours()+":"+"0"+a.getMinutes();
}
else
{
  a=a.getHours()+":"+a.getMinutes();
}
a=a.toString();
console.log(typeof(a));
console.log(a.toString());
$("#off_time").val(a).attr({"min":a});
$("#off_date").datepicker({format:"dd/mm/yyyy",
  orientation:"bottom",
  startDate:'+0d',
  stratView:'+0d',
  todayBtn:"linked",
  todayHighlight:"true",
  value:'+0d'});
}); </script>
 </body>
</html>