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