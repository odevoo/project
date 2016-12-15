$(window).ready(function(e){
        var id = $('#id-student').val();

    $.ajax({
      url: 'http://localhost/project/public/getlatlng/' + id,
      method: 'POST',
      dataType: 'json',
      
      success: function(data){
                    lat = data.data.lat;
                    lng = data.data.lng;
                    initialize(lat,lng);
         
      }
    });

        initialize();
});
function initialize(lat, lng) {
        var mapOptions = {
            center: new google.maps.LatLng(lat, lng), 
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('js-map-container'), mapOptions);
        map.setZoom(13);
}


$(window).ready(function(e) {

  $.ajax({
      url: 'getallteachers',
      method: 'POST',
      dataType: 'json',
      
      success: function(data){
          
         var result = data;
         
          
          $.each(data.data,function(index, value){
                    
                    var i =0;
                    lat = data.data[index].lat;
                    lng = data.data[index].lng;
                    firstname = data.data[index].firstname;
                    lastname = data.data[index].lastname;
                    rating = data.data[index].rating;
                    avatar = '../../public/assets/' + data.data[index].avatar;
                    id = data.data[index].id;
                    addMarker(i, lat, lng, firstname, lastname, rating, avatar, id);
                    i++;
                });

         
      }
    });






function addMarker(i, lat, lng, firstname, lastname, rating, avatar, id) {
    if (lat != null && lng != null) {
        var markersArray = [];
        myLatLng = new google.maps.LatLng(lat, lng);
        bounds = new google.maps.LatLngBounds();
        var img = $('#img-maps').val();
        eval('var marker' + i + ' = new google.maps.Marker({ position: myLatLng,  map: map, icon: img,animation: google.maps.Animation.DROP, zIndex: i});');
        
        var marker_obj = eval('marker' + i);
        bounds.extend(marker_obj.position);
        markersArray.push(eval('marker' + i));
        marker_obj.title = name;
        var li_obj = '.js-map-num' + i;
        image = '';
        var content = '<div class=""><h4 class="text-center">' + firstname + ' ' + lastname + '</h4><div class=""><div class="col-md-6"><img style="height:128px;width:128px;" class="img-thumbnail" src="' + avatar + '"></div><div class="col-md-6"><p>Tarif: ' + rating +'€/h</p><p class="text-center"><a href="../profile/' + id + '"><button class="btn btn-primary">Visiter le profil</button></a></p></div></div></div>';
        eval('var infowindow' + i + ' = new google.maps.InfoWindow({ content: content,  maxWidth: 400});');
        var infowindow_obj = eval('infowindow' + i);
        var marker_obj = eval('marker' + i);
        google.maps.event.addListener(marker_obj, 'click', function () {
            infowindow_obj.open(map, marker_obj);
        });
    }
}



});