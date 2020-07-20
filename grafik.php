<html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            //umur
            // var data = google.visualization.arrayToDataTable([
            //     ['Year', 'Dewasa', 'Paruh Baya', 'Tua'],
            //     ['0', 1, 0, 0],
            //     ['30', 1, 0, 0],
            //     ['50', 0, 1, 0],
            //     ['70', 0, 0, 1],
            //     ['100', 0, 0, 1]
            // ]);


            // Berat Badan
            // var data = google.visualization.arrayToDataTable([
            //     ['Kg', 'Ringan', 'Sedang', 'Berat'],
            //     ['0', 1, 0, 0],
            //     ['30', 1, 0, 0],
            //     ['55', 0, 1, 0],
            //     ['80', 0, 0, 1],
            //     ['100', 0, 0, 1]
            // ]);

            // Tinggi Badan
            // var data = google.visualization.arrayToDataTable([
            //     ['cm', 'Rendah', 'Sedang', 'Tinggi'],
            //     ['120', 1, 0, 0],
            //     ['140', 1, 0, 0],
            //     ['160', 0, 1, 0],
            //     ['180', 0, 0, 1],
            //     ['200', 0, 0, 1]
            // ]);

            // Stadium
            // var data = google.visualization.arrayToDataTable([
            //     ['cm', 'Tidak Ganas', 'Sedang', 'Ganas'],
            //     ['1', 1, 0, 0],
            //     ['2', 0, 1, 0],
            //     ['3', 0, 1, 0],
            //     ['4', 0, 0, 1]
            // ]);

            // Status Gizi
            var data = google.visualization.arrayToDataTable([
                ['cm', 'Buruk', 'Normal', 'Baik'],
                ['0', 1, 0, 0],
                ['10', 1, 0, 0],
                ['30', 0, 1, 0],
                ['50', 0, 0, 1],
                ['60', 0, 0, 1]
            ]);


            var options = {
                title: 'Fungsi Keanggotaan Status Gizi',
                legend: {
                    position: 'bottom'
                },
                width: 1200,
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
</body>

</html>