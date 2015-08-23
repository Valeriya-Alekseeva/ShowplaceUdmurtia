(function(global,$){
    var mapContainer = $("#global-map");

    $(document).ready(function(){
        ymaps.ready(init);
    });

    function init(){
        var mapUdm = new ymaps.Map('global-map', {
            center: [56.847961,53.203801],
            zoom: 8,
            controls: ['zoomControl']
        },{
            minZoom: 8,
            maxZoom: 11,
            restrictMapArea: true
        }),
            centerCoord = mapUdm.getCenter();

        var centerPlacemark = new ymaps.Placemark(centerCoord);

        var imgUrlTemplate = 'img/map_tiles/%z/tile-%x-%y.png',
            imgLayer = new ymaps.Layer(imgUrlTemplate, {tileTransparent: true});

        mapUdm.layers.add(imgLayer);
        mapUdm.geoObjects.add(centerPlacemark);
    }


}(window,window.jQuery));