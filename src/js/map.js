var map, infoWindow1, autocomplete2, autocomplete1, autocomplete3, autocomplete4, autocomplete5, marker, marker2, marker5, marker1, marker3, marker4, directionsService, directionsDisplay, service;

function fillinAddress2() {
    var place = autocomplete2.getPlace();
    marker2.setPosition(place.geometry.location);
}

function fillinAddress4() {
    var place = autocomplete4.getPlace();
    marker4.setPosition(place.geometry.location);
    $("#to_lat").val(place.geometry.location.lat());
    $("#to_lang").val(place.geometry.location.lng());
    console.log(place.geometry.location.lat());
}

function fillinAddress5() {
    var place = autocomplete5.getPlace();
    marker5.setPosition(place.geometry.location);
}

function fillinAddress1() {
    infoWindow1.close();
    marker.setVisible(false);
    var place = autocomplete1.getPlace();
    marker1.setPosition(place.geometry.location);
}

function fillinAddress3() {
    infoWindow1.close();
    marker.setVisible(false);
    var place = autocomplete3.getPlace();
    marker3.setPosition(place.geometry.location);
    $("#from_lat").val(place.geometry.location.lat());
    $("#from_lang").val(place.geometry.location.lng());
}

function initMap1() {
    service = new google.maps.DistanceMatrixService();
    directionsService = new google.maps.DirectionsService();
    directionsDisplay = new google.maps.DirectionsRenderer();
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 31.2186,
            lng: 75.7725
        },
        zoom: 10
    });
    directionsDisplay.setMap(map);
    infoWindow1 = new google.maps.InfoWindow;
    var pos = {};
    var a = "";
    var b = "";
    var d = " ";
    var adress;
    marker2 = new google.maps.Marker({
        map: map,
    });
    marker1 = new google.maps.Marker({
        map: map,
    });
    marker3 = new google.maps.Marker({
        map: map,
    });
    marker4 = new google.maps.Marker({
        map: map,
    });
    marker5 = new google.maps.Marker({
        map: map,
    });
    marker3 = new google.maps.Marker({
        map: map
    });
    marker4 = new google.maps.Marker({
        map: map
    });
    var input1 = document.getElementById("from");
    var input2 = document.getElementById('to');
    var input3 = document.getElementById("off_from");
    var input4 = document.getElementById('off_to');
    var input5 = document.getElementById('pickup');
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            marker = new google.maps.Marker({
                map: map,
                position: pos
            });
            a = (position.coords.latitude);
            b = (position.coords.longitude);
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
            autocomplete1 = new google.maps.places.Autocomplete(input1, {
                types: ['geocode'],
                bounds: defaultBounds,
            });
            autocomplete2 = new google.maps.places.Autocomplete(input2, {
                types: ['geocode']
            });
            autocomplete3 = new google.maps.places.Autocomplete(input3, {
                types: ['geocode']
            });
            autocomplete4 = new google.maps.places.Autocomplete(input4, {
                types: ['geocode']
            });
            autocomplete5 = new google.maps.places.Autocomplete(input5, {
                types: ['geocode']
            });
            autocomplete1.setTypes(['(cities)']);
            autocomplete1.setComponentRestrictions({
                'country': 'in'
            });
            autocomplete1.setBounds
            autocomplete1.addListener('place_changed', fillinAddress1);
            autocomplete2.setTypes(['(cities)']);
            autocomplete2.setComponentRestrictions({
                'country': 'in'
            });
            autocomplete2.addListener('place_changed', fillinAddress2);
            autocomplete3.setTypes(['(cities)']);
            autocomplete3.setComponentRestrictions({
                'country': 'in'
            });
            autocomplete3.addListener('place_changed', fillinAddress3);
            autocomplete4.setTypes(['(cities)']);
            autocomplete4.setComponentRestrictions({
                'country': 'in'
            });
            autocomplete4.addListener('place_changed', fillinAddress4);
            autocomplete5.setTypes(['(cities)']);
            autocomplete5.setComponentRestrictions({
                'country': 'in'
            });
            autocomplete5.addListener('place_changed', fillinAddress5);
            autocomplete1.setBounds(circle.getBounds());
            autocomplete2.setBounds(circle.getBounds());
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
        });
        $("#off_from").focus(function () {
            $(this).parent().get(0).MaterialTextfield.change(adress);
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
}
$("#search1").click(function () {
    $("#matrix").show();
    var desti = $("#to").val();
    var otig = $("#from").val();
    marker1.setVisible(false);
    marker2.setVisible(false);
    marker.setVisible(false);
    var h = {
        origin: desti,
        destination: otig,
        travelMode: 'DRIVING',
        drivingOptions: {
            departureTime: new Date(Date.now() + 360000),
            trafficModel: 'pessimistic'
        },
        unitSystem: google.maps.UnitSystem.METRIC
    };
    service.getDistanceMatrix({
        origins: [desti],
        destinations: [otig],
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
                    $("#details").text("Distance and time required between " + from + " and " + to + ".");
                    $("#distance").text("Distance: " + distance);
                    $("#time").text("Duration: " + duration);
                }
            }
        }
    });
    directionsService.route(h, function (result, status) {
        if (status == 'OK') {
            directionsDisplay.setDirections(result);
        }
    });
});
$("#search2").click(function (e) {
    var formdata = $("#offer_form").serialize();
    e.preventDefault();
    var from=$("#off_from").val();
    var to=$("#off_to").val();
    var c=0;
    if ( from== '' || from ==" ") {

    $("#err1").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please fill the from field</h6>");
}
else{
    $("#err1").hide();
    
}
 if(to==""||to==" ")
{
    c++;
    $("#err2").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please fill the destination field</h6>");
}
else
{
    $("#err2").hide();
    
}
var seats=$("#seats").val();
if(seats==''||seats==" "||seats==="0")
{c++;
    $("#err3").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please enter valid number of seats</h6>");
}
else
{
$("#err3").hide();
}
var pickup=$("#pickup").val();
    if(pickup==" "||pickup=="")
    {
        $("#err4").show().empty().append("<h6 class='mdl-text mdl-color-text--green'>To increase your chances of getting a ride,add a pickup location</h6>");
    }
if(c===0)
{

    $.ajax({
        type: "POST",
        url: "ride.php",
        data: formdata,
        cache: false
    }).done(
        function (html) {
            if (html === "continue") {
                $("#matrix").show();
                $("#err4").hide();
                var desti = $("#off_to").val();
                var otig = $("#off_from").val();
                marker3.setVisible(false);
                marker4.setVisible(false);
                marker.setVisible(false);
                var h = {
                    origin: desti,
                    destination: otig,
                    travelMode: 'DRIVING',
                    drivingOptions: {
                        departureTime: new Date(Date.now() + 360000),
                        trafficModel: 'pessimistic'
                    },
                    unitSystem: google.maps.UnitSystem.METRIC
                };
                service.getDistanceMatrix({
                    origins: [desti],
                    destinations: [otig],
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
                                $("#details_from").text("From: " + from);
                                $("#details_to").text("To: " + to);
                                $("#distance").text("Distance: " + distance);
                                $("#time").text("Duration: " + duration);
                            }
                        }
                    }
                });
                directionsService.route(h, function (result, status) {
                    if (status == 'OK') {
                        directionsDisplay.setDirections(result);
                    }
                });
                $("#off_errors").hide();
            } else {
                $("#off_errors").show();
                $("#off_errors").empty().append(html);
                var h = $("#ride_2").height();
                $("#map").css("height", h);
                console.log(c);

            }

        }
    );}
    else
    {
        console.log(c);
        c=0;
        $("#off_errors").hide();
    }
});
google.maps.event.addDomListener(window, 'load', initMap1);