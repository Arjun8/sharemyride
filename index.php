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
  <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="src/css/app.css"/>
  <link rel="stylesheet" href="src/css/feed.css"/>
</head>
<body >
<div class="grid">
    <div class="mdl-cell--12-col" id="upload_form"style="display:none;text-align:center;position:fixed;z-index:1000;background: rgba(128,128,128,0.7);;width:100%;height:100%;text-align:center;">
    <div class="mdl-card mdl-shadow--2dp" style="z-index:9999;margin-left:25%;margin-top:15%;width:50%;">
    <a class="mdl-navigation__link"id="close1" href="" style="margin-left:94%;">
    <i class="material-icons">close</i></a>
    <div id="updatepicturemessage"></div>
    <form method="post" enctype="multipart/form-data" id="updatepictureform">
    <img  id="previewing" style="width:120px;height:120px;">
    <h3>Select a Picture:</h4><input type="file" name="picture" id="picture" style="width:80%;"/>
    </br>
    <input class="mdl-button mdl-button--colored mdl-js-button mdl-button--raised mdl-js-ripple-effect" name="updatepicture" type="submit" value="Submit">
                <button type="button" class="mdl-button mdl-button--colored mdl-js-button mdl-button--raised mdl-js-ripple-effect"data-dismiss="modal">
                  Cancel
    </button>
    </form>
      </div></div>
    </div>
