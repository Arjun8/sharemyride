var map, infoWindow1, autocomplete2, autocomplete1, autocomplete3, autocomplete4, autocomplete5, marker, marker2, marker5, marker1, marker3, marker4, directionsService, directionsDisplay, directionsService1, directionsDisplay1, service,service1;

function fillinAddress4() {
    var place = autocomplete4.getPlace();
    marker4.setPosition(place.geometry.location);
    $("#to_lat").val(place.geometry.location.lat());
    $("#to_lang").val(place.geometry.location.lng());

}

function fillinAddress5() {
    var place = autocomplete5.getPlace();
    marker5.setPosition(place.geometry.location);
}

function fillinAddress3() {
    infoWindow1.close();
    marker.setVisible(false);
    var place = autocomplete3.getPlace();
    marker3.setPosition(place.geometry.location);
    console.log("Hello");
    $("#from_lat").val(place.geometry.location.lat());
    $("#from_lang").val(place.geometry.location.lng());
}

function initMap2() {
    map = new google.maps.Map(document.getElementById('map1'), {
        center: {
            lat: 31.2186,
            lng: 75.7725
        },
        zoom: 10
    });
    service1 = new google.maps.DistanceMatrixService();
    directionsService1 = new google.maps.DirectionsService();
    directionsDisplay1 = new google.maps.DirectionsRenderer();
    directionsDisplay1.setMap(map);
    infoWindow1 = new google.maps.InfoWindow;
    var pos = {};
    var a = "";
    var b = "";
    var d = " ";
    var adress;
    var input3 = document.getElementById("off_from");
    var input4 = document.getElementById('off_to');
    var input5 = document.getElementById('pickup');
    var geocoder = new google.maps.Geocoder();
    var geocoder1 = new google.maps.Geocoder();
    $("#to").change(function () {
        var id = "to";
        geocodeAddress(geocoder, map, id);
    });
    $("#from").change(function () {
        var id = "from";
        geocodeAddress(geocoder, map, id);
    });
    $("#pickup").change(function(){
        var id = "pickup";
        geocodeAddress(geocoder, map, id);
    })
    marker3 = new google.maps.Marker({
        map: map,
    });
    marker1 = new google.maps.Marker({
        map: map,
    });
    marker4 = new google.maps.Marker({
        map: map,
    });
    marker5 = new google.maps.Marker({
        map: map,
    });
    marker = new google.maps.Marker({
        map: map
    });
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            marker.setPosition(pos);
            a = (position.coords.latitude);
            b = (position.coords.longitude);
            $("#find_from_lat").val(a);
            $("#find_from_lang").val(b);
            $("#from_lat").val(a);
            $("#from_lang").val(b);
            d = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + a + "," + b + "&key=AIzaSyCKJv1twtfS4PpoUnQoXcHlFcWIK5yvUbk";
            $.getJSON(d, function (data) {
                adress = data.results[0].formatted_address;
                infoWindow1.setContent(adress);
            });
            var circle = new google.maps.Circle({
                center: pos,
                radius: position.coords.accuracy
            });
            var defaultBounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(31.280674, 75.687843),
                new google.maps.LatLng(30.978235, 75.584792));
            autocomplete3 = new google.maps.places.Autocomplete(input3, {
                types: ['geocode']
            });
            autocomplete4 = new google.maps.places.Autocomplete(input4, {
                types: ['geocode']
            });
            autocomplete5 = new google.maps.places.Autocomplete(input5, {
                types: ['geocode']
            });
           // autocomplete3.setTypes(['(cities)']);
            autocomplete3.setComponentRestrictions({
                'country': 'in'
            });
            autocomplete3.bindTo('bounds', map);
            autocomplete3.setOptions({strictBounds: true});
            autocomplete3.addListener('place_changed', fillinAddress3);
          //  autocomplete4.setTypes(['(cities)']);
            autocomplete4.setComponentRestrictions({
                'country': 'in'
            });
            autocomplete4.bindTo('bounds', map);
            autocomplete4.setOptions({strictBounds: true});
            autocomplete4.addListener('place_changed', fillinAddress4);
           // autocomplete5.setTypes(['(cities)']);
            autocomplete5.setComponentRestrictions({
                'country': 'in'
            });
            autocomplete5.bindTo('bounds', map);
            autocomplete5.setOptions({strictBounds: true});
            autocomplete5.addListener('place_changed', fillinAddress5);
            autocomplete3.setBounds(circle.getBounds());
            autocomplete4.setBounds(circle.getBounds());
            autocomplete5.setBounds(circle.getBounds());
            infoWindow1.setPosition(pos);
            infoWindow1.open(map);
            map.setCenter(pos);
        }, function () {
            handleLocationError(true, infoWindow1, map.getCenter());
        });
        $("#from").focus(function () {
            $(this).parent().get(0).MaterialTextfield.change(adress);
            //marker.setPosition(pos);
        });
        $("#off_from").focus(function () {
            $(this).parent().get(0).MaterialTextfield.change(adress);
            //marker.setPosition(pos);
          });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow1, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, infoWindow1, pos) {
    infoWindow1.setPosition(pos);
    infoWindow1.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow1.open(map);
}$("#search2").click(function (e) {
            var formdata = $("#offer_form").serialize();
            e.preventDefault();
            var from = $("#off_from").val().trim();
            var to = $("#off_to").val().trim();
            var c = 0;
            if (from === '') {
                c++;
                $("#err1").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please fill the from field</h6>");
            } else {
                $("#err1").css("display","none");
                        }
            if (to === "") {
                c++;
                $("#err2").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please fill the destination field</h6>");
            } else {
                $("#err2").css("display","none");
            }
            var seats = $("#seats").val().trim();
            if (seats === '' ||  seats === "0") {
                c++;
                $("#err3").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please enter valid number of seats</h6>");
            } else {
                $("#err3").css("display","none");
            }
            var pickup = $("#pickup").val().trim();
            if (pickup === "") {
                $("#err4").show().empty().append("<h6 class='mdl-text mdl-color-text--green' style='font-size:15px;'>To increase your chances of getting a ride,add a pickup location</h6>");
            }
            if(from!==""&&to!=="")
            {
            if(from===to)
            {
                c++;
                $("#err2").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Destination and origin can not be same</h6>");
            }
else
{
    $("#err2").css("display","none");
}
            }
if(from!==""&&pickup!=="")
{
if(from===pickup)
{
    c++;
    $("#err4").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Destination and origin can not be same</h6>");
}
else
{
    $("#err4").css("display","none");
}
}
if(to!==""&&pickup!=="")
{
if(to===pickup)
{
    c++;
    $("#err4").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Destination and origin can not be same</h6>");

}
else
{
    $("#err4").css("display","none");

}
}
var price=$("#price").val().trim();
if(price===""||price==="0")
{
    c++;
    $("#err_price").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please Enter a valid amount</h6>");
}
else
{
    $("#err_price").css("display","none");
}
            if (c === 0) {
                marker3.setVisible(false);
                marker4.setVisible(false);
                marker5.setVisible(false);
                infoWindow1.close();
                marker.setVisible(false);
                $.ajax({
                    type: "POST",
                    url: "ride.php",
                    data: formdata,
                    cache: false
                }).done(
                    function (html) {
                        if (html === "continue") {
                            $("#ride2").css("display","none");
                            $("#cng").empty();
                            $("#matrix2").show();
                            $("#matrix").show();
                            $("#err4").hide();
                            var desti = $("#off_to").val();
                            var otig = $("#off_from").val();
                            var way=[];
                            way.push({location:$("#pickup").val(),stopover: true});
                            //console.log(way);
                            if($("#pickup").val()===" "||$("#pickup").val()==="")
                            {
                            var h = {
                                origin: otig,
                                destination: desti,
                                travelMode: 'DRIVING',
                                drivingOptions: {
                                    departureTime: new Date(Date.now() + 360000),
                                    trafficModel: 'pessimistic'
                                },
                                unitSystem: google.maps.UnitSystem.METRIC
                            };
                        }
                        else
                        {
                            var h = {
                                origin: otig,
                                destination: desti,
                               waypoints:way,
                               optimizeWaypoints: true,
                                travelMode: 'DRIVING',
                                drivingOptions: {
                                    departureTime: new Date(Date.now() + 360000),
                                    trafficModel: 'pessimistic'
                                },
                                unitSystem: google.maps.UnitSystem.METRIC
                            };
                        }
                            service1.getDistanceMatrix({
                                origins: [otig],
                                destinations: [desti],
                                travelMode: 'DRIVING',
                                drivingOptions: {
                                    departureTime: new Date(Date.now() + 360000),
                                }
                            }, function (response, status) {
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
                                            $("#p_ride").prepend("<h2 class='mdl-text mdl-color-text--primary' id='cng' style='text-align:center;'>Congrats,You published A Ride!<h2>");
                                            $("#details_from").empty().text("From: " + from);
                                            $("#details_to").empty().text("To: " + to);
                                            $("#distance").empty().text("Distance: " + distance);
                                            $("#time").empty().text("Duration: " + duration);
                                            $("#map1").removeClass("mdl-cell--8-col").addClass("mdl-cell--12-col");
                                        }
                                    }
                                }
                            });
                            directionsService1.route(h, function (result, status) {
                                if (status == 'OK') {
                                // directionsDisplay.setMap(null);
                                    directionsDisplay1.setDirections(result);
                                }
                            });
                        }
                    else if(html==="login")
                {location.href = "login_form.php";
                }});}
            }
                );

        function geocodeAddress(geocoder, resultsMap, id) {
            var address = document.getElementById(id).value;
            geocoder.geocode({
                'address': address
            }, function (results, status) {
                if (status === 'OK') {
                    if (id === "from") {
                        infoWindow1.close();
                        var a = results[0].geometry.location;
                        marker.setPosition(results[0].geometry.location);
                        $("#find_from_lat").val(a.lat());
                        $("#find_from_lang").val(a.lng());
                    } else if (id === "to") {
                        var a = results[0].geometry.location;
                        marker1.setPosition(a);
                        $("#find_to_lat").val(a.lat());
                        $("#find_to_lang").val(a.lng());

                    }
                    else if(id==="pickup")
                    {
                        var a = results[0].geometry.location;
                        marker5.setPosition(results[0].geometry.location);
                        $("#pickup_lat").val(a.lat());
                        $("#pickup_lang").val(a.lng());
                    }
                }
            });
        }
        google.maps.event.addDomListener(window, 'load', initMap2);