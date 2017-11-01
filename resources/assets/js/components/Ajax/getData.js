/**
 * Created by Lorilla on 30/09/2017.
 */

export var currentPage = {
    url: 'plant-navigator',
    name: 'Repositories of Plants'
}
export function currentPageSwitcher(url, name){
    new Promise((resolve, reject) => {
        resolve(
            currentPage.url = url,
            currentPage.name = name
        );
    })

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

export function PlantIndex(id){
        var plant = _.findIndex(plantItem.all, {id: id});
       PlantFound.index = plantItem.all[plant];
}
export const PlantFound = {
    index: null
}
export function PushItem(page) {
    StackItem.page.push(page)
}

export function setResults (result) {
    return new Promise((resolve, reject) => {
        getResults.all = result
        resolve();
    })

}

export var getResults = {
    all: null
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

export function getData(){
    var url = '/api/repository'
    return axios({
        method: 'GET',
        url: url
    }).then(function (response) {
        
        var data =  response.data
        plantItem.all = data
        getResults.all = data
        plantItem.count = data.length
    })
}

export var plantItem = {
    all: null,
    count: null
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

export var userLocation ={
    lat: null,
    lng: null
}

export function getUserLocation(position){
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




export var PlantInfo = null

export function PlantItem(plantInfo) {
    PlantInfo = plantInfo
}