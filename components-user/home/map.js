// Initialize the platform object
var platform = new H.service.Platform({
    'apikey': '0oPAj_xKI3llVzuyNB8ub1Kb7XTc7wHTdlWRc_qX_uU'
});

// Obtain the default map types from the platform object
var maptypes = platform.createDefaultLayers();

// Instantiate (and display) the map
var map = new H.Map(
    document.getElementById('mapContainer'),
    maptypes.vector.normal.map,
    {
        zoom: 12,
        center: { lat: -6.91266, lng: 107.60791 },
        padding: { top: 50, right: 50, bottom: 50, left: 50 }
    });

var routeInstructionsContainer = document.getElementById('panel');

// MapEvents enables the event system.
// The behavior variable implements default interactions for pan/zoom (also on mobile touch environments).
const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

// Enable dynamic resizing of the map, based on the current size of the enclosing container
window.addEventListener('resize', () => map.getViewPort().resize());

// Create the default UI:
const ui = H.ui.UI.createDefault(map, maptypes);

// Enable Search Service
const searchService = platform.getSearchService();

// Function to geocode an address using the search service:
function geocodeAddress(address) {
    return new Promise((resolve, reject) => {
        searchService.geocode({
            'q': address
        }, result => {
            const location = result.items[0].position;
            const {
                lat,
                lng
            } = location;
            resolve({
                lat,
                lng
            });
        }, error => {
            console.error(`Error fetching geocoding data for ${address}:`, error);
            reject(error);
        });
    });
}

// Function to calculate route between origin and destination
function calculateRoute() {
    // Remove previous route from the map
    map.removeObjects(map.getObjects());

    const originAddress = document.getElementById('origin').value;
    const destinationAddress = document.getElementById('destination').value;
    const mode = document.getElementById('mode').value;

    // Use Promise.all to geocode both origin and destination addresses
    Promise.all([
        geocodeAddress(originAddress),
        geocodeAddress(destinationAddress)
    ]).then(([origin, destination]) => {
        // Create routing parameters for calculating the route
        const routingParameters = {
            'routingMode': 'fast',
            'transportMode': mode,
            'origin': `${origin.lat},${origin.lng}`,
            'destination': `${destination.lat},${destination.lng}`,
            'return': 'polyline,actions,travelSummary',
        };

        if (mode === 'publicTransport') {
            routingParameters['routingMode'] = 'fast';
            routingParameters['transportMode'] = 'publicTransport';
            calculatePublicTransportRoute(routingParameters, origin, destination);
        } else {
            routingParameters['routingMode'] = 'fast';
            routingParameters['transportMode'] = mode;
            calculateOtherTransportRoute(routingParameters, origin, destination);
        }

    }).catch(error => {
        console.error('Error fetching coordinates:', error);
    });
}

function calculatePublicTransportRoute(routingParameters, origin, destination) {
    const router = platform.getPublicTransitService();

    router.getRoutes(routingParameters, result => {
        if (result.routes.length) {
            displayRoute(result.routes[0], origin, destination);
            addManueversToMap(result.routes[0]);
            addManueversToPanel(result.routes[0]);
            addSummaryToPanel(result.routes[0]);
        }
    }, error => {
        alert(error.message);
    });
}

function calculateOtherTransportRoute(routingParameters, origin, destination) {
    const router = platform.getRoutingService(null, 8);

    router.calculateRoute(routingParameters, result => {
        if (result.routes.length) {
            displayRoute(result.routes[0], origin, destination);
        }
    }, error => {
        alert(error.message);
    });
}

