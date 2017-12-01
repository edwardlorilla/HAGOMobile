/**
 * Created by Lorilla on 30/09/2017.
 */

export var map = null
export var markerClusters = null
export var markers = []
export var userMarker = null
export function onLocationFound(e) {
    var radius = e.accuracy / 2;
    var userIcon = L.icon({
        iconUrl: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-64.png',
        iconSize: [32, 32]
    });

    var userLocation = L.marker([e.latlng.lat, e.latlng.lng], {
        icon: userIcon,
        title: "marker_",
        name: 'User Location',
        content: 'you are here',
        image: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-64.png'
    }).bindPopup("You are within " + radius + " meters from this point").openPopup();

    map.initlat = e.latlng.lat;
    map.initlng = e.latlng.lng
    markerClusters.addLayer(userLocation);
    markers.push(userLocation);
    map.addLayer(markerClusters)
    userMarker = new L.LatLng(e.latlng.lat, e.latlng.lng);
    plantSelected()
}


export var nearest = {
    marker: false
}
export function isNearestMarkerSort(){
    nearest.marker = !nearest.marker
}
export function plantSelected() {
    new Promise((resolve, reject) => {
        var plantPosition = new L.LatLng(PlantInfo.latitude, PlantInfo.longitude),
            photo = !_.isEmpty(PlantInfo.photos[0]) ? PlantInfo.photos[0].file : null
        var plantMarker = L.marker(plantPosition)
            .bindPopup(
                '<div style="z-index: 402; max-width: 80vw; ">' +
                '<h2>' + PlantInfo.name + '</h2>' + PlantInfo.description +
                '<img style="width: 100%;" src="' + photo + '"/>' +
                "</div>"
            )
        markerClusters.addLayer(plantMarker);
        markers.push(plantMarker);
        map.addLayer(markerClusters)


        if (!plantMarker._icon) {
            plantMarker.__parent.spiderfy();
        }

        plantMarker.openPopup();
        resolve()
    })
}
export var tileSet = {
    all: [
        {
            name: 'Streets ',
            tileLayer: 'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}'
        },
        {
            name: 'Hybrid',
            tileLayer: 'http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}'
        },
        {
            name: 'Satellite',
            tileLayer: 'http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}'
        },
        {
            name: 'Terrain',
            tileLayer: 'http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}'
        },
        {
            name: 'Terrain Stamen',
            tileLayer: 'http://tile.stamen.com/terrain/{z}/{x}/{y}.jpg'
        }, {
            name: 'OpenStreetMap',
            tileLayer: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }
        // {
        //   name: 'Terrain Stamen',
        //   mapquestLink :'<a href="http://www.mapquest.com//">MapQuest</a>',
        //   mapquestPic : '<img src="http://developer.mapquest.com/content/osm/mq_logo.png">',
        //   tileLayer: 'http://otile{s}.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.png'
        // }
    ]
}
export function mapInit() {
    markerClusters = L.markerClusterGroup();
    map = L.map('map', {
        center: [10.0, 5.0],
        minZoom: 2,
        zoom: 2,
        zoomControl: true
    })
    setTileSet(3)
    map.zoomControl.setPosition('bottomleft');

    map.locate({setView: false, maxZoom: 15});
    map.on('locationfound', onLocationFound);

    map.setView(new L.LatLng(PlantInfo.latitude, PlantInfo.longitude), 12)


}
export function setTileSet(selectedTileLayer) {
    var vm = this;
    var basemap = null
    var tile = tileSet.all[selectedTileLayer]
    if (tile.name == 'OpenStreetMap') {
        basemap = L.tileLayer(tile.tileLayer, {
            attribution: tile.attribution
        })
    } else {
        basemap = L.tileLayer(tile.tileLayer, {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });
    }


    if (map.hasLayer(basemap)) {
        map.removeLayer(basemap);
    }
    else {
        map.addLayer(basemap);
    }
}
export var keys = ['name']
export var options = {
    shouldSort: true,
    threshold: 0.6,
    location: 0,
    distance: 100,
    maxPatternLength: 32,
    minMatchCharLength: 1,
    keys: keys
}
export var currentPage = {
    url: 'plant-navigator',
    name: 'Repositories of Plants'
}
export function currentPageSwitcher(url, name) {
    new Promise((resolve, reject) => {
        resolve(
            currentPage.url = url,
            currentPage.name = name
        );
    })

}

export var popUp = {
    popoverVisible: false,
    popoverTarget: null,
    popoverDirection: 'up',
    coverTarget: false
}

export function showPopover(event, direction, coverTarget = false) {
    popUp.popoverTarget = event;
    popUp.popoverDirection = direction;
    popUp.coverTarget = coverTarget;
    popUp.popoverVisible = true;
}

export var Stack = {
    page: ['view-plant']
}

export function Push(page) {
    Stack.page.push(page)
}

export var StackItem = {
    page: ['plant-item']
}

