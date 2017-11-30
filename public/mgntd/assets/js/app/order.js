var orderScript = {
  
  init: function($) {
    //orderScript.initGoogleMap();
  }
};
jQuery(document).ready(function($) {
  "use strict";
  orderScript.init($);
});

function initGoogleMap() { //AIzaSyCVaL6DpD2gvg8MXCBLbPQE9xacvKsZ5Jk
  var locations = LOCATIONS;
  var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 19,
      center: new google.maps.LatLng(53.381021, -2.608138),
      mapTypeId: google.maps.MapTypeId.TERRAIN,
      scrollwheel: false
  });
  var infowindow = new google.maps.InfoWindow();
  var geocoder = new google.maps.Geocoder();
  var bounds = new google.maps.LatLngBounds();
  var marker, i;
  for (i = 0; i < locations.length; i++) {
    codeAddress(locations[i],geocoder,map,locations,bounds);
  }
  var legend = document.getElementById('mapLegend');
  /*for (var key in icons) {
      var type = icons[key];
      var name = type.name;
      var icon = type.icon;
      var div = document.createElement('div');
      div.innerHTML = '<img src="' + icon + '"> ' + name;
      legend.appendChild(div);
  }*/
  var div = document.createElement('div');
  div.innerHTML = '<h4><i class="fa fa-map-marker" aria-hidden="true"></i> FROM</h4><p>Świdnica, PL</p>';
  legend.appendChild(div);
  var div = document.createElement('div');
  div.innerHTML = '<h4><i class="fa fa-map-marker" aria-hidden="true"></i> TO</h4><p>CITY, COUNTRY</p>';
  legend.appendChild(div);
  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
}
function codeAddress(location,geocoder,map,locations,bounds) {
  geocoder.geocode({
      'address': location[1]
  }, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
          var marker = new google.maps.Marker({
              map: map,
              title: location[1],
              url: locations[2],
              position: results[0].geometry.location
          });
          bounds.extend(marker.getPosition());
          map.fitBounds(bounds);
          google.maps.event.addListener(marker, 'dblclick', function () {
              window.location.href = this.url;
          });
          google.maps.event.addListener(marker, 'click', (function (marker, location) {
              return function () {
                  infowindow.setContent(location[0]);
                  infowindow.open(map, marker);
              };
          })(marker, location));
      } else {
          alert("Geocode was not successful for the following reason: " + status);
      }
  });
}