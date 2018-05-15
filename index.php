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
       <?php if(!isset($_SESSION['email'])){echo
      '<div class="mdl-grid" style="justify-content: center;">
    <div class="mdl-cell mdl-cell--10-col mdl-card mdl-shadow--2dp" id="front">
        <div class="mdl-card__title" style="height:312px;">
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
          <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="fride.php" id="ride">
            <i class="material-icons">search</i>Find a ride
          </a>
        </div>
      </div>
      <div class="mdl-cell  mdl-cell--10-col  mdl-card mdl-shadow--2dp" id="front1">
          <div class="mdl-card__title"style="height:312px;">
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
          <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="offer.php"id="off_ride">
          <i class="material-icons">add_circle_outline</i>Offer a ride
         </a>
          </div>
          </div>
          </div>';}
          else
          {
            if(isset($_SESSION["user_id"]))
            {

              $results_per_page=4;
              if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
              $start_from = ($page-1) * $results_per_page;
              $datatable="off_ride";
              $id=$_SESSION["user_id"];
              $sql1="SELECT * FROM ".$datatable." where user_id = ".$id." ORDER BY j_date DESC LIMIT $start_from, ".$results_per_page;
              $total1="SELECT COUNT(id) FROM off_ride WHERE user_id='$id'";
              $total2=mysqli_fetch_row(mysqli_query($con,$total1));
              $total=$total2[0];
              $pages = ceil($total / $results_per_page);
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
            <div class="mdl-card mdl-shadow--2dp mdl-color-card--primary" style="width:100%;background:#009688">
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
      $price=$row["price"];
      if($seats==0)
      {
$seats="All seats are booked";
      }
      else
      {
        $seats.=" left";
      }
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
                       echo '<h6 class="mdl-text mdl-color-text--blue"style="font-weight:bold;margin-left:10px;margin-top:-1px;">No of seats: '.$seats."</h6></div></div>";
            }
            for ($i=1; $i<=$pages; $i++) {  echo "<a  style='text-decoration:none;color:black;' href='index.php?page=".$i."'";
              if ($i==$page)  echo " class='curPage'";
              echo ">".$i."</a> "; 
  };
            echo"</div></div></div>";
            }}
           echo '
           <div class="mdl-cell mdl-cell--4-col" id="grid2">
           <div class=" mdl-card mdl-shadow--2dp " id="loggedin">
           <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
             <h2 class="mdl-card__title-text ">Search for a ride</h2>
           </div>
           <div class="mdl-card__supporting-text">
            <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
           </div>
           <div class="mdl-card__actions mdl-card--border">
             <a class="mdl-button mdl-button--colored mdl-button-raised mdl-js-button mdl-js-ripple-effect" href="fride.php" id="ride">
               <i class="material-icons">search</i>Find a ride
             </a>
            </div>
         </div><div class="mdl-card mdl-shadow--2dp" id="loggedin1">
         <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
           <h5 class="mdl-card__title-text ">Offer a Ride</h5>
         </div>
         <div class="mdl-card__supporting-text">
          <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
         </div>
         <div class="mdl-card__actions mdl-card--border">
           <a class="mdl-button mdl-button--colored mdl-js-button mdl-button-raised mdl-js-ripple-effect" href="offer.php"id="off_ride">
               <i class="material-icons">add_circle_outline</i>Offer a ride
              </a>
         </div>
       </div>
       <div class="mdl-card mdl-shadow--2dp" id="loggedin2">
       <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
         <h5 class="mdl-card__title-text">Find your ride summary</h5>
       </div>
       <div class="mdl-card__supporting-text">
        <p>Help yourself and environment by sharing a ride,Choose from a large number of available rides,Cheaper and eco-friendly!</p>
       </div>
       <div class="mdl-card__actions mdl-card--border">
         <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button-raised" id="ride" href="ride_summary.php">
           <i class="material-icons">search</i>Ride Summary
         </a>
       </div>
     </div>
     </div>
     </div>';
            }
            ?>
           <footer class = "mdl-mega-footer">
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
           <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
           <script src="src/js/feed.js"></script>
  <script  src = "https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.min.js"></script>
      </html>