{{-- <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chart</title>
        <script src="{{ asset('js/Chart.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <!DOCTYPE html>
    <html lang="en">
    <div class="container">
        <div class="content">
            <div id="loading-panel">
                Loading . . .
            </div>
            <select id="tahunDropdown" class="dropdown-blue" onchange="ubahTahun()">
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
            </select>
            <div class="data-display" id="targetDataDisplay"></div>
            <div class="data-display" id="aktualDataDisplay"></div>
            <div class="charts-container">
                <div class="outer-border">
                    <canvas id="chartData" width="100" height="65"></canvas>
                </div>
                <div class="outer-border">
                    <canvas id="pieChartData" width="100" height="335"></canvas>
                </div>
            </div>
            <br>
        </div>

        <script>
            var ctx = document.getElementById('chartData').getContext('2d');
            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                'November', 'Desember'
            ]; // variabel bulan
            var labels = months;
            var targetData = [200_000, 100_000, 240_000, 289_000]; // data target
            var aktualData = []; // variabel data sebenarnya
            var year = 2021; // menentukan tahun

            // inisiasi chart data
            var chartData = new Chart(ctx, {
                type: 'line', // inisiasi tipe chart
                data: {
                    labels, // mengambil data dari variabel labels
                    datasets: [{
                        name: 'target',
                        label: 'Target',
                        data: targetData,
                        backgroundColor: 'rgba(75, 192, 192, 0.12)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }, {
                        name: 'aktual',
                        label: 'Aktual',
                        data: aktualData,
                        backgroundColor: 'rgba(77, 78, 255, 0.12)',
                        borderColor: 'rgba(77, 78, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            function setAktualData() {
                fetch('/api/v1/cashflows') // Mengambi data dari API
                    .then(x => {
                        document.getElementById("loading-panel").style.display = 'block'; // Menampilkan loading
                        return x.json();
                    }) // Mengubah data menjadi JSON (JavaScript Object)
                    .then(y => {
                        let _temp = []; // Variabel sementara

                        y.filter(e => {
                            return new Date(e.created_at).getFullYear() == year; // Filter berdasarkan tahun 2021
                        }).forEach(e => {
                            let n = new Date(e.created_at).getMonth(); // variabel n sebagai index nomor bulan
                            if (isNaN(_temp[n]))
                                _temp[n] = 0;
                            if (e.type) // Kredit
                                _temp[n] += e.amount;
                            else // Debet
                                _temp[n] -= e.amount;
                        });
                        // Ambil data target dan data aktual terakhir
                        const latestData = _temp[_temp.length - 1];
                        const latestTarget = targetData[targetData.length - 1];

                        // Mengubah angka menjadi format mata uang Rupiah
                        const formatter = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        });

                        // Mengubah angka menjadi format mata uang Rupiah
                        const formattedLatestData = formatter.format(latestData);
                        const formattedLatestTarget = formatter.format(latestTarget);

                        // Update chart data
                        aktualData = [latestData];
                        targetData = [latestTarget];

                        aktualData = _temp; // Memasukkan value variabel sementara ke variabel aktualData

                        chartData.data.datasets[chartData.data.datasets.findIndex((e) => {
                            return (e.name === 'aktual')
                        })].data = aktualData; // memasukkan aktualData ke dalam chart

                        chartData.update(); // memperbarui chart
                        document.getElementById("loading-panel").style.display = 'none'; // menyembunyikan loading
                        // Menampilkan data aktual dan data target di atas chart
                        document.getElementById("targetDataDisplay").innerText = "Target Revenue: " +
                            formattedLatestTarget;
                        document.getElementById("aktualDataDisplay").innerText = "Actual Revenue: " +
                            formattedLatestData;
                    });
            }

            function ubahTahun() {
                year = parseInt(document.getElementById('tahunDropdown').value);
                setAktualData();
            }

            var pieCtx = document.getElementById('pieChartData').getContext('2d');
            var pieData = [30, 40]; // Data pie chart
            var pieLabels = ['Label 1', 'Label 2']; // Label pie chart
            var pieColors = ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)'];

            var pieChart = new Chart(pieCtx, {
                type: 'pie', // Jenis chart pie
                data: {
                    labels: pieLabels,
                    datasets: [{
                        data: pieData,
                        backgroundColor: pieColors
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            function setPieChartData() {
                fetch('/api/v1/pieChartData') // ('/api/v1/cashflows')
                    .then(response => response.json())
                    .then(data => {
                        // Mengupdate data chart pie dengan data aktual dari API
                        pieChart.data.datasets[0].data = data; // Menggunakan data yang diperoleh dari API
                        pieChart.update(); // Memperbarui chart pie
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            // function exportChartToPDF() {
            //     html2canvas(document.getElementById('chartData'), {
            //         scale: 2 // Menambahkan faktor skala untuk meningkatkan kualitas gambar
            //     }).then(canvas => {
            //         // Mendapatkan data URL dari elemen canvas
            //         var imageDataUrl = ctx.toDataURL();

            //         // Membuat objek PDF
            //         var doc = new jsPDF();

            //         // Menambahkan gambar dari data URL ke PDF
            //         doc.addImage(imageDataUrl, 'PNG', 10, 10, 190, 100); // Atur ukuran dan posisi gambar

            //         // Menyimpan file PDF
            //         doc.save('chart.pdf');


            //         document.getElementById('download-pdf-button').addEventListener('click', function() {});
            //     });
            // }
            setPieChartData();
            setAktualData();
            // exportChartToPDF(); // Mengekspor chart ke PDF
        </script>
        </body>

        <style>
            #chartData,
            #pieChartData {
                max-width: 100%;
            }

            .charts-container {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }

            .outer-border {
                width: 50%;
                height: 70%;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #f0f0f0;
                border: 2px solid #adb2b6;
                border-radius: 20px;
                box-sizing: border-box;
                box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.20);
                margin-top: 20px;

            }

            .data-display {
                display: inline-block;
                margin-left: 20px;
                border: 1px solid #ccc;
                padding: 10px;
                color: #007bff;
                font-size: 12px;
                border-radius: 5px;
            }

            .dropdown-blue {
                color: #007bff;
            }

            .outer-border:first-child {
                margin-right: 10px;
            }

            .outer-border:last-child {
                margin-left: 10px;
            }
        </style>

    </html>

    </body> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-apexcharts"></script>
</head>

<body>
    <div class="container">
        <div class="p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="dropdown-container">
                <label for="year">Pilih Tahun:</label>
                <select id="year">
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
            </div>
            <br>
            <div id="chart"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'line',
                    height: 350,
                    width: '100%',
                    stacked: false,
                },
                dataLabels: {
                    enabled: false
                },
                series: [],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            if (value === 0) {
                                return '';
                            }
                            return value;
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

            var yearsData = {
                '2021': [10, 15, 8, 12, 7, 20, 14, 18, 25, 22, 16, 19],
                '2022': [12, 18, 15, 10, 26, 22, 16, 14, 20, 24, 19, 17],
                '2023': [15, 22, 18, 20, 14, 28, 24, 19, 17, 23, 27, 30],
            };

            var yearDropdown = document.getElementById("year");
            yearDropdown.addEventListener("change", function() {
                var selectedYear = yearDropdown.value;
                var selectedData = yearsData[selectedYear];
                chart.updateSeries([{
                    name: 'Aktual',
                    data: selectedData
                }, {
                    name: 'Target',
                    data: selectedData.map(value => value *
                        0.8)
                }]);
            });

            // Menetapkan tahun pertama sebagai nilai default
            var initialYear = yearDropdown.value;
            var initialData = yearsData[initialYear];
            chart.updateSeries([{
                name: 'Aktual',
                data: initialData
            }, {
                name: 'Target',
                data: initialData.map(value => value *
                    0.8) // Contoh data untuk series kedua (80% dari data pertama)
            }]);
        });
    </script>
</body>

<style>
    .container {
        width: 50%;
        float: left;
    }

</style>

</html>
