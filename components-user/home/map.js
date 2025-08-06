// ===========================
// Initialization
// ===========================
const platform = new H.service.Platform({ apikey: 'YOUR_API_KEY' });
const defaultLayers = platform.createDefaultLayers();
const map = new H.Map(
  document.getElementById('mapContainer'),
  defaultLayers.vector.normal.map,
  {
    zoom: 12,
    center: { lat: -6.91266, lng: 107.60791 },
    padding: { top: 50, right: 50, bottom: 50, left: 50 },
  }
);
const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
const ui = H.ui.UI.createDefault(map, defaultLayers);
window.addEventListener('resize', () => map.getViewPort().resize());

const searchService = platform.getSearchService();
const routeInstructionsContainer = document.getElementById('panel');
const dotIcon = new H.map.Icon(
  '<svg width="18" height="18" xmlns="http://www.w3.org/2000/svg">' +
    '<circle cx="8" cy="8" r="8" fill="#1b468d" stroke="white" stroke-width="1"/>' +
    '</svg>',
  { anchor: { x: 8, y: 8 } }
);

// ===========================
// Utilities
// ===========================
function formatTravelSummary(duration, distance) {
  return {
    time: `Estimasi Waktu: ${Math.floor(duration / 60)} minutes`,
    dist: `Jarak Tempuh: ${(distance / 1000).toFixed(2)} km`,
  };
}

Number.prototype.toMMSS = function () {
  return Math.floor(this / 60) + ' minutes';
};

function clearPanel() {
  routeInstructionsContainer.innerHTML = '';
}

// ===========================
// Geocoding
// ===========================
function geocodeAddress(address) {
  return new Promise((resolve, reject) => {
    searchService.geocode({ q: address }, result => {
      if (result.items.length) {
        const { lat, lng } = result.items[0].position;
        resolve({ lat, lng });
      } else {
        reject(new Error('Address not found'));
      }
    }, reject);
  });
}

// ===========================
// Route Calculation
// ===========================
async function calculateRoute() {
  try {
    map.removeObjects(map.getObjects());
    clearPanel();

    const originAddress = document.getElementById('origin').value;
    const destinationAddress = document.getElementById('destination').value;
    const mode = document.getElementById('mode').value;

    const [origin, destination] = await Promise.all([
      geocodeAddress(originAddress),
      geocodeAddress(destinationAddress)
    ]);

    const routingParameters = {
      routingMode: 'fast',
      transportMode: mode,
      origin: `${origin.lat},${origin.lng}`,
      destination: `${destination.lat},${destination.lng}`,
      return: 'polyline,actions,travelSummary'
    };

    if (mode === 'publicTransport') {
      calculatePublicTransportRoute(routingParameters, origin, destination);
    } else {
      calculateOtherTransportRoute(routingParameters, origin, destination);
    }
  } catch (error) {
    console.error('Error fetching coordinates:', error);
  }
}

function calculatePublicTransportRoute(params, origin, destination) {
  const router = platform.getPublicTransitService();
  router.getRoutes(params, result => {
    if (result.routes.length) {
      const route = result.routes[0];
      displayRoute(route, origin, destination);
      addManeuversToMap(route);
      addManeuversToPanel(route);
      addSummaryToPanel(route);
    }
  }, error => alert(error.message));
}

function calculateOtherTransportRoute(params, origin, destination) {
  const router = platform.getRoutingService(null, 8);
  router.calculateRoute(params, result => {
    if (result.routes.length) {
      const route = result.routes[0];
      displayRoute(route, origin, destination);
    }
  }, error => alert(error.message));
}

// ===========================
// Display Functions
// ===========================
function displayRoute(route, origin, destination) {
  const lineStrings = route.sections.map(section => H.geo.LineString.fromFlexiblePolyline(section.polyline));
  const multiLineString = new H.geo.MultiLineString(lineStrings);

  const routeLine = new H.map.Polyline(multiLineString, {
    style: { strokeColor: 'blue', lineWidth: 4 }
  });

  const startMarker = new H.map.Marker(origin);
  const endMarker = new H.map.Marker(destination);

  const group = new H.map.Group();
  group.addObjects([routeLine, startMarker, endMarker]);
  map.addObject(group);
  map.getViewModel().setLookAtData({ bounds: group.getBoundingBox() });

  if (document.getElementById('mode').value !== 'publicTransport') {
    const summary = formatTravelSummary(
      route.sections[0].travelSummary.duration,
      route.sections[0].travelSummary.length
    );
    document.getElementById('travelTime').innerText = summary.time;
    document.getElementById('distance').innerText = summary.dist;
  } else {
    document.getElementById('travelTime').innerText = '';
    document.getElementById('distance').innerText = '';
  }
}

function addManeuversToMap(route) {
  const group = new H.map.Group();
  route.sections.forEach(section => {
    const poly = H.geo.LineString.fromFlexiblePolyline(section.polyline).getLatLngAltArray();
    (section.actions || []).forEach(action => {
      const marker = new H.map.Marker({
        lat: poly[action.offset * 3],
        lng: poly[action.offset * 3 + 1]
      }, { icon: dotIcon });
      marker.instruction = action.instruction;
      group.addObject(marker);
    });
  });

  group.addEventListener('tap', evt => {
    map.setCenter(evt.target.getGeometry());
    openBubble(evt.target.getGeometry(), evt.target.instruction);
  });
  map.addObject(group);
}

function addManeuversToPanel(route) {
  const nodeOL = document.createElement('ol');
  nodeOL.className = 'directions';
  nodeOL.style.fontSize = 'small';
  nodeOL.style.margin = '0 5%';

  route.sections.forEach(section => {
    (section.actions || []).forEach(action => {
      const li = document.createElement('li');
      const spanArrow = document.createElement('span');
      const spanInstruction = document.createElement('span');

      spanArrow.className = 'arrow ' + (action.direction || '') + action.action;
      spanInstruction.innerHTML = action.instruction;

      li.appendChild(spanArrow);
      li.appendChild(spanInstruction);
      nodeOL.appendChild(li);
    });
  });

  routeInstructionsContainer.appendChild(nodeOL);
}

function addSummaryToPanel(route) {
  let duration = 0, distance = 0;
  route.sections.forEach(section => {
    duration += section.travelSummary.duration;
    distance += section.travelSummary.length;
  });

  const summary = formatTravelSummary(duration, distance);
  const summaryDiv = document.createElement('div');
  summaryDiv.style.fontSize = 'small';
  summaryDiv.style.margin = '0 5%';
  summaryDiv.innerHTML = `<b>Jarak Tempuh</b>: ${summary.dist}<br/><b>Estimasi Waktu</b>: ${summary.time}`;

  routeInstructionsContainer.appendChild(summaryDiv);
}

// Make sure to expose calculateRoute globally if called via onclick attribute
window.calculateRoute = calculateRoute;
