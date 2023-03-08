<?php
include("connection.php");
include("header.php");
$bad_gas = "bad_gas_station";
$sql = "SELECT * FROM `bad_gas_station`";
$result = mysqli_query($connect, $sql);
$address = [];
while ($row = mysqli_fetch_array($result)) {
    $coords[] = $row['Coordinates'];
    array_push($address, $row['Address']);
    $violations[] = explode('  ', $row['Violations']);
    $names[] = $row['ShortName'];
    $ids[] = $row['ID'];
}

$good_gas = "good_gas_station";
$sql1 = "SELECT * FROM `".$good_gas."`";
$result1 = mysqli_query($connect, $sql1);
$address1 = [];
while ($row1 = mysqli_fetch_array($result1)) {
    $coords1[] = $row1['Coordinates'];
    array_push($address1, $row1['Address']);
    $names1[] = $row1['ShortName'];
    $ids1[] = $row1['ID'];
}
?>
<script type="text/javascript">

    ymaps.ready(init);

    function init() {
        // Создание карты.
        var geolocation = ymaps.geolocation,

            coords1 = [geolocation.latitude, geolocation.longitude],
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
        var violations = <?= json_encode($violations) ?>;

        var coords1 = <?= json_encode($coords1) ?>;
        var address1 = <?= json_encode($address1) ?>;
        var names1 = <?= json_encode($names1) ?>;

        var pointsL = [];
        var pointsL1 = [];
        coords.forEach(addDot);
        coords1.forEach(addDot1);

        function addDot(item) {
            let newitem = item.split(',');
            var numarray = [];
            let length = newitem.length;
            for (var i = 0; i < length; i++) {
                numarray.push(parseFloat(newitem[i]));
            }
            pointsL.push(numarray);
        }

        function addDot1(item) {
            let newitem1 = item.split(',');
            var numarray1 = [];
            let length1 = newitem1.length;
            for (var i = 0; i < length1; i++) {
                numarray1.push(parseFloat(newitem1[i]));
            }
            pointsL1.push(numarray1);
        }

        clusterer = new ymaps.Clusterer({
            clusterIconLayout: 'default#pieChart',
            groupByCoordinates: false,
            clusterDisableClickZoom: true
        });

        getPointData = function (index, length) {
            document.cookie = "index = " + index;
            return {
                balloonContentBody: names[index] + '<br><label>Address :</label>' + address[index] + '<br>' + violations[index],
                clusterCaption: names[index]
            };
        };

        getPointData1 = function (index, length) {
            document.cookie = "index = " + index;
            return {
                balloonContentBody: names1[index] + '<br><label>Address :</label>' + address1[index],
                clusterCaption: names1[index]
            };
        };
        points = pointsL,
            points1 = pointsL1,
            geoObjects = [];
        for (var i = 0, len = pointsL.length; i < len; i++) {
            geoObjects[i] = new ymaps.Placemark(pointsL[i], getPointData(i, pointsL.length), {
                preset: 'islands#redDotIcon'
            });
        }

        geoObjects1 = [];
        for (var i = 0, len = pointsL1.length; i < len; i++) {
            geoObjects1[i] = new ymaps.Placemark(pointsL1[i], getPointData1(i, pointsL.length), {
                preset: 'islands#greenDotIcon'
            });
        }

        /*var control = myMap.controls.get('routeButtonControl');
        control.routePanel.geolocate('from');
        control.state.set('expanded', true);*/

        clusterer.add(geoObjects);
        clusterer.add(geoObjects1);
        myMap.geoObjects.add(clusterer);
    }
</script>
