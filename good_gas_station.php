<?php
include("connection.php");
include("header.php");
$result = mysqli_query($connect, "SELECT * FROM `good_gas_station`");
$address = [];
while ($row = mysqli_fetch_array($result)) {
    $coords[] = $row['Coordinates'];
    array_push($address, $row['Address']);
    $names[] = $row['ShortName'];
    $ids[] = $row['ID'];
}
?>
<script type="text/javascript">

    ymaps.ready(init);

    function init() {
        // Создание карты.
        var geolocation = ymaps.geolocation,
            coords = [geolocation.latitude, geolocation.longitude]
        var myMap = new ymaps.Map("map", {
            center: [37.664653, 55.818837],
            controls: ['zoomControl', 'searchControl', 'typeSelector', 'fullscreenControl', 'routeButtonControl'],
            zoom: 12
        }, {
            searchControlProvider: 'yandex#search'
        });

        // координаты
        geolocation.get({
            provider: 'browser',
            mapStateAutoApply: true
        }).then(function (result) {
           result.geoObjects.options.set('preset', 'islands#blueCircleIcon');
            myMap.geoObjects.add(result.geoObjects);
        });

        var coords = <?= json_encode($coords) ?>;
        var address = <?= json_encode($address) ?>;
        var names = <?= json_encode($names) ?>;

        var pointsL = [];
        coords.forEach(addDot);

        function addDot(item) {
            let newitem = item.split(',');
            var numarray = [];
            let length = newitem.length;
            for (var i = 0; i < length; i++) {
                numarray.push(parseFloat(newitem[i]));
            }
            pointsL.push(numarray);
        }

        clusterer = new ymaps.Clusterer({
            clusterIconLayout: 'default#pieChart',
            groupByCoordinates: false,
            clusterDisableClickZoom: true
        });

        getPointData = function (index, length) {
            document.cookie = "index = " + index;
            return {
                balloonContentBody: names[index] + '<br><label>Address :</label>' + address[index],
                clusterCaption: names[index]
            };
        };


        points = pointsL,

            geoObjects = [];
        for (var i = 0, len = pointsL.length; i < len; i++) {
            geoObjects[i] = new ymaps.Placemark(pointsL[i], getPointData(i, pointsL.length), {
                preset: 'islands#greenDotIcon'
            });
        }

        /*var control = myMap.controls.get('routeButtonControl');
        control.routePanel.geolocate('from');
        control.state.set('expanded', true);*/

        clusterer.add(geoObjects);

        myMap.geoObjects.add(clusterer);
    }
</script>
