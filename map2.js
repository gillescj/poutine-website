// Individual Location Map

// Create Map
var locationMap = L.map('sample-map');

// All leaflet maps need an attribution to highlight the contributers to the tile layer
const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
const tiles = L.tileLayer(tileUrl, {
    attribution
});
tiles.addTo(locationMap);

// Creating custon icon marker
const friesIcon = L.icon({
    iconUrl: '/img/fries-320.png',
    iconSize: [50, 32],
    iconAnchor: [25, 16],
});

function addMarker(lat, long, popup) {
    var marker = L.marker([lat, long], {
        icon: friesIcon
    });
    marker.addTo(locationMap);
    marker.bindPopup(popup);
}

function changeView(lat, long) {
    locationMap.setView([lat, long], 14);
}

// Hardcoded locations into map
// var marker1 = L.marker([43.258540, -79.878630], {
//     icon: friesIcon
// }).addTo(locationMap);

// marker1.bindPopup('<li>Smokes Poutinerie</li><li>112 George St, Hamilton, ON L8P 1E2</li>');