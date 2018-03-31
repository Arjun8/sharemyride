<?php
session_start();
?>
<?php
include('logout.php');
?>
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
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:800,700" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src = "https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-blue.min.css" />
    <link rel="stylesheet" href="src/css/app.css">
  <link rel="stylesheet" href="src/css/feed.css">
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
          <?php
if (isset($_SESSION["email"])) {
    echo '<a class=" mdl-navigation__link " style="font-size:20px;" id="account" href="/"><i class="material-icons">settings</i> Account Settings</a>
          <a class=" mdl-navigation__link " style="font-size:20px;" id="logout" href="logout.php">Logout</a>';
}
?>
          <?php
if (!isset($_SESSION["email"])) {
    echo '<a class=" mdl-navigation__link " style="font-size:20px;" id="login_1" href="/">Login</a>
          <a class="register mdl-navigation__link" style="font-size:20px;"  href="/" id="sign_up">Register</a>';
}
?>
          <a class="mdl-navigation__link" href="/help"><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--blue">Help</button></a>
          <div class="drawer-option">
            <button class="enable-notifications mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--accent">
              Enable Notifications
            </button>
          </div>
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
            <div class="mdl-card mdl-shadow--6dp" id="logon">
              <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                <h2 class="mdl-card__title-text">Log In</h2>
              </div>
              <div class="mdl-card__supporting-text">
                <form action="src/php/login.php" method="POST">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="email" id="email1" name="email12" />
                    <label class="mdl-textfield__label" for="username">Email</label>
                  </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="password" id="userpass" name="password3" />
                    <label class="mdl-textfield__label" for="userpass">Password</label>
                  </div>
                  <div class="mdl-card__actions">
                  <input type="submit" class="mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect" value="Log in" name="log_in">
                  <button class="mdl-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect">Forget Password?</button>
                    </div>
                </form>
              </div>
      </div>
      </div>
      </div>
      </body>
</html>