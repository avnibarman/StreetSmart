// $.getJSON( "geo.geojson", function(data ) {
//     var names = [];
//     var coordinates = [];
//     $.each( data.features, function(key, value) {
//         names.push(value.properties.name);
//     });
//
//     $.each( data.features, function(key, value) {
//         coordinates.push(value.geometry.coordinates);
//     });
//
//     var data = [];
//
//     for (i=0; i < names.length; i++){
//         data.push(
//             {
//                 name: names[i],
//                 coordinates: coordinates[i]
//             }
//         );
//     }
//
// });

google.maps.event.addDomListener(window, 'load', function () {

    var places = new google.maps.places.Autocomplete(document.getElementById('name'));
    google.maps.event.addListener(places, 'place_changed', function () {
        var place = places.getPlace();
        var address = place.formatted_address;
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();

        var result;

        result = findHood(latitude, longitude);
        //console.log("result = " + result);

        result.then(function(r){
            console.log(r);

            if(r == null){
                alert("Please enter an address in the Los Angeles area. Thank you!");
            }else{
                document.getElementById("receivedLocation").value = r;
            }
        });



    });

    var findHood = function(latitude, longitude){

        //LatLng = new google.maps.LatLng({lat: latitude, lng: longitude});
        var latlong = new google.maps.LatLng({lat: latitude, lng: longitude});
        //var latlong_poly = new google.maps.Polygon({paths: latlong});

        console.log("lat:" + latitude + " lng:" + longitude);

        var data = [];


        data = getJson('geo.geojson').then(function(data){

            var names = [];
            var coordinates = [];
            $.each( data.features, function(key, value) {
                names.push(value.properties.name);
            });

            $.each(data.features, function(key, value) {
                coordinates.push(value.geometry.coordinates);
            });

            var data = [];

            for (i=0; i < names.length; i++){
                data.push(
                    {
                        name: names[i],
                        coordinates: coordinates[i]
                    }
                );
            }

            //console.log(data);
            return data;

        }, function(status){
            alert("error" + status);
        });

        var sr = data.then(function(result){

            //go through array and see if long/lat is contained in polygon
            //var coords = [];
            var search_result;
            //console.log(result[1].coordinates[0][0][0][1]);

            for (i=0; i < result.length; i++) {

                var coords = [];

                for(x=0; x < result[i].coordinates[0][0].length; x++){

                    coords.push({lat: result[i].coordinates[0][0][x][1], lng: result[i].coordinates[0][0][x][0]});
                    //console.log("lng:"+result[i].coordinates[0][0][x][0]+", lat:" + result[i].coordinates[0][0][x][1]);
                }

                var polygon = new google.maps.Polygon({paths: coords});

                //console.log(google.maps.geometry.poly.containsLocation(LatLng, polygon));

                if (google.maps.geometry.poly.containsLocation(latlong, polygon)){

                    search_result = result[i].name;
                    break;
                }
            }

            return search_result;

        });

        return sr;
    };

});

var getJson = function(url){
    return new Promise(function(resolve, reject){
        var xhr = new XMLHttpRequest();
        xhr.open('get', url, true);
        xhr.responseType='json';
        xhr.onload=function(){
            var status = xhr.status;
            if(status == 200){
                //console.log("success");
                resolve(xhr.response);
            }else{
                //console.log("fail");
                reject(status);
            }
        };
        xhr.send();
    });
};
