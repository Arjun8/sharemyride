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
        }
        else
        {header("Location:index.php");
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
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:800,700" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.teal-blue.min.css" />
    <link rel="stylesheet" href="src/css/app.css"/>
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
     <main class = "mdl-layout__content">
     <?php
              $datatable="book_ride";
              $id=$_SESSION["user_id"];
              $sql1="SELECT * FROM ".$datatable." where user_id=".$id."";
              $result1=mysqli_query($con,$sql1);
            if(!$result1)
            {
              echo "ERROR: Unable to excecute: $sql1. " . mysqli_error($con); exit;
            }
            if(mysqli_num_rows($result1)==0)
            {
              echo '<div class="mdl-grid"style="justify-content:center;">
              <div class=" mdl-cell mdl-cell--8-col">
             <div class="mdl-card mdl-shadow--2dp" id="no_j" style="width:100%;" >
              <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
              <h2 class="mdl-card__title-text">Published Journeys</h2>
              </div>
              <div class="mdl-card__supporting-text"><h2>There are no journeys booked by you</h2>
              </div>
              </div></div></div>';
            }
            else
            {
            echo '<div class="mdl-grid" style="justify-content:center;">
            <div class="mdl-cell mdl-cell--8-col" id="grid1">
            <div class="mdl-card mdl-shadow--2dp mdl-color-card--primary" style="width:100%;background:#009688">
            <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
            <h2 class="mdl-card__title-text">Booked Journeys</h2>
            </div>
            <div class="mdl-card__supporting-text " style="text-align:center">';
            while($row1=mysqli_fetch_array($result1,MYSQLI_ASSOC))
            {
                $id=$row1["ride_id"];
                $sql="Select * from off_ride where id=".$id." and user_id!=".$_SESSION["user_id"]."";
                $result=mysqli_query($con,$sql);
                if(!$result)
                {
                    echo"There wa an error in running your query";
                }
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
             $tripDeparture=$row["from_address"];
             $tripDestination=$row["to_address"];
             $seats=$row1["seats"];
            $oldDate=$row["j_date"];
              $time=$row["j_time"];
              $len=strlen($time);
              $time=substr($time,0,5);
              $length = strrpos($oldDate," ");
    $newDate = explode( "-" , substr($oldDate,$length));
      $output = $newDate[2]."/".$newDate[1]."/".$newDate[0];
      $price=$row["price"];
            echo
            '<div style="display:flex;margin-top:15px;text-align:center">
            <div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--6-col mdl-cell--middle" style="width:100%;text-align:center">
           '
            ."</br>".'<h6 class="mdl-text mdl-color-text--blue"style="font-weight:bold;margin-left:10px;margin-top:-1px;">From: '.$tripDeparture."</h6>".
                       '<h6 class="mdl-text mdl-color-text--blue"style="font-weight:bold;margin-left:10px;margin-top:-1px;">To: '.$tripDestination."</h6>".
                       '<h6 class="mdl-text mdl-color-text--blue"style="font-weight:bold;margin-left:10px;margin-top:-1px;">Date of Journey: '.$output."</h6>".
                        '<h6 class="mdl-text mdl-color-text--blue"style="font-weight:bold;margin-left:10px;margin-top:-1px;">Time of Journey: '.$time."</h6>";
                        if($price!=""){
                          echo'<h6 class="mdl-text mdl-color-text--blue"style="font-weight:bold;margin-left:10px;margin-top:-1px;">Price Per Seat: '.$price."&#8377</h6>";
                        }
                       echo '<h6 class="mdl-text mdl-color-text--blue"style="font-weight:bold;margin-left:10px;margin-top:-1px;">No of Booked seats: '.$seats."</h6>
                       </div>
                       </div>";
            }
            //echo"</div></div>";
            
          
          }
          echo "</div></div></div></div>";
        }
            ?>
           <footer class = "mdl-mega-footer" style="margin-top:90px;">
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
           </body>
           <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
           <script src="src/js/feed.js"></script>
  <script  src = "https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.min.js"></script>
      </html>