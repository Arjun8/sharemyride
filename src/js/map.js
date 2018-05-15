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

function initMap1() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 31.2186,
            lng: 75.7725
        },
        zoom: 10
    });
    service = new google.maps.DistanceMatrixService();
    directionsService = new google.maps.DirectionsService();
    directionsDisplay = new google.maps.DirectionsRenderer();
    directionsDisplay.setMap(map);
    infoWindow1 = new google.maps.InfoWindow;
    var pos = {};
    var a = "";
    var b = "";
    var d = " ";
    var adress;
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
}
$("#search1").click(function (e) {
            $("#matrix2").show();
            $("#f_ride").show();
            $("#ride_map").show();
            var formdata = $("#find_form").serialize();
            e.preventDefault();
            var destination = $("#to").val();
            var source = $("#from").val();
            marker.setVisible(false);
            marker1.setVisible(false);
            var c = 0;
            if (source === " " || source === "") {
                c++;
                $("#e_from").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please fill the from field</h6>");
            } else {
                $("#e_from").css("display", "none");
            }
            if (destination === " " || destination === "") {
                c++;
                $("#e_to").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please fill the to  field</h6>");
            } else {
                $("#e_to").css("display", "none");
            }
            var date = $("#find_date").val();
            if (date === "" || date === " ") {
                c++;
                $("#e_date").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please fill the date of journey</h6>");
            } else {
                $("#e_date").css("display", "none");
            }
            if (c === 0) {
                $.ajax({
                    type: "POST",
                    url: "search.php",
                    data: formdata,
                    cache: false
                }).done(
                    function (html) {
                        if (html === "0 rows") {
                            $("#ride_map1").show();
                           // console.log("Hello"+html);
                            $("#f_ride").hide();
                            $("#matrix2").show();
                            $("#matrix").show();
                            $("#map").removeClass("mdl-cell--8-col").addClass("mdl-cell--4-col");
                            $("#ride_map2").empty().show().html("<h2>There are no journeys published for this region</h2>");
                        } else if (html === "") {
                            $("#matrix2").show();
                            $("#matrix").show();
                            $("#ride_map1").show();
                            $("#f_ride").hide();
                            $("#map").removeClass("mdl-cell--8-col").addClass("mdl-cell--4-col");
                            $("#ride_map2").empty().show().html("<h2>There are no journeys published for this region</h2>");
                        } else {
                            $("#matrix2").show();
                            $("#ride_map1").show();
                            $("#matrix").show();
                            $("#f_ride").hide();
                            $("#map").removeClass("mdl-cell--8-col").addClass("mdl-cell--4-col");
                            $("#ride_map2").empty().show().html(html);
                            //console.log(html);
                        }});}
                    var h = {
                        origin: source,
                        destination: destination,
                        travelMode: 'DRIVING',
                        drivingOptions: {
                            departureTime: new Date(Date.now() + 360000),
                            trafficModel: 'pessimistic'
                        },
                        unitSystem: google.maps.UnitSystem.METRIC
                    }; service.getDistanceMatrix({
                        origins: [source],
                        destinations: [destination],
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
                                    $("#details_from").empty().text("From: " + source);
                                    $("#details_to").empty().text("To: " + to);
                                    $("#distance").empty().text("Distance: " + distance);
                                    $("#time").empty().text("Duration: " + duration);
                                }
                            }
                        }
                    }); directionsService.route(h, function (result, status) {
                        if (status == 'OK') {
                           // directionsDisplay1.setMap(null);
                            directionsDisplay.setDirections(result);
                           }
                    });
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
                }
            });
        }
        google.maps.event.addDomListener(window, 'load', initMap1);