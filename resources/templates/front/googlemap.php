<script>
function initMap() {
    // The location of Winnipeg
    const winnipeg = { lat: 49.8773953, lng: -97.2064861 };
    // The map, centered at Winnipeg
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: winnipeg,
    });
    // The marker, positioned at Winnipeg
    const marker = new google.maps.Marker({
        position: winnipeg,
        map: map,
    });
}
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?&sensor=false&key=AIzaSyDYjxOnHV8B_aVhv4WhKf4GN8W1dC40v8c&callback=initMap"
    async
    ></script>
