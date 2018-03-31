var map, infoWindow, autocomplete2, autocomplete1, marker, marker2, marker1, directionsService, directionsDisplay, service;

function fillinAddress2() {
    var place = autocomplete2.getPlace();
    marker2.setPosition(place.geometry.location);
}

function fillinAddress1() {
    infoWindow.close();
    marker.setVisible(false);
    var place = autocomplete1.getPlace();
    marker1.setPosition(place.geometry.location);
}

function initMap() {
    service = new google.maps.DistanceMatrixService();
    directionsService = new google.maps.DirectionsService();
    directionsDisplay = new google.maps.DirectionsRenderer();
    map = new google.maps.Map(document.getElementById('map1'), {
        center: {
            lat: -34.397,
            lng: 150.644
        },
        zoom: 10
    });
    directionsDisplay.setMap(map);
    infoWindow = new google.maps.InfoWindow;
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
    var input1 = document.getElementById("off_from");
    var input2 = document.getElementById('off_to');
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
                infoWindow.setContent(adress);
            });
            var circle = new google.maps.Circle({
                center: pos,
                radius: position.coords.accuracy
            });
            autocomplete1 = new google.maps.places.Autocomplete(input1, {
                types: ['geocode']
            });
            autocomplete2 = new google.maps.places.Autocomplete(input2, {
                types: ['geocode']
            });
            autocomplete1.setTypes(['(cities)']);
            autocomplete1.setComponentRestrictions({
                'country': 'in'
            });
            autocomplete1.addListener('place_changed', fillinAddress1);
            autocomplete2.setTypes(['(cities)']);
            autocomplete2.setComponentRestrictions({
                'country': 'in'
            });
            autocomplete2.addListener('place_changed', fillinAddress2);
            autocomplete1.setBounds(circle.getBounds());
            autocomplete2.setBounds(circle.getBounds());
            infoWindow.setPosition(pos);
            infoWindow.open(map);
            map.setCenter(pos);
        }, function () {
            handleLocationError(true, infoWindow, map.getCenter());
        });
        $("#off_from").focus(function () {
            $(this).parent().get(0).MaterialTextfield.change(adress);
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
}
$("#search2").click(function () {
    $("#matrix").show();
    var desti = $("#off_to").val();
    var otig = $("#off_from").val();
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
google.maps.event.addDomListener(window, 'load', initMap);
