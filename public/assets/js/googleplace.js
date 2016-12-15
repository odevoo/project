var autocomplete = {};
    var autocompletesWraps = ['autocomplete', 'autocompleteteach'];

    var test_form = { street_number: 'short_name', route: 'long_name', locality: 'long_name', administrative_area_level_1: 'short_name', country: 'long_name', postal_code: 'short_name'};
    var test2_form = { street_number: 'short_name', route: 'long_name', locality: 'long_name', administrative_area_level_1: 'short_name', country: 'long_name', postal_code: 'short_name'};

    function initAutocomplete() {

      $.each(autocompletesWraps, function(index, name) {
      
        if($('#'+name).length == 0) {
          return;
        }

        autocomplete[name] = new google.maps.places.Autocomplete($('#'+ name)[0], { types: ['geocode'] });
          
        google.maps.event.addListener(autocomplete[name], 'place_changed', function() {
          
          var place = autocomplete[name].getPlace();
          var form = ['street_number', 'route'];
          GetLatlong();
          for (var component in form) {
            $('#'+name+'_'+component).val('');
            $('#'+name+'_'+component).attr('disabled', false);
          }
          
          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            
              var val = place.address_components[i]['long_name'];
              $('#'+name+'_'+addressType).val(val);
            
          }
        });
      });
    }

function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}

function GetLatlong()
    {
        var geocoder = new google.maps.Geocoder();
        var address = document.getElementById('autocomplete').value;
        var addressteach = document.getElementById('autocompleteteach').value;
        geocoder.geocode({ 'address': address }, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                document.getElementById('autocomplete_lat').value = latitude;
                document.getElementById('autocomplete_lng').value = longitude;

            }
        });
        geocoder.geocode({ 'address': addressteach }, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                document.getElementById('autocompleteteach_lat').value = latitude;
                document.getElementById('autocompleteteach_lng').value = longitude;

            }
        });

        }

        