<div id="app" style="z-index:1;">
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="nav1 mdl-layout__header" >
      <div class="  mdl-layout__header-row">
        <span class="mdl-layout-title"><a class="mdl-navigation__link"style="font-size:20px;" href=""><i class="material-icons"style="margin-top:-5px;">directions_car</i>ShareMyRide</a></span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation mdl-layout--large-screen-only">
            <a class=" mdl-navigation__link " style="font-size:20px;" id="home" href="" style="margin-left:-20px;"><i class="material-icons" style="margin-top:-5px;">home</i>Home</a>
            <?php if(isset($_SESSION["email"])){ if(empty($p))
              {
                echo '<img src="user (3).png" style="margin-left:-40px;">';
              }
              else
              {
                echo '<img src="'.$p.'" style="margin-left:0px;width:64px;height:62px;">';
              }
              echo'<a class=" mdl-navigation__link " style="font-size:20px;margin-left:-15px;">'.$h.'</a>';}?>
          <?php if(isset($_SESSION["email"])){ echo '<a class=" mdl-navigation__link " style="font-size:20px;" id="account" href=""><i class="material-icons"style="margin-top:-5px;">settings</i>Account Settings</a>
          <a class=" mdl-navigation__link " style="font-size:20px;" id="logout" href="logout.php"><i class="material-icons" style="margin-top:-5px;">lock_open</i>Logout</a>';}?>
          <?php if(!isset($_SESSION["email"])){echo '<a class=" mdl-navigation__link " style="font-size:20px;" id="login_1" href="/"><i class="material-icons" style="margin-top:-5px;">lock</i>Login</a>
          <a class="register mdl-navigation__link" style="font-size:20px;"  href="/" id="sign_up">Sign Up</a>';}?>
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
        <a class="mdl-navigation__link" id="setting1" href="">Account Settings</a>
        <a class=" mdl-navigation__link "id="logout1" href="logout.php"><i class="material-icons" style="margin-top:-5px;">lock_open</i>Logout</a>';
        }else
        {
          echo'
          <a class="mdl-navigation__link" id="login_2" href="/">Login</a>
        <a class="mdl-navigation__link" id="sign_up1" href="/">Sign Up!</a>';}
        ?>
        <a class="mdl-navigation__link" href="" id="d_fride">Find a Ride</a>
          <a class="mdl-navigation__link" href="" id="d_offride">Offer a Ride</a>
          <a class="mdl-navigation__link" href="">Help</a>
        <div class="drawer-option">
          <button class="enable-notifications mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--accent">
          <i class="fa fa-bell-o"></i> Enable Notifications
          </button>
        </div>
      </nav>
    </div>
    <div class="grid">
    <div id="message_board" class="mdl-grid mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp" style="display:none;"><h2 id="msg"class="mdl-text mdl-color-text--primary">Hello where</h2> </div>
    <div class="mdl-grid" id="settings" style="display:none;margin-left: 75px;margin-top:25px;">
    <div class="mdl-cell mdl-cell--2-col" >
    <?php
    if(empty($p))
    {
    echo'<div style="border:solid 2px;border-color:teal;text-align:center;" ><img src="user (4).png"></div>';
    echo '
    <button class="mdl-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect" style="margin-left:18px;margin-top:10px;" id="upload">Upload a Picture
    </button>
    ';
    }
    else
    {
      echo '<div style="border:solid 2px;border-color:teal;width:160px;height:150px;"><img src='.$p.' style="width:160px;height:150px;"></div>';
      echo '
      <button class="mdl-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="upload"style="margin-left:10px;margin-top:10px;">Change Picture</button>';
    }
    ?>
    </div>
    <div class="mdl-cell mdl-cell--8-col " style="margin-left:65px;">
      <div class="mdl-card mdl-shadow--2dp" style="width:80%;">
      <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
      <h3 class="mdl-card__title-text">Personal Information</h3>
  </div>
  <div class="mdl-card__supporting-text">
      <form  id="update2">
      <div id="d1" style="display:none;margin-left:180px;"><h6 id="d" class="mdl-color-text--red"></h6></div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="margin-left:170px" >
                  <input class="mdl-textfield__input" type="text" id="firstname1" name="firstname" value="<?php echo $f;?>"/>
                  <label class="mdl-textfield__label" for="username">First Name</label>
                  </div>
                   <div id="f1"style="display:none;margin-left:180px;"><h6 id="f" class="mdl-color-text--red"></h6></div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="margin-left:170px">
                  <label class="mdl-textfield__label" for="username">Last Name</label>
                  <input class="mdl-textfield__input" type="text" id="lastname1" name="lastname" value="<?php echo $l;?>"/>
                  </div>
                  <div  id="g1"style="display:none;margin-left:180px;"><h6 id="g" class="mdl-color-text--red"></h6></div>
                  <div class="" style="margin-left:180px;">
                  <label class="mdl-radio mdl-color-text--primary" style="margin-left:-10px;">Gender:</label>
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="Male1">
                  <input type="radio" id="Male1" value="Male"class="mdl-radio__button" name="gender" />
                  <span class="mdl-radio__label">Male</span>
                  </label>
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="Female1">
                  <input type="radio" id="Female1" value="Female"class="mdl-radio__button" name="gender" />
                  <span class="mdl-radio__label">Female</span>
                  </label>
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="other1">
                  <input type="radio" id="other1" value="other"class="mdl-radio__button" name="gender" />
                  <span class="mdl-radio__label">Other</span>
                                    </label>
                  </div>
                  <div style="text-align:center;margin-top:10px;">
                  <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-button--raised mdl-js-ripple-effect" id="update1" name="update1" value="Save Changes">
               </div>
      </form>
  </div>
      </div>
    </div>
    </div>
    <div class="mdl-cell--12-col"  id="redirect1">
      <div  class="mdl-card mdl-shadow--2dp" id="error4" style="display:none;margin:0 auto;margin-top:10px;width:80%;">
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
      <div class="mdl-grid" id="redirect">
      <div  class="mdl-cell mdl-cell--5-col mdl-card mdl-shadow--2dp" id="error" style="display:none;">
        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                <h2 class="mdl-card__title-text">Errors</h2>
                </div>
                <div class="mdl-card__supporting-text" id="error1">
              </div>
          </div>
            <div class="mdl-cell mdl-cell--5-col mdl-card mdl-shadow--2dp " id="form1">
              <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                <h2 class="mdl-card__title-text">Sign Up</h2>
              </div>
              <div class="mdl-card__supporting-text">
                <form  id="sign_form">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="firstname" name="firstname" value="" />
                    <label class="mdl-textfield__label" for="username" pattern="^[A-Za-z]+">First Name</label>
                   </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="lastname" name="lastname" value="" />
                    <label class="mdl-textfield__label" for="username" pattern="[A-Za-z]">Last Name</label>
                  </div>
                  <div class="">
                  <label class="mdl-radio mdl-color-text--primary" style="margin-left:-10px;">Gender:</label>
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="Male">
                  <input type="radio" id="Male" value="Male" class="mdl-radio__button" name="gender" />
                  <span class="mdl-radio__label">Male</span>
                  </label>
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="Female">
                  <input type="radio" id="Female" value="Female" class="mdl-radio__button" name="gender" />
                  <span class="mdl-radio__label">Female</span>
                  </label>
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="other">
                  <input type="radio" id="other" value="other" class="mdl-radio__button" name="gender" />
                  <span class="mdl-radio__label">Other</span>
                                    </label>
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
                      <input class="mdl-textfield__input " type="text" id="phonemumber" pattern="[0-9]{10}"name="phonenumber" value=""/>
                                         </div>
                                        <div class="mdl-card__actions ">
                <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-button--raised mdl-js-ripple-effect" id="cone" name="sign_up" value="Sign up">
               </div>
                </form>
              </div>
               </div>
              </div>
              <div class="mdl-grid" id="matrix2" style="display:flex;">
        <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--6dp" id="matrix" >
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
                  <div class="mdl-card mdl-shadow--2dp" style="display:none;text-align:center;margin:0 auto;margin-top:15px;" id="off_errors">
                  </div>
        <div class="mdl-grid" id="ride_map">
         <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--6dp " id="f_ride">
            <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
              <h2 class="mdl-card__title-text"><i class="material-icons"style="margin-top:3px;">search</i> Find a Ride</h2>
            </div>
            <div class="mdl-card__supporting-text" style="height:300px;">
              <form  id="find_form">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="from" name="find_from" placeholder="From"style="width:360px;"/>
                  <label class="mdl-textfield__label" for="username"style="width:360px;">From</label>
                </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="to" name="to" placeholder="To"style="width:360px;"/>
                    <label class="mdl-textfield__label" for="username"style="width:360px;">To</label>
                  </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input type="hidden" id="find_from_lat" name="find_from_lat"/>
                  <input type="hidden" id="find_from_lang" name="find_from_lang"/>
                  <input type="hidden" id="find_to_lat" name="find_to_lat"/>
                  <input type="hidden" id="find_to_lang" name="find_to_lang"/>
                    <label style="margin-left:0px;" class="mdl-textfield__label" for="username"style="width:360px;">Date Of Journey</label>
                  <input class="mdl-textfield__input" type="text" id="find_date" name="find_date"style="width:360px;"/>
                  </div>
              </form>
            </div>
            <div class="mdl-card__actions " style="text-align:center">
              <button class="mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect" id="search1">Search</button>
            </div>
      </div>
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
                    <input class="mdl-textfield__input" type="number" id="seats" min="1" name="seats"style="width:360px;"/>
                    <label class="mdl-textfield__label" for="username" style="width:360px;">No. of Seats</label>
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
                  </div>
              </form>
            </div>
            <div class="mdl-card__actions " style="text-align:center">
            <?php if(isset($_SESSION["user_id"]))
            {
            echo'<button class="mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect" id="search2">Continue!</button>';
              }
              else
              {
                echo'
                <button class="mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect" id="login3">Log In to Continue</button>';
              }
              ?>
            </div>
      </div>
      <div id="map" class="mdl-cell mdl-cell--7-col-desktop mdl-cell--4-col-phone"></div>
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
        <button class="mdl-button mdl-button-js mdl-button-flat" id="previous" style="margin-left:-30px;"><svg fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
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
        </div>
      </div>
      <div class="demo-card-wide mdl-cell mdl-card mdl-shadow--2dp" id="front1">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text"><p>Offer A Ride</p></h2>
            <button class="mdl-button mdl-button-js mdl-button-flat" id="previous" style="margin-left:-30px;"><svg fill="#FFFFFF" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
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
          <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="off_ride">
          <i class="material-icons">add_circle_outline</i>Offer a ride
         </a>
          </div>
          </div>
          </div>';}
          else
          {
            if(isset($_SESSION["user_id"]))
            {
              $id=$_SESSION["user_id"];
              $sql1= "SELECT * FROM off_ride WHERE user_id='$id' order by j_date desc";
            $result1=mysqli_query($con,$sql1);
            if(!$result1)
            {
              echo "ERROR: Unable to excecute: $sql1. " . mysqli_error($con); exit;
            }
            if(mysqli_num_rows($result1)==0)
            {
              echo '<div class="mdl-grid">
              <div class=" mdl-cell mdl-cell--8-col">
             <div class="mdl-card mdl-shadow--2dp" id="no_j" style="width:100%;" >
              <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
              <h2 class="mdl-card__title-text">Published Journeys</h2>
              </div>
              <div class="mdl-card__supporting-text"><h2>There are no journeys published by you</h2>
              </div>
              </div></div>';
            }
            else
            {
            echo '<div class="mdl-grid">
            <div class="mdl-cell mdl-cell--8-col" id="grid1">
            <div class="mdl-card mdl-shadow--2dp" style="width:100%">
            <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
            <h2 class="mdl-card__title-text">Published Journeys</h2>
            </div>
            <div class="mdl-card__supporting-text " style="text-align:center">';
            while($row=mysqli_fetch_array($result1,MYSQLI_ASSOC))
            {
             $tripDeparture=$row["from_address"];
             $tripDestination=$row["to_address"];
             $seats=$row["seats"];
            $oldDate=$row["j_date"];
              $time=$row["j_time"];
              $len=strlen($time);
              $time=substr($time,0,5);
              $length = strrpos($oldDate," ");
    $newDate = explode( "-" , substr($oldDate,$length));
      $output = $newDate[2]."/".$newDate[1]."/".$newDate[0];
            echo
            '<div style="display:flex;margin-top:15px;text-align:center">
            <div class="mdl-card mdl-shadow--2dp" style="margin-left:70px;width:80%;text-align:center">
           '
            ."</br>".'<h6 class="mdl-text mdl-color-text--blue"style="font-weight:bold;margin-left:10px;margin-top:-1px;">From: '.$tripDeparture."</h6>".
                       '<h6 class="mdl-text mdl-color-text--blue"style="font-weight:bold;margin-left:10px;margin-top:-1px;">To: '.$tripDestination."</h6>".
                       '<h6 class="mdl-text mdl-color-text--blue"style="font-weight:bold;margin-left:10px;margin-top:-1px;">Date of Journey: '.$output."</h6>".
                        '<h6 class="mdl-text mdl-color-text--blue"style="font-weight:bold;margin-left:10px;margin-top:-1px;">Time of Journey: '.$time."</h6>".
                        '<h6 class="mdl-text mdl-color-text--blue"style="font-weight:bold;margin-left:10px;margin-top:-1px;">No of seats: '.$seats." left "."</h6></div></div>";
            }
            echo "</div></div></div>";
            }}
           echo '
           <div class="mdl-cell mdl-cell--4-col" id="grid2">
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
         </div><div class="mdl-card mdl-shadow--2dp" id="loggedin1">
         <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
           <h5 class="mdl-card__title-text "><p>Offer a Ride</p></h5>
         </div>
         <div class="mdl-card__supporting-text">
          <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
         </div>
         <div class="mdl-card__actions mdl-card--border">
           <a class="mdl-button mdl-button--colored mdl-js-button mdl-button-raised mdl-js-ripple-effect" id="off_ride">
               <i class="material-icons">add_circle_outline</i>Offer a ride
              </a>
         </div>
       </div>
       <div class="mdl-card mdl-shadow--2dp" id="loggedin2">
       <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
         <h5 class="mdl-card__title-text"><p>Find your ride summary</p></h5>
       </div>
       <div class="mdl-card__supporting-text">
        <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
       </div>
       <div class="mdl-card__actions mdl-card--border">
         <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button-raised" id="ride">
           <i class="material-icons">search</i>Ride Summary
         </a>
       </div>
     </div>
     </div></div>';
            }
            ?>
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
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCFMp7_GOUFEQNPGiFlSWTtaX8Xj68nUwE",
    authDomain: "sharemyride-bc3fa.firebaseapp.com",
    databaseURL: "https://sharemyride-bc3fa.firebaseio.com",
    projectId: "sharemyride-bc3fa",
    storageBucket: "",
    messagingSenderId: "103011514041"
  };
  firebase.initializeApp(config);
</script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
<script src="src/js/app.js"></script>
<script src="src/js/feed.js"></script>
<script src="src/js/map.js"></script>
<script src="src/js/profile.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
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
$("#find_date").datepicker({format:"dd/mm/yyyy",
  orientation:"right top",
  setDate: '+0d',
   startDate:'+0d',
  todayBtn:"linked",
  todayHighlight:"true"}).datepicker('setDate',new Date(Date.now()));
            $("#from" ).autocomplete({
                source: function( request, response ) {
                    $.ajax({
                        url: "hint.php",
                        dataType: "json",
                        data: {
                            q: request.term
                        },
                        success: function( data ) {
                            response( data );
                        }
                    });
                },
            });
            $("#to" ).autocomplete({
                source: function( request, response ) {
                    $.ajax({
                        url: "to_hint.php",
                        dataType: "json",
                        data: {
                            q: request.term
                        },
                        success: function( data ) {
                            response( data );
                        }
                    });
                },
            });
            </script>
            <script>
            var fail="<?php if (isset($_SESSION["user_id"])){echo $g;}?>";
            $(fail).prop("checked",true);
              </script>
 </body>
</html>