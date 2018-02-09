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
export function isNearestMarkerSort() {
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
            tileLayer: 'https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}'
        },{
            name: 'Statkart ',
            tileLayer: 'http://opencache.statkart.no/gatekeeper/gk/gk.open_gmaps?layers=norges_grunnkart&zoom={z}&x={x}&y={y}',
            attribution: '&copy; <a href="http://kartverket.no/">Kartverket</a>'
        },
        {
            name: 'Hybrid',
            tileLayer: 'https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}'
        },
        {
            name: 'Satellite',
            tileLayer: 'https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}'
        },
        {
            name: 'Terrain',
            tileLayer: 'https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}'
        },
        {
            name: 'Terrain Stamen',
            tileLayer: 'https://tile.stamen.com/terrain/{z}/{x}/{y}.jpg'
        }, {
            name: 'OpenStreetMap',
            tileLayer: 'https://{s}.tile.osm.org/{z}/{x}/{y}.png',
            attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        }
        // {
        //   name: 'Terrain Stamen',
        //   mapquestLink :'<a href="https://www.mapquest.com//">MapQuest</a>',
        //   mapquestPic : '<img src="https://developer.mapquest.com/content/osm/mq_logo.png">',
        //   tileLayer: 'https://otile{s}.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.png'
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

export var isAlive = {
    isWatch: false
}