export function PlantIndex(id) {
    var plant = _.findIndex(plantItem.all, {id: id});
    PlantFound.index = plantItem.all[plant];
    PlantInfo=plantItem.all[plant];
}
export const PlantFound = {
    index: null
}
export function PushItem(page) {
    StackItem.page.push(page)
}
export function popItem() {
    Stack.page.pop()
}
export function moreDetail() {
    currentPageSwitcher('plant-navigator', 'View Plant Repository')
    Stack.page.push("plant-item")
}
export var listView = {
    view: true
}
export function toggleView(){
    listView.view = !listView.view
}
export function setResults(result) {
    return new Promise((resolve, reject) => {
        resolve( getResults.all = result);
    })
}



export function cameraInfo(event){
    if(event.type == 'change'){
        return new Promise((resolve, reject) => {
            resolve( capturePhoto = event);
    })
    }else{
        event.target.value = null
    }
}
export var capturePhoto = null
export var getResults = {
    all: null
}
export function cnvrtRGBClrToHex(rgbClr){
    var rgbClr = rgbClr.split(',');
    var r = rgbClr[0];
    var g = rgbClr[1];
    var b = rgbClr[2];
    return (r << 16 | g << 8 | b).toString(16).toUpperCase()
}
export function hexColorDelta(hex1, hex2){
    var r1 = parseInt(hex1.substring(0, 2), 16);
    var g1 = parseInt(hex1.substring(2, 4), 16);
    var b1 = parseInt(hex1.substring(4, 6), 16);
    // get red/green/blue int values of hex2
    var r2 = parseInt(hex2.substring(0, 2), 16);
    var g2 = parseInt(hex2.substring(2, 4), 16);
    var b2 = parseInt(hex2.substring(4, 6), 16);
    // calculate differences between reds, greens and blues
    var r = 255 - Math.abs(r1 - r2);
    var g = 255 - Math.abs(g1 - g2);
    var b = 255 - Math.abs(b1 - b2);
    // limit differences between 0 and 1
    r /= 255;
    g /= 255;
    b /= 255;
    // 0 means opposit colors, 1 means same colors
    return (r + g + b) / 3;
}
export function get() {
    /*var spreadsheetID = '1Y2UtYW0Wl4QSTW_TYJiYgFIgrltmixecV9en0WhuUSc';
     var worksheetID = 'od6';
     var url = 'https://spreadsheets.google.com/feeds/list/' + spreadsheetID + '/' + worksheetID + '/public/values?alt=json';*/
    var url = '/api/repository'
    return axios({
        method: 'GET',
        url: url
    })
}

export function getData() {
    var url = '/api/repository'
    return axios({
        method: 'GET',
        url: url
    }).then(function (response) {

        var data = response.data
        plantItem.all = data
        getResults.all = data
        plantItem.count = data.length
    })
}

export function FormDataPost(file, payload, latitude, longitude,altitude, title, description, similarPlant) {
    var url = '/api/repository'
    if (typeof url !== 'string') {
        throw new TypeError(`Expected a string, got ${typeof url}`);
    }

    // You can add checks to ensure the url is valid, if you wish

    const formData = new FormData();
    formData.append('photos', file);
    formData.append('latitude', latitude);
    formData.append('colors', payload);
    formData.append('longitude', longitude);
    formData.append('altitude', _.isNull(altitude) ? 0 : altitude);
    formData.append('title', title);
    formData.append('repository_id', similarPlant);
    formData.append('description', description);
    const config = {
        headers: {
            'content-type': 'multipart/form-data'
        }
    };
    return axios.post(url, formData, config);
};


export var plantItem = {
    all: [],
    count: 0
}


const ErrorComponent = {
    name: 'error-component',
    template: '<div>error!</div>'
}

export const SWIPE_SIDE = {
    side: false
}

export function change_view() {
    var vm = SWIPE_SIDE
    vm.side = !vm.side
}


const LoadingComponent = {
    name: 'loading-component',
    template: `
                <div class="pulse">
                  <span></span>
                  H
                </div>
    `,
}

export var userLocation = {
    latitude: null,
    longitude: null
}

export function getUserLocation(position) {
    userLocation.latitude = position.latitude
    userLocation.longitude = position.longitude
}

export const PlantNavigator = () => ({
    component: new Promise((resolve, reject) => {
        setTimeout(() => {
            require(['./../View/PlantNavigator.vue'], resolve)
        }, 2000)
    }),
    loading: LoadingComponent,
    error: ErrorComponent,
    delay: 1
})


export var searchInput = {
    query: true
}
export var PlantInfo = null

export function PlantItem(plantInfo) {
    PlantInfo = plantInfo
    searchInput.query = false
}


export function MapPlantItem(plantInfo) {
    PlantInfo = plantInfo
    searchInput.query = false
}

export function toggleSearch() {
    var vm = searchInput
    vm.query = !vm.query
}
export function gps_distance(lat1, lon1, lat2, lon2) {
    var R = 6371; // km
    var dLat = (lat2 - lat1) * (Math.PI / 180);
    var dLon = (lon2 - lon1) * (Math.PI / 180);
    var lat1 = lat1 * (Math.PI / 180);
    var lat2 = lat2 * (Math.PI / 180);
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c;
    return d;
}

