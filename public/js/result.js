// const { result } = require("lodash");

// googleMapsAPIを持ってくるときに,callback=initMapと記述しているため、initMap関数を作成
function initMap() {
    // welcome.blade.phpで描画領域を設定するときに、id=mapとしたため、その領域を取得し、mapに格納します。
    map = document.getElementById("map");
    // 東京タワーの緯度は35.6585769,経度は139.7454506と事前に調べておいたlat: 35.6895, lng: 139.6917
    let tokyoTower = {lat: 35.6585769, lng: 139.7454506};
        // オプションを設定
    opt = {
            zoom: 13, //地図の縮尺を指定
            center: tokyoTower, //センターを東京タワーに指定
    };
    mapObj = new google.maps.Map(map, opt);

    const request = {
        query: "ボードゲーム",
        fields: ["name", "geometry"]
    };

    // 地図のインスタンスを作成します。第一引数にはマップを描画する領域、第二引数にはオプションを指定
    const service = new google.maps.places.PlaceService(map);
    service.findPlaceFormQuery(request, (results, status) => {
        if(status === google.maps.places.PlaceServiceStatus.OK && results){
            for(let i = 0; i < results.length; i++){
                createMaker(results[i]);
            }
            map.setCenter(results[0].geometry.location);
        }
    });

    function createMaker(place){
        if(!place.geometry || !place.geometry.location) return;
        new google.maps.Marker({
            position: place.geometry.location,
            map,
            title: place.name,
        });
    }
}