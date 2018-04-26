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
<div class="mdl-grid" >
         <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--6dp ">
            <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
              <h2 class="mdl-card__title-text"><i class="material-icons"style="margin-top:3px;">search</i> Find a Ride</h2>
            </div>
            <div class="mdl-card__supporting-text" style="height:300px;">
              <form >
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
      <div class="mdl-card mdl-cell mdl-cell--4-col mdl-shadow--6dp ">
            <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
              <h2 class="mdl-card__title-text"><i class="material-icons" style="margin-top:3px;">add_circle_outline</i> Offer a Ride</h2>
            </div>
            <div class="mdl-card__supporting-text" style="width:100%">
              <form >
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
      <div  class="mdl-cell mdl-cell--8-col">Hello</div>
      </div>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
<script src="src/js/app.js"></script>
<script src="src/js/map.js"></script>
<script src="src/js/profile.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
</body>
</html>