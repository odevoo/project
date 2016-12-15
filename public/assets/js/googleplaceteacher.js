var autocomplete = {};
    var autocompletesWraps = ['autocomplete', 'autocompleteteach'];

    var test_form = { street_number: 'short_name', route: 'long_name', locality: 'long_name', administrative_area_level_1: 'short_name', country: 'long_name', postal_code: 'short_name' };
    var test2_form = { street_number: 'short_name', route: 'long_name', locality: 'long_name', administrative_area_level_1: 'short_name', country: 'long_name', postal_code: 'short_name' };

    function initAutocomplete() {

      $.each(autocompletesWraps, function(index, name) {
      
        if($('#'+name).length == 0) {
          return;
        }

        autocomplete[name] = new google.maps.places.Autocomplete($('#'+ name)[0], { types: ['geocode'] });
          
        google.maps.event.addListener(autocomplete[name], 'place_changed', function() {
          
          var place = autocomplete[name].getPlace();
          var form = ['street_number', 'route'];

          for (var component in form) {
            $('#'+name+'_'+component).val('');
            $('#'+name+'_'+component).attr('disabled', false);
          }
          
          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            
              var val = place.address_components[i]['long_name'];
              console.log(place.address_components[i]['long_name']);
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
