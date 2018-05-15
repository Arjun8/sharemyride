<?php session_start();?>
<?php include('common.php');?>
<?php
if(isset($_SESSION["user_id"]))
{$email=$_SESSION["user_id"];
            $sql="select * from users where id='$email'";
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
              $p=$row["profilepicture"];
              $email1=$row["email"];
              $mo=$row["phonenumber"];
              $g="#".$row["gender"]."1";
              $h='Welcome '.$f.' '.$l.'!';
      }
        }?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ShareMyRide</title>
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="manifest" href="manifest.json">
<link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css" type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:800,700" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-blue.min.css" />
  <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="src/css/app.css"/>
  <link rel="stylesheet" href="src/css/feed.css"/>
  <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="ShareMyRide">
    <link rel="apple-touch-icon" href="src/images/icons/apple-icon-144x144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="src/images/icons/apple-icon-57x57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="src/images/icons/apple-icon-60x60.png" sizes="60x60">
    <link rel="apple-touch-icon" href="src/images/icons/apple-icon-72x72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="src/images/icons/apple-icon-114x114.png" sizes="144x144">
    <link rel="apple-touch-icon" href="src/images/icons/apple-icon-76x76.png" sizes="76x76">
    <link rel="apple-touch-icon" href="src/images/icons/apple-icon-120x120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="src/images/icons/apple-icon-152x152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="src/images/icons/apple-icon-180x180.png" sizes="180x180">
    <meta name="msapplication-TileImage" content="src/images/icons/apple-icon-144x144.png">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="theme-color" content="#009688">
