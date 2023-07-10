<!DOCTYPE html>
<html>
<head>
    <title>Chart Example</title>
    <!-- Include Bootstrap and jQuery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <style>
        .chart-container {
            width: 400px;
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="vulnerabilityChart"></canvas>
                </div>
            </div> -->
            <div class="col-md-12">
                <h2>Vulnerability</h2>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="vulnerabilityTypeChart"></canvas>
                </div>
            </div>
            <div class="col-md-12">
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="geolocationChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="threatenedSystemChart"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="digitalUserRiskChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#Vulnerability').DataTable();
            var jsonData = <?= $jsonData ?>;

            // // Chart 1: Vulnerable to attacks (Bar Chart)
            // var vulnerableData = {
            //     labels: ['Low', 'Medium', 'High', 'Critical'],
            //     datasets: [{
            //         labels: ['Vulnerable'],
            //         data: [
            //             jsonData.report_detail.Low_vuln,
            //             jsonData.report_detail.Medium_vuln,
            //             jsonData.report_detail.High_vuln,
            //             jsonData.report_detail.Critical_vuln
            //         ],
            //         backgroundColor: [
            //             'rgba(255, 99, 132, 0.5)',
            //             'rgba(54, 162, 235, 0.5)',
            //             'rgba(255, 206, 86, 0.5)',
            //             'rgba(75, 192, 192, 0.5)'
            //         ],
            //         borderColor: [
            //             'rgba(255, 99, 132, 1)',
            //             'rgba(54, 162, 235, 1)',
            //             'rgba(255, 206, 86, 1)',
            //             'rgba(75, 192, 192, 1)'
            //         ],
            //         borderWidth: 1
            //     }]
            // };
            // var vulnerableCtx = document.getElementById('vulnerabilityChart').getContext('2d');
            // new Chart(vulnerableCtx, {
            //     type: 'bar',
            //     data: vulnerableData,
            //     options: {
            //         scales: {
            //             y: {
            //                 beginAtZero: true
            //             }
            //         }
            //     }
            // });

            // Chart 2: Type of vulnerability (Doughnut Chart)
            var vulnerabilityTypeData = {
                labels: ['Low', 'Medium', 'High', 'Critical'],
                datasets: [{
                    label: 'Type of Vulnerability',
                    data: [
                        jsonData.report_detail.Low_vuln,
                        jsonData.report_detail.Medium_vuln,
                        jsonData.report_detail.High_vuln,
                        jsonData.report_detail.Critical_vuln
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            };
            var vulnerabilityTypeCtx = document.getElementById('vulnerabilityTypeChart').getContext('2d');
            new Chart(vulnerabilityTypeCtx, {
                type: 'doughnut',
                data: vulnerabilityTypeData
            });

            // Chart 3: Geolocation of the potential attacks (Bar Chart)
            var geolocationData = {
                labels: [jsonData.report_detail.Vulnerability[0].threat_geolocation],
                datasets: [{
                    label: 'Geolocation of Potential Attacks',
                    data: [1],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            };
            var geolocationCtx = document.getElementById('geolocationChart').getContext('2d');
            new Chart(geolocationCtx, {
                type: 'bar',
                data: geolocationData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Chart 4: Threatened system (Pie Chart)
            var threatenedSystemData = {
                labels: ['System Defense', 'Vulnerability Threat'],
                datasets: [{
                    label: 'Threatened System',
                    data: [1, 1],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            };
            var threatenedSystemCtx = document.getElementById('threatenedSystemChart').getContext('2d');
            new Chart(threatenedSystemCtx, {
                type: 'bar',
                data: threatenedSystemData
            });

            // Chart 5: Digital user risk (Bar Chart)
            var digitalUserRiskData = {
                labels: ['Low', 'Medium', 'High'],
                datasets: [{
                    label: 'Digital User Risk',
                    data: [
                        jsonData.Digital_User_Risk[0].email_at_risk_low.length,
                        jsonData.Digital_User_Risk[0].email_at_risk_medium.length,
                        jsonData.Digital_User_Risk[0].email_at_risk_high.length
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            };
            var digitalUserRiskCtx = document.getElementById('digitalUserRiskChart').getContext('2d');
            new Chart(digitalUserRiskCtx, {
                type: 'pie',
                data: digitalUserRiskData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>