<script>
  var map;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 49.8773953, lng: -97.2064861},
      zoom: 10
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=MY_GOOGLE_API_KEY=initMap"
async defer></script>