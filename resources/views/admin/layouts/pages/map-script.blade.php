<style>
    #mapCanvas{  height: 400px; width: 100%;}
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAN9c25X4Ly1mQAekZlNMjwqlE34taPZ8&libraries=places"></script>
<script type="text/javascript">    
    function updateMarkerPosition(latLng) {
        $('input[name="latitude"]').val(latLng.lat());
        $('input[name="longitude"]').val(latLng.lng());        
    }
    var geoCoder;
    var map;
    var address = $('input[name="property_street"]').val() +' '+ $('input[name="property_city"]').val();
    var lat = $('input[name="latitude"]').val();
    var lng = $('input[name="longitude"]').val();

    var mapStatus = $('input[name="lngLatStatus"]').val();

    function initialize() {        
        geoCoder = new google.maps.Geocoder();
        lat = lat ? lat : '-35.397';
        lng = lng ? lng : '150.644';
        var latlng = new google.maps.LatLng(lat, lng);
        var myOptions = {
            zoom: 13,
            center: latlng,
            mapTypeControl: true,
            mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
            navigationControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);           
        if (geoCoder) {
            geoCoder.geocode( { 'address': address }, function(results, status) {                
                if (status == google.maps.GeocoderStatus.OK || mapStatus == 'true') {
                    if (status != google.maps.GeocoderStatus.ZERO_RESULTS || mapStatus == 'true') {
                        var position;

                        if(mapStatus == 'false'){
                            map.setCenter(results[0].geometry.location);
                            position= results[0].geometry.location;
                        }else{
                            position= latlng;
                        }

                        var infowindow = new google.maps.InfoWindow(
                        { content: '<b>'+address+'</b>',
                            size: new google.maps.Size(150,50)
                        });

                        var marker = new google.maps.Marker({
                            position: position,
                            map: map,
                            title:address,
                            draggable: true
                        });
                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map,marker);
                        });

                        // Update current position info.
                        updateMarkerPosition(latlng);

                        google.maps.event.addListener(marker, 'drag', function() {
                            updateMarkerPosition(marker.getPosition());
                        });
                    } else {
                        alert("No results found");
                    }
                } else {
                    alert("Your mentioned address could not be found.");
                    // alert("Geocode was not successful for the following reason: " + status);
                }
            });
        }
    }

    // Onload handler to fire off the app.
    google.maps.event.addDomListener(window, 'load', initialize);
</script>