// Search Results Map

// Create the map
var resultsMap = L.map('results-map');

// All leaflet maps need an attribution to highlight the contributers to the tile layer
const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
const tiles = L.tileLayer(tileUrl, {
    attribution
});
tiles.addTo(resultsMap);

resultsMap.setMinZoom(4);

// Creating custon icon marker, changing its size and positioning
const friesIcon = L.icon({
    iconUrl: '/img/fries-320.png',
    iconSize: [50, 32],
    iconAnchor: [25, 16],
});

function addMarker(lat, long, popup) {
    var marker = L.marker([lat, long], {
        icon: friesIcon
    });
    marker.addTo(resultsMap);
    marker.bindPopup(popup);
}

function changeView(lat, long) {
    resultsMap.setView([lat, long], 14);
}