</head>
<style>
#map1{
  border:2px solid #009688;
}
</style>
<body >
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header" >
      <div class="  mdl-layout__header-row">
        <span class="mdl-layout-title"><a class="mdl-navigation__link"style="font-size:20px;" href="index.php"><i class="material-icons"style="margin-top:-5px;">directions_car</i>ShareMyRide</a></span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation mdl-layout--large-screen-only">
            <a class=" mdl-navigation__link " style="font-size:20px;" id="home" href="index.php" style="margin-left:-20px;"><i class="material-icons" style="margin-top:-5px;">home</i>Home</a>
            <?php if(isset($_SESSION["email"])){ if(empty($p))
              {
                echo '<img src="user (3).png" style="margin-left:-40px;">';
              }
              else
              {
                echo '<img src="'.$p.'" style="margin-left:0px;width:64px;height:62px;">';
              }
              echo'<a class=" mdl-navigation__link " style="font-size:20px;margin-left:-15px;">'.$h.'</a>';}?>
          <?php if(isset($_SESSION["email"])){ echo '<a class=" mdl-navigation__link " style="font-size:20px;" id="account" href="updateprofile.php">
          <i class="material-icons"style="margin-top:-5px;">settings</i>Account Settings</a>
          <a class=" mdl-navigation__link " style="font-size:20px;" id="logout" href="logout.php"><i class="material-icons" style="margin-top:-5px;">lock_open</i>Logout</a>';}?>
          <?php if(!isset($_SESSION["email"])){echo '<a class=" mdl-navigation__link " style="font-size:20px;" id="login_1" href="login_form.php">
          <i class="material-icons" style="margin-top:-5px;">lock</i>Login</a>
          <a class="register mdl-navigation__link" style="font-size:20px;"  href="sign_form.php" id="sign_up"><i class="fa fa-user-plus" aria-hidden="true" style="margin-top:-5px;"></i> Sign Up</a>';}?>
            <button class="enable-notifications mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--accent" id="push">
            <i class="fa fa-bell-o"></i> Enable Notifications
            </button>
             </nav>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">ShareMyRide</span>
      <nav class="mdl-navigation">
        <?php if(isset($_SESSION["user_id"]))
        {
          echo '<a class="mdl-navigation__link"  href="">'.$f." ".$l.'</a>
        <a class="mdl-navigation__link" id="setting1" href="updateprofile.php"><i class="material-icons"style="margin-top:-5px;">settings</i>Account Settings</a>
        <a class=" mdl-navigation__link "id="logout1" href="logout.php"><i class="material-icons" style="margin-top:-5px;">lock_open</i>Logout</a>';
        }else
        {
          echo'
          <a class="mdl-navigation__link" id="login_2" href="login_form.php"><i class="material-icons" style="margin-top:-5px;">lock</i>Login</a>
        <a class="mdl-navigation__link" id="sign_up1" href="sign_form.php">   <i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up!</a>';}
        ?>
        <a class="mdl-navigation__link" href="fride.php" id="d_fride"><i class="material-icons" style="margin-top:-5px;">search</i>Find a Ride</a>
          <a class="mdl-navigation__link" href="offer.php" id="d_offride"><i class="material-icons" style="margin-top:-5px;">add_circle_outline</i>Offer a Ride</a>
          <a class="mdl-navigation__link" href="">Help</a>
        <div class="drawer-option">
          <button class="enable-notifications mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--accent">
          <i class="fa fa-bell-o"></i> Enable Notifications
          </button>
        </div>
      </nav>
    </div>
    <main class="mdl-layout__content">
<div class="mdl-card mdl-shadow--2dp" style="display:none;text-align:center;margin:0 auto;margin-top:15px;" id="off_errors">
                  </div>
              <div class="mdl-grid" id="matrix2" style="justify-content: center;">
        <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--6dp" id="matrix" >
        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
              <h2 class="mdl-card__title-text"><i class="material-icons" style="margin-top:4px;">settings </i>Distance And Time</h2>
            </div>
            <div class="mdl-card__supporting-text"  id="p_ride">
              <h5 id="details_from" style="text-align:center;"></h5>
              <h5 id="details_to" style="text-align:center;"></h5>
              <h5 id="distance" style="text-align:center;">Distance:</h5>
              <h5 id="time" style="text-align:center;">Time:</h5>
            </div> </div>
</div>
 <div class="mdl-grid" id="ride_map">
      <div class="mdl-card mdl-cell mdl-cell--4-col mdl-shadow--6dp " id="ride2">
            <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
              <h2 class="mdl-card__title-text"><i class="material-icons" style="margin-top:3px;">add_circle_outline</i> Offer a Ride</h2>
            </div>
            <div class="mdl-card__supporting-text" style="width:100%">
              <form id="offer_form">
              <div id="err1" style="display:none;"></div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="off_from" placeholder="From" name="off_from" style="width:360px;"/>
                  <label class="mdl-textfield__label" for="username" style="width:360px;">From</label>
                </div>

                  <div id="err2" style="display:none;"></div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="off_to" placeholder="To" name="off_to"style="width:360px;"/>
                    <label class="mdl-textfield__label" for="username"style="width:360px;">To</label>
                  </div>

                  <div id="err4" style="display:none;"></div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="ins">
                    <input class="mdl-textfield__input" type="text" id="pickup" placeholder="Pickup" name="pickup"style="width:360px;"/>
                    <label class="mdl-textfield__label" for="username"style="width:360px;">Pickup</label>
                  </div>

                  <div id="err3" style="display:none;"></div>

                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" pattern="[0-9]" id="seats" min="1" name="seats"style="width:360px;"/>
                    <label class="mdl-textfield__label" for="username" style="width:360px;">No. of Seats</label>
                  </div>
                  <div id="err_price" ></div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="price" pattern="[0-9]*" name="price"style="width:360px;"/>
                    <label class="mdl-textfield__label" for="username" style="width:360px;">Price Per Seats</label>
                  </div>
                  <div styel="display:flex;">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <label style="margin-left:0px;" class="mdl-textfield__label" for="username"style="width:360px;">Date Of Journey</label>
                  <input class="mdl-textfield__input" type="text" id="off_date" name="off_date"style="width:360px;"/>
                  </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
                    <label style="margin-left:0px;" class="mdl-textfield__label" for="username"style="width:360px;">Time Of Journey</label>
                  <input class="mdl-textfield__input" type="time" id="off_time"  name="off_time"style="width:360px;"/>
                  </div>
                  <input type="hidden" id="from_lat" name="from_lat"/>
                  <input type="hidden" id="from_lang" name="from_lang"/>
                  <input type="hidden" id="to_lat" name="to_lat"/>
                  <input type="hidden" id="to_lang" name="to_lang"/>
                  <input type="hidden" id="pickup_lat" name="pickup_lat"/>
                  <input type="hidden" id="pickup_lang" name="pickup_lang"/>
                  </div>
              </form>
            </div>
            <div class="mdl-card__actions " style="text-align:center">
            <button class="mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect" id="search2">Continue!</button>
            </div>
      </div>
      <div id="map1"  class="mdl-cell mdl-cell--8-col mdl-cell--4-col-phone"></div>
      </div>
      <footer class = "mdl-mega-footer" style="">
              <div class = "mdl-mega-footer__top-section">
                 <div class = "mdl-mega-footer__left-section">
                    <button class = "mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--twitter"><i class="fa fa-twitter fa-fw"></i> Twitter</button>
                    <button class = "mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--facebook"><i class="fa fa-facebook fa-fw"></i>Facebook</button>
                   </div>
                 <div class = "mdl-mega-footer__right-section">
                    <a href = "">Terms & Conditions</a>
                    <a href = "">Privacy policy</a>
                    <a href = "">Cookies policy</a>
                 </div>
              </div>
              <div class = "mdl-mega-footer__middle-section">
                 <div class = "mdl-mega-footer__drop-down-section">
                    <h1 class = "mdl-mega-footer__heading">Using ShareMyRide</h1>
                    <ul class = "mdl-mega-footer__link-list">
                       <li><a href = "">How IT Works!</a></li>
                       <li><a href = "">Frequently asked questions</a></li>
                    </ul>
                 </div>
                 <div class = "mdl-mega-footer__drop-down-section">
                    <h1 class = "mdl-mega-footer__heading">Our Company</h1>
                    <ul class = "mdl-mega-footer__link-list">
                       <li><a href = "">About US</a></li>
                       <li><a href = "">Contact US</a></li>
                    </ul>
                 </div>
              </div>
              <div class = "mdl-mega-footer__bottom-section">
                 <div class = "mdl-logo">
                 ShareMyRide&copy;<?php echo date("d/m/Y")?>
                 </div>
              </div>
           </footer>
           </main>
           </div>
           </body>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
  <script src="src/js/idb.js"></script>
<script src="src/js/utility.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKJv1twtfS4PpoUnQoXcHlFcWIK5yvUbk&libraries=places&region=IN"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="src/js/map1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src = "https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.min.js"></script>
 <script>
var a=new Date(Date.now());
if(a.getHours()<10&&a.getMinutes()>=10)
{
  a="0"+a.getHours()+":"+a.getMinutes();;
}
else if(a.getMinutes()<10&&a.getHours()>=10)
{
  a=a.getHours()+":"+"0"+a.getMinutes();
}
else if(a.getHours()<10 && a.getMinutes()<10)
{
  a="0"+a.getHours()+":"+"0"+a.getMinutes();
  console.log("Here");
}
else
{
  a=a.getHours()+":"+a.getMinutes();
}
a=a.toString();
$("#off_time").val(a).attr({"min":a});
$("#off_date").datepicker({format:"dd/mm/yyyy",
  orientation:"right top",
  setDate: '+0d',
   startDate:'+0d',
  todayBtn:"linked",
  todayHighlight:"true"}).datepicker('setDate',new Date(Date.now()));
</script>
<script src="src/js/app2.js"></script>
</html>