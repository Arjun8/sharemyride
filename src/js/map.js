var map, infoWindow1, autocomplete2, autocomplete1,autocomplete3,autocomplete4, marker, marker2, marker1,marker3,marker4,directionsService, directionsDisplay, service;
function fillinAddress2() {
    var place = autocomplete2.getPlace();
    marker2.setPosition(place.geometry.location);
}
function fillinAddress4() {
    var place = autocomplete4.getPlace();
    marker4.setPosition(place.geometry.location);
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
    marker3=new google.maps.Marker({map:map});
    marker4=new google.maps.Marker({map:map});
    var input1 = document.getElementById("from");
    var input2 = document.getElementById('to');
    var input3 = document.getElementById("off_from");
    var input4 = document.getElementById('off_to');
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
            }); autocomplete4 = new google.maps.places.Autocomplete(input4, {
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
            autocomplete1.setBounds(circle.getBounds());
            autocomplete2.setBounds(circle.getBounds());
            autocomplete3.setBounds(circle.getBounds());
            autocomplete4.setBounds(circle.getBounds());
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
$("#search2").click(function () {
    $("#matrix").show();
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
google.maps.event.addDomListener(window, 'load', initMap1);

