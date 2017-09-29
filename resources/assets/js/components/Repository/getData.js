/**
 * Created by Lorilla on 30/09/2017.
 */
export function get() {
    var spreadsheetID = '1ctHA5UmH9ZmrXugYFe_DHBOr9wJHRYkHCHim8nh1Tg8';
    var worksheetID = 'od6';
    var url = 'https://spreadsheets.google.com/feeds/list/'+spreadsheetID+'/'+worksheetID+'/public/values?alt=json';
    return axios({
        method: 'GET',
        url: url 
    })
}