export function isWatch(totalDistance ){
    console.log(totalDistance)
    isAlive.isWatch = !isAlive.isWatch
    var photo = PlantInfo ? PlantInfo.photos : null
    var timelinePhoto = !_.isEmpty(photo) ? 'images/thumb_' + photo[0].file : photo
    var getTimeline = { coords: coordinateMap.coords,plantInfo: timelinePhoto,  id: timeline.get.length,started_at: moment().format() , stopped_at: 0, duration: null, mile: totalDistance}
    if(isAlive.isWatch){
        writeData('timeline', getTimeline).then(function (data) {
            writeTimeline(data)
        })
    }else{
        var duration = moment.duration(moment(moment().format()).diff(moment(timeline.get[timeline.get.length - 1].started_at)))

        var get = {
            coords: coordinateMap.coords,
            plantInfo: timelinePhoto,
            id: timeline.get.length - 1,
            started_at: moment(timeline.get[timeline.get.length - 1].started_at).format("MM-DD-YYYY"),
            stopped_at: moment().format("MMM-DD-YYYY"),
            duration_at: duration.get("hours").toString().padStart(2, '0') + ":" + duration.get("minutes").toString().padStart(2, '0') + ":" + duration.get("seconds").toString().padStart(2, '0'),
            mile: totalDistance
        }
        updateItem('timeline', get)
        timeline.get[timeline.get.length - 1] = get
    }
}
export var coordinateMap = {
    coords: []
}
export var navigation = {
    page: ['view-timeline']
}
export var timelineItem = {
    item: null
}
export function timelineChanger(){

    navigation.page.push('timeline-detail')
}
export var currentPage = {
    url: 'plant-navigator',
    name: 'Repositories of Plants'
}
export function currentPageSwitcher(url, name) {
    if (name === 'Gallery') {
        listView.view = false
        toggleMySighting('0')
    } else if (name === 'Repositories of Plants') {
        listView.view = true
        toggleMySighting('1')
    }
    new Promise((resolve, reject) => {
        resolve(currentPage.url = url,
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
export var Chat = {
    page: ['chat']
}





export var chatInfo = {
    detail: null
}
export var getCurrent = {
    user: null
}
export function getCurrentUser(current){
    getCurrent.user = current
}

export function getChatInfo(chat){
    chatInfo.detail = chat
}
export function ChatPush(page) {
    Chat.page.push(page)
}
export function Push(page) {
    Stack.page.push(page)
}
export function Splice() {
    Stack.page.pop();
}
export var StackItem = {
    page: ['plant-item']
}
export function PlantIndex(id) {
    var plant = _.findIndex(plantItem.all, {id: id});
    PlantFound.index = plantItem.all[plant];
    PlantInfo = plantItem.all[plant];
}

export function mySigthing(){

    currentPageSwitcher('plant-navigator',"Repositories of Plants", 0)

}
export function clearPlantInfo(){
    PlantFound.index = null;
    PlantInfo = null;
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
    var currentPageName = PlantInfo.published
    mySighting.marker = currentPageName
    currentPageSwitcher('plant-navigator', 'Gallery' ,currentPageName )
    Stack.page.push("plant-item")
}

export function removeFirst() {
    Stack.page.shift()
}
export function AddFirst() {
    Stack.page.unshift('view-plant')
}
export var listView = {
    view: true
}

export var isAuth = {
    auth: window.authUser
}
export function toggleAuth() {
    isAuth.auth = !isAuth.auth
}
export function toggleView() {
    listView.view = !listView.view
}
export var mySighting = {
    marker: 1
}

export function toggleMySighting(value) {
    //_.parseInt
    var parseValue = _.parseInt(value)
    return mySighting.marker = parseValue

}

export function setResults(result) {
    var filterResult;
    return new Promise((resolve, reject) => {
            var sortNearest = _.sortBy(result, [function (o) {
                return userLocation.latitude && userLocation.longitude && nearest.marker ? gps_distance(userLocation.latitude, userLocation.longitude, o.latitude, o.longitude) : o
            }]);
    filterResult = _.filter(sortNearest, ['published', mySighting.marker])
    resolve(getResults.all = filterResult);
})
}
export function setSigthingResults(result) {
    return new Promise((resolve, reject) => {
            var sortNearest = _.sortBy(result, [function (o) {
                return userLocation.latitude && userLocation.longitude && nearest.marker ? gps_distance(userLocation.latitude, userLocation.longitude, o.latitude, o.longitude) : o
            }]);

    resolve(getResults.all = sortNearest);
})
}
export function setSimilar(color){
    return new Promise(  function(resolve, reject) {
        resolve(getSimilar.color = color)
    } );
}
export var getSimilar = {
    color:[]
}
export var getSigthingResults = {
    all: null
}

export var isDisable = {
    state: false
}


export function changeDisable(change) {
    isDisable.state = change
}

export function cameraInfo(event) {
    if (event.type == 'change') {
        return new Promise((resolve, reject) => {
                resolve(capturePhoto = event);
    })
    } else {
        event.target.value = null
    }
}
export var capturePhoto = null
export var getResults = {
    all: []
}
export function cnvrtRGBClrToHex(rgbClr) {
    var rgbClr = rgbClr.split(',');
    var r = rgbClr[0];
    var g = rgbClr[1];
    var b = rgbClr[2];
    return (r << 16 | g << 8 | b).toString(16).toUpperCase()
}
export function hexColorDelta(hex1, hex2) {
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



export var networkDataReceived = false;
export function get() {
    /*var spreadsheetID = '1Y2UtYW0Wl4QSTW_TYJiYgFIgrltmixecV9en0WhuUSc';
     var worksheetID = 'od6';
     var url = 'https://spreadsheets.google.com/feeds/list/' + spreadsheetID + '/' + worksheetID + '/public/values?alt=json';*/
    var user = firebase.auth().currentUser;
    var url = `/api/repository/${user.uid}`;
    return axios.get(url)

}
export var allId = {
    distributions: [],
    categories: [],
    families: [],
    vegetations: []
}
export function fetchAll(distribution, category, family, vegetation){
    allId.distributions = distribution
    allId.categories = category
    allId.families = family
    allId.vegetations = vegetation
}

export function readData(){
    readAllData('sync-posts')
        .then(function (data) {
            if(data){
                for (var dt of data) {
                    fetch('/api/repository', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            firebase: dt.firebase,
                            id: dt.id,
                            photos: dt.photos,
                            latitude: dt.latitude,
                            colors: dt.colors.toString(),
                            longitude: dt.longitude,
                            altitude: dt.altitude,
                            title: dt.title,
                            repository_id: dt.repository_id,
                            description: dt.description
                        })
                    })
                        .then(function (res) {
                            return res.json()
                        })
                        .then(function(data){
                            console.log(data)
                            return writeData('posts', data)
                        })
                        .then(function(){
                            deleteItemFromData('sync-posts', dt.id);
                        })
                        .catch(function (err) {
                            console.log('Error while sending data', err);
                        });
                }
            }
        })
}
//

export var users = {
    chat: [],

}

export var list = {
    users:[]
}
export function removeUser(user){
    var userIndex = _.findIndex(list.users, ['id', user.id]);
    list.users.splice(userIndex, 1);
}
export function updateUser(user){
    var userIndex = _.findIndex(list.users, ['id', user.id]);
    list.users[userIndex] = user;
}
export function insertUser(user){
    list.users.push(user)
}
export function listUser(user){
    list.users = user
}

export var repositoryEdit = {
    edit: null
}
export var changeRepository = {
    view: 'edit'
}
export function editRepository(repository){
    changeRepository.view = ''
    repositoryEdit.edit = repository
}


export function updateRepository(repository, selected, uid){
    var updateRepository = {
        'image' : repository.image,
        'palletes' : repository.palletes,
        'title' : repository.title,
        'economicImportance' : repository.economicImportance,
        'description' : repository.description,
        'species' : repository.species,
        'commonName' : repository.commonName,
        'scientificName' : repository.scientificName,
        'latitude' : repository.latitude,
        'longitude' : repository.longitude,
        'altitude' : repository.altitude,
        'estimatedDensity' : repository.estimatedDensity,
        'family': selected.family,
        'category': selected.category,
        'distribution': selected.distribution,
        'vegetation': selected.vegetation
    }

    axios.put(`../api/repository/admin/update/${uid}`, updateRepository).then(function(response){

    })
}

export function addRepository(image, colors, location, repositoryInfo, selected){
    var user = firebase.auth().currentUser ;
    var url = `../api/repository/create/${user.uid}`;
    if (typeof url !== 'string') {
        throw new TypeError(`Expected a string, got ${typeof url}`);
    }
    return axios.post(url, {'image': image, 'colors': colors.toString(), 'location': location, 'repositoryInfo': repositoryInfo, 'selected': selected }).then(function(response){
        plantItem.all.push(response.data)
    })
}
export function usersChat(user){
    users.chat = user
}

export var chats = {
    users:[]
}
export function chatUserView(admin){
    chats.users = admin
}


export var user = {
    detail: null
}
export function storeUserDetail(user){
    return user.detail = user
}
export function getData() {
    return get()
        .then(function (response) {
            networkDataReceived = true
            plantItem.repositories = []
            plantItem.sighting = []
            var data = response.data
            var allRepositories = data
            plantItem.all = allRepositories
            getResults.all = allRepositories
            plantItem.count = allRepositories.length


            for(var i in data){
                if(data[i].published === 1){
                    plantItem.repositories.push(data[i])
                }else{
                    plantItem.sighting.push(data[i])
                }
            }


            return response
        })
}
export function editRepositories(plantInfo){
    var url = `/api/repository/${plantInfo.id}`;
    var user = firebase.auth().currentUser;
    if (typeof url !== 'string') {
        throw new TypeError(`Expected a string, got ${typeof url}`);
    }
    var edit = {
        action: 'edit',
        firebase: user.uid,
        title: plantInfo.title,
        description: plantInfo.description
    };
    return axios.put(url, edit).then(function (response) {
        var updateRepositories = response.data;
        if ('indexedDB' in window) {
            return updateItem('posts', plantInfo)
        }
    }).then(function(){
        getData()
    }).catch(function (error) {
        if ('indexedDB' in window) {
            updateItem('posts', plantInfo )
            writeData('sync-posts', plantInfo)
        }

    });





/*
    return axios.put(url, edit)
            .then(function (response) {
                console.log('update')

            })*/

}


export function toObject(arr) {
    var rv = {};
    for (var i = 0; i < arr.length; ++i)
        if (arr[i] !== undefined) rv[i] = arr[i];
    return rv;
}
export var storeData = {
    post: null
}
export function storePost(post){
    storeData.post = post
}
export function FormDataPost(file, payload, latitude, longitude, altitude, title, description, similarPlant) {
    var url = '/api/repository';
    var user = firebase.auth().currentUser ;
    if (typeof url !== 'string') {
        throw new TypeError(`Expected a string, got ${typeof url}`);
    }

// You can add checks to ensure the url is valid, if you wish

        const formData = new FormData();

        formData.append('firebase', user.uid);
        formData.append('photos', file);
        formData.append('latitude', latitude);
        formData.append('colors', payload);
        formData.append('longitude', longitude);
        formData.append('altitude', _.isNull(altitude) ? 0 : altitude);
        formData.append('title', title);
        formData.append('repository_id', similarPlant);
        formData.append('description', description);
        formData.append('published', 0);
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        };

        return axios.post(url, formData, config)
            .then(function (response) {

                writeData('posts', response.data).then(function () {
                    readAllData('posts')
                        .then(function (data) {

                            var allRepositories = data
                            plantItem.all = allRepositories
                            getResults.all = allRepositories
                            plantItem.count = allRepositories.length
                        });
                })
                //getData()

               // Stack.page.pop();

                return response.data
            })

            .catch(function (error) {
                var post = {
                    action: 'post',
                    firebase: user.uid,
                    id: new Date().toISOString(),
                    photos: file,
                    latitude: latitude,
                    color: {'colors': payload.toString()},
                    longitude: longitude,
                    altitude: _.isNull(altitude) ? 0 : altitude,
                    title: title,
                    repository_id: similarPlant,
                    description: description
                };
                if(error){
                    writeData('posts', post)
                    writeData('sync-posts', post).then(function () {
                        if ('indexedDB' in window) {
                            readAllData('posts')
                                .then(function (data) {
                                    var allRepositories = data
                                    plantItem.all = allRepositories
                                    getResults.all = allRepositories
                                    plantItem.count = allRepositories.length
                                });
                        }
                    })
                }
            });
    };
if ('indexedDB' in window) {
    readAllData('posts')
        .then(function(data) {
            if (!networkDataReceived) {
                console.log('indexed')
                var allRepositories = data
                plantItem.all = allRepositories
                getResults.all = allRepositories
                plantItem.count = allRepositories.length
            }
        });
    readAllData('timeline')
        .then(function(data) {
                timeline.get = data
            });
}
export var timeline = {
    get:[],
    length: 0
}
export function writeTimeline(data) {
    timeline.get.push(data)
    timeline.length = data.id + 1
}
export var all = {
    repositories: []
}

export function IDGenerator() {

    this.length = 8;
    this.timestamp = +new Date;

    var _getRandomInt = function (min, max) {
        return Math.floor(Math.random() * ( max - min + 1 )) + min;
    }

    this.generate = function () {
        var ts = this.timestamp.toString();
        var parts = ts.split("").reverse();
        var id = "";

        for (var i = 0; i < this.length; ++i) {
            var index = _getRandomInt(0, parts.length - 1);
            id += parts[index];
        }

        return id;
    }


}
export var plantItem = {
    all: [],
    repositories:[],
    sighting: [],
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
        <div class="logo-area">
          <div class="icon-container">
            <div class="icon">
              <div class="shadow-point top one triangle"></div>
              <div class="shadow-point top two triangle"></div>
              <div class="shadow-point bottom one triangle"></div>
              <div class="shadow-point bottom two triangle"></div>
              <div class="shadow-point left one triangle"></div>
              <div class="shadow-point left two triangle"></div>
              <div class="shadow-point right one triangle"></div>
              <div class="shadow-point right two triangle"></div>
              <div class="outer-rim"></div>
              <div class="first-shadow"></div>
              <div class="inner-rim"></div>
              <div class="inner-circle"></div>
              <div class="big-point top one triangle"></div>
              <div class="big-point top two triangle"></div>
              <div class="big-point bottom one triangle"></div>
              <div class="big-point bottom two triangle"></div>
              <div class="big-point left one triangle"></div>
              <div class="big-point left two triangle"></div>
              <div class="big-point right one triangle"></div>
              <div class="big-point right two triangle"></div>
              <div class="small-point top-left one triangle"></div>
              <div class="small-point top-left two triangle"></div>
              <div class="small-point top-right one triangle"></div>
              <div class="small-point top-right two triangle"></div>
              <div class="small-point bottom-left one triangle"></div>
              <div class="small-point bottom-left two triangle"></div>
              <div class="small-point bottom-right one triangle"></div>
              <div class="small-point bottom-right two triangle"></div>
              
              <div class="second-shadow"></div>
        
              <!-- spinner -->
              <div class="spinner">
                <div class="arrow triangle one"></div>
                <div class="arrow triangle two"></div>
                <div class="arrow triangle three"></div>
                <div class="arrow triangle four"></div>
              </div>
        
        
              <div class="middle-circle"></div>
            </div>
          </div>
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

export const PlantNavigator = () =>({
    component: new Promise((resolve, reject) => {
        setTimeout(() => {
    require(['./../View/PlantNavigator.vue'], resolve)
}, 2000)
}),
loading: LoadingComponent,
    error
:
ErrorComponent,
    delay
:
1
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


export var onHold = {
    handler: false
}
export function onHoldFalse(){
    onHold.handler = false
}
export function onHoldHandler(){
    onHold.handler === true ? onHold.handler = false : onHold.handler = true
}

export function deletePlants(plants) {
    var user = firebase.auth().currentUser;
    for (var i = 0; i < plants.length; i++) {
        deleteItemFromData('posts', plants[i])
            .then(function(data) {
                axios.post(`/api/repository/${data}/${user.uid}`).then(function () {
                    i == plants.length ? getData() : null
                }).catch(function (err) {
                    var deleteData = {
                        action: 'delete',
                        firebase: user.uid,
                        user: data,
                        id: new Date().toISOString()
                    }
                    writeData('sync-posts', deleteData)
                })
            });
    }

}

export var navigationMap = {
    stack: ['view-map']
}

export function mapNavigation(){
    navigationMap.stack.push('capture-photo')
}