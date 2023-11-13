<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart with Year</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>
    <div class="container">
        <div class="p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="dropdown-container">
                <label for="tahunDropdown">Pilih Tahun:</label>
                <select id="tahunDropdown" onchange="ubahTahun()">
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
                {{-- <button onclick="exportCSV()">Export CSV</button>
                <button onclick="exportPNG()">Export PNG</button> --}}
            </div>
            <div id="pieChart"></div>
        </div>
    </div>

    <script>
        var tahun = 2021;
        var pieChartData = {
            chart: {
                type: 'pie',
                height: 350,
                width: '100%',
            },
            labels: ['Operational', 'Wages'],
            series: [],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var pieChart = new ApexCharts(document.querySelector("#pieChart"), pieChartData);
        pieChart.render();

        // Fungsi untuk mengubah tahun dan memperbarui data grafik pie
        function ubahTahun() {
            tahun = parseInt(document.getElementById('tahunDropdown').value);
            fetchDataAndRenderPieChart();
        }

        // Fungsi untuk mengambil data dari API sesuai tahun dan memperbarui grafik pie
        function fetchDataAndRenderPieChart() {
            // fetch('/api/v1/data?year=' + tahun)
            //   .then(response => response.json())
            //   .then(data => {
            //     // Memperbarui data grafik pie
            //     pieChartData.series = [data.operational, data.wages];
            //     // Memperbarui grafik pie
            //     pieChart.updateSeries(pieChartData.series);
            //   })
            //   .catch(error => {
            //     console.error('Error fetching data:', error);
            //   });

            var data = {
                2021: {
                    operational: 30000,
                    wages: 20000
                },
                2022: {
                    operational: 35000,
                    wages: 22000
                },
                2023: {
                    operational: 38000,
                    wages: 25000
                }
            };

            // Memperbarui data grafik pie berdasarkan tahun yang dipilih
            pieChartData.series = [data[tahun].operational, data[tahun].wages];

            // Memperbarui grafik pie
            pieChart.updateSeries(pieChartData.series);

            // Fungsi untuk mengexport data ke dalam format CSV
            function exportCSV() {
                var data = {
                    labels: ['Operational', 'Wages'],
                    series: pieChartData.series
                };

                var csvContent = "data:text/csv;charset=utf-8,";
                csvContent += data.labels.join(",") + "\n";
                csvContent += data.series.join(",");

                var encodedUri = encodeURI(csvContent);
                var link = document.createElement("a");
                link.setAttribute("href", encodedUri);
                link.setAttribute("download", "data.csv");
                document.body.appendChild(link);
                link.click();
            }

            // Fungsi untuk mengexport grafik ke dalam format PNG
            function exportPNG() {
                pieChart.dataURI().then(function(uri) {
                    var link = document.createElement('a');
                    link.href = uri;
                    link.download = 'chart.png';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                });
            }

        }

        // Memanggil fungsi fetchDataAndRenderPieChart() saat halaman dimuat
        fetchDataAndRenderPieChart();
    </script>
</body>

<style>
    .container {
        width: 50%;
        float: left;
    }
</style>

</html>
