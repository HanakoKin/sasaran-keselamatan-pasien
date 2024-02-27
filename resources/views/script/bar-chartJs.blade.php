<script>
    var currentYear = new Date().getFullYear();

    const Utils = {
        months: ({
            count
        }) => {
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                'September', 'October', 'November', 'December'
            ];
            return months.slice(0, count);
        },
    };

    const labels = Utils.months({
        count: 12
    });

    const getColorByIndex = (index) => {
        const colors = {
            0: 'rgba(255, 160, 180, 0.5)',
            1: 'rgba(154, 208, 245, 0.5)',
            2: 'rgba(165, 221, 155, 0.5)',
            3: 'rgba(246, 241, 147, 0.5)',
            // Add more colors if needed
        };

        return colors[index % Object.keys(colors).length];
    };

    const data = {
        labels: labels,
        datasets: [{
                label: "KNC",
                backgroundColor: getColorByIndex(0),
                borderColor: '#FF9BB0',
                data: [],
                stack: 'Stack 0',
            },
            {
                label: "KTC",
                backgroundColor: getColorByIndex(1),
                borderColor: '#6BBBF0',
                data: [],
                stack: 'Stack 0',
            },
            {
                label: "KTD",
                backgroundColor: getColorByIndex(2),
                borderColor: '#99BC85',
                data: [],
                stack: 'Stack 0',
            },
            {
                label: "KPC",
                backgroundColor: getColorByIndex(3),
                borderColor: '#FFCF81',
                data: [],
                stack: 'Stack 0',
            },
            {
                label: "My Second dataset",
                backgroundColor: "rgba(172, 135, 197, 0.5)",
                borderColor: "#756AB6",
                data: [4, 1, 6, 10, 2, 7, 5, 8, 3, 3, 5, 8],
                stack: 'Stack 0',
            }
        ]
    };

    var config = {
        type: 'bar',
        data: data,
        options: {
            indexAxis: 'x',
            responsive: true,
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                },
            },
            borderRadius: 3,
            borderWidth: 2,
        },
    };

    // Membuat chart
    const ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, config);

    const updateChart = (year) => {
        // Memperbarui tahun dan mengambil data baru
        fetch(`/chart-data/${year}`)
            .then(response => response.json())
            .then(newData => {

                console.log(newData + ' ' + year)

                // Mengambil data KNC, KTC, KTD, dan KPC dari response
                const KNC = newData.dataKNC;
                const KTC = newData.dataKTC;
                const KTD = newData.dataKTD;
                const KPC = newData.dataKPC;

                const jumlahKNC = KNC.map((item) => item.data.length);
                const jumlahKTC = KTC.map((item) => item.data.length);
                const jumlahKTD = KTD.map((item) => item.data.length);
                const jumlahKPC = KPC.map((item) => item.data.length);

                // Memperbarui data chart
                myChart.data.datasets[0].data = KNC.map((item) => item.data.length);
                myChart.data.datasets[1].data = KTC.map((item) => item.data.length);
                myChart.data.datasets[2].data = KTD.map((item) => item.data.length);
                myChart.data.datasets[3].data = KPC.map((item) => item.data.length);

                myChart.update();

            });
    };

    updateChart(currentYear);

    document.getElementById('prevYearBtn').addEventListener('click', function () {
        currentYear = currentYear - 1
        updateChart(currentYear);
    });

    // Menangkap klik pada tombol Tahun Sesudahnya
    document.getElementById('nextYearBtn').addEventListener('click', function () {
        currentYear = currentYear + 1
        updateChart(currentYear);

    });

    /* SWITCH */
    document.addEventListener('DOMContentLoaded', function () {
        var barSwitch = document.getElementById('barSwitch');

        // Tambahkan event listener untuk menanggapi perubahan status tombol
        barSwitch.addEventListener('click', function () {
            // Periksa apakah tombol dalam keadaan aktif atau tidak
            var isActive = barSwitch.classList.contains('active');

            // Tentukan indexAxis berdasarkan status tombol
            var indexAxis = isActive ? 'x' : 'y';

            // Update chart configuration
            var config = {
                type: 'bar',
                data: data,
                options: {
                    indexAxis: indexAxis,
                    responsive: true,
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                        },
                    },
                    borderRadius: 3,
                    borderWidth: 2,
                },
            };

            // Update chart configuration
            myChart.destroy(); // Destroy the current chart instance
            myChart = new Chart(ctx, config); // Create a new chart instance with updated configuration
            updateChart(currentYear); // Update the chart with the current data

        });
    });

</script>