function displayRoute(route, origin, destination) {
    const lineStrings = [];
    route.sections.forEach((section) => {
        lineStrings.push(H.geo.LineString.fromFlexiblePolyline(section.polyline));

        const mode = document.getElementById('mode').value;

        if (mode !== 'publicTransport') {
            // Extract travel time and distance from the section summary
            const travelTime = section.travelSummary.duration; // in seconds
            const distance = section.travelSummary.length; // in meters

            // Display travel time and distance
            document.getElementById('travelTime').innerText = `Estimasi Waktu: ${Math.floor(travelTime / 60)} minutes`;
            document.getElementById('distance').innerText = `Jarak Tempuh: ${(distance / 1000).toFixed(2)} km`;
        } else {
            // Display travel time and distance
            document.getElementById('travelTime').innerText = ``;
            document.getElementById('distance').innerText = ``;
        }
        
    });

    const multiLineString = new H.geo.MultiLineString(lineStrings);
    const routeLine = new H.map.Polyline(multiLineString, {
        style: {
            strokeColor: 'blue',
            lineWidth: 4
        }
    });

    const startMarker = new H.map.Marker(origin);
    const endMarker = new H.map.Marker(destination);

    const group = new H.map.Group();
    group.addObjects([routeLine, startMarker, endMarker]);
    map.addObject(group);

    map.getViewModel().setLookAtData({
        bounds: group.getBoundingBox()
    });
}

function addManueversToMap(route){
  var svgMarkup = '<svg width="18" height="18" ' +
    'xmlns="http://www.w3.org/2000/svg">' +
    '<circle cx="8" cy="8" r="8" ' +
      'fill="#1b468d" stroke="white" stroke-width="1"  />' +
    '</svg>',
    dotIcon = new H.map.Icon(svgMarkup, {anchor: {x:8, y:8}}),
    group = new  H.map.Group(),
    i;

    route.sections.forEach((section) => {
      let poly = H.geo.LineString.fromFlexiblePolyline(section.polyline).getLatLngAltArray();

      let actions = section.actions;
      // Add a marker for each maneuver
      if (actions) {
        for (i = 0;  i < actions.length; i += 1) {
          let action = actions[i];
          var marker =  new H.map.Marker({
            lat: poly[action.offset * 3],
            lng: poly[action.offset * 3 + 1]},
            {icon: dotIcon});
          marker.instruction = action.instruction;
          group.addObject(marker);
        }
      }
    });

    group.addEventListener('tap', function (evt) {
      map.setCenter(evt.target.getGeometry());
      openBubble(
        evt.target.getGeometry(), evt.target.instruction);
    }, false);

    // Add the maneuvers group to the map
    map.addObject(group);
}

function addManueversToPanel(route){
    var nodeOL = document.createElement('ol');
  
    nodeOL.style.fontSize = 'small';
    nodeOL.style.marginLeft ='5%';
    nodeOL.style.marginRight ='5%';
    nodeOL.className = 'directions';
  
    route.sections.forEach((section) => {
      if (section.actions) {
        section.actions.forEach((action, idx) => {
          var li = document.createElement('li'),
              spanArrow = document.createElement('span'),
              spanInstruction = document.createElement('span');
  
          spanArrow.className = 'arrow ' + (action.direction || '') + action.action;
          spanInstruction.innerHTML = section.actions[idx].instruction;
          li.appendChild(spanArrow);
          li.appendChild(spanInstruction);
  
          nodeOL.appendChild(li);
        });
      }
    });
  
    routeInstructionsContainer.appendChild(nodeOL);
}

function addSummaryToPanel(route){
  let duration = 0,
      distance = 0;

  route.sections.forEach((section) => {
    distance += section.travelSummary.length;
    duration += section.travelSummary.duration;
  });

  var summaryDiv = document.createElement('div'),
   content = '';
   content += '<b>Jarak Tempuh</b>: ' + (distance / 1000).toFixed(2)  + ' km. <br/>';
   content += '<b>Estimasi Waktu</b>: ' + duration.toMMSS();


  summaryDiv.style.fontSize = 'small';
  summaryDiv.style.marginLeft ='5%';
  summaryDiv.style.marginRight ='5%';
  summaryDiv.innerHTML = content;
  routeInstructionsContainer.appendChild(summaryDiv);
}

Number.prototype.toMMSS = function () {
    return  Math.floor(this / 60)  +' minutes ';
  }