export var tileSet = {
    all: [
        {
            name: 'Streets ',
            tileLayer: 'https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}'
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