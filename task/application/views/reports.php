<!DOCTYPE html>
<html>
<head>
    <title>Data View</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYEMCWEyzX_k5lQ-FmaQLr49-VeX3eny8&libraries=places"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-3 report-detail">
                <h2 class="mb-3">Report Detail</h2>
                <div class="card-main">
                    <div class="card-img">
                        <div class="card-inner-img">
                            <img src="<?= base_url() ?>assets/images/card-img.PNG"/>
                            <h5>CyberLab Inc</h5>
                        </div>
                    </div>
                    <div class="card-details">
                        <p><span>Id:</span> 01</p>
                        <p><span>Email:</span> info@cyberlabs.tech</p>
                        <p><span>Industry:</span> Government</p>
                        <p><span>Score:</span> 750</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <!-- Vulnerable to attacks - Bar Chart -->
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-3">Vulnerable to Attacks</h2>
                        <canvas id="vulnerableChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Type of vulnerability - Doughnut Chart -->
            <div class="col-md-12 pb-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Type of Vulnerability</h2>
                        <div class="col-md-12">
                            <table id="Vulnerability" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Severity</th>
                                        <th>Alert</th>
                                        <th>URI</th>
                                        <th>Description</th>
                                        <th>Solution</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $Vulnerability = $jsonData['report_detail']['Vulnerability'];
                                    foreach($Vulnerability as $vulner)
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $vulner['severity']; ?></td>
                                        <td><?php echo $vulner['alert']; ?></td>
                                        <td><a class="vulnerability-uri" target="_blank" href="<?php echo $vulner['uri']; ?>"><?php echo $vulner['uri']; ?></a></td>
                                        <td><?php echo $vulner['description']; ?></td>
                                        <td><?php echo $vulner['solution']; ?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Geolocation of Potential Attacks</h2>
                        <div id="mapChart"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 pt-5">
                <!-- Threatened system - Information -->
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Threatened System</h2>
                        <p><?php echo $jsonData['Threatened'][0]['system_defense']; ?></p>
                        <p><?php echo $jsonData['Threatened'][0]['system_defense_description']; ?></p>

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#vulnerability_threat" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Vulnerability</button>
                                <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#ip" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Malicious IP</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#subdomain" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Subdomain</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#ssl" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">SSL Certificate</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#tcp" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Open TCP port</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#co-hosts" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Co Shared Hosts</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#human-name" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Human Name</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#phone-number" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Phone Number</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="vulnerability_threat" role="tabpanel" aria-labelledby="nav-home-tab">
                                <?php
                                foreach($jsonData['Threatened'][0]['vulnerability_threat'] as $threat){
                                ?>
                                    <p><strong>Threat:</strong> <?php echo $threat['threat']; ?></p>
                                    <p><strong>Description:</strong> <?php echo $threat['threat_description']; ?></p>
                                    <p><strong>Threat Attack Complexity:</strong> <?php echo $threat['threat_attackcomplexity']; ?></p>
                                    <p><strong>Threat Confidentiality Impact:</strong> <?php echo $threat['threat_confidentialityimpact']; ?></p>
                                    <p><strong>Threat Geo location:</strong> <?php echo $threat['threat_geolocation']; ?></p>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="tab-pane fade show" id="ip" role="tabpanel" aria-labelledby="nav-home-tab">
                                <p><strong>Threat:</strong> <?php echo $jsonData['Threatened'][0]['Malicious_IP_Address_threat']['Malicious_IP_Address_threat']; ?></p>
                                <p><strong>Solution:</strong> <?php echo $jsonData['Threatened'][0]['Malicious_IP_Address_threat']['Malicious_IP_Address__solution']; ?></p>
                                <p><strong>List:</strong></p>
                                <ul>
                                <?php
                                    foreach($jsonData['Threatened'][0]['Malicious_IP_Address_threat']['Malicious_IP_Address'] as $ip){
                                        echo "<li>". $ip ."</li>";
                                    }
                                ?>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="subdomain" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <p><strong>Threat:</strong> <?php echo $jsonData['Threatened'][0]['subdomain_threat']['subdomain_threat']; ?></p>
                                <p><strong>Solution:</strong> <?php echo $jsonData['Threatened'][0]['subdomain_threat']['subdomain_solution']; ?></p>
                                <p><strong>List:</strong></p>
                                <ul>
                                <?php
                                    foreach($jsonData['Threatened'][0]['subdomain_threat']['subdomains'] as $ip){
                                        echo "<li class='list-subdomain'>". $ip ."</li>";
                                    }
                                ?>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="ssl" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <p><strong>Threat:</strong> <?php echo $jsonData['Threatened'][0]['SSL_Certificate_Expired']['SSL_Certificate_Expired_threat']; ?></p>
                                <p><strong>Solution:</strong> <?php echo $jsonData['Threatened'][0]['SSL_Certificate_Expired']['SSL_Certificate_Expired_solution']; ?></p>
                                <p><strong>List:</strong></p>
                                <ul>
                                <?php
                                    foreach($jsonData['Threatened'][0]['SSL_Certificate_Expired']['SSL_Certificate_Expired'] as $ip){
                                        echo "<li class='list-certificate'>". $ip ."</li>";
                                    }
                                ?>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="tcp" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <?php
                                    $counter = 1;
                                    foreach($jsonData['Threatened'][0]['Open_TCP_Port'] as $port){
                                ?>
                                        <p class="threat-port"><strong><?= $counter; ?>. Threat:</strong> <?php echo $port['Open_TCP_Port_threat']; ?></p>
                                        <p><strong>Solution:</strong> <?php echo $port['Open_TCP_Port_solution']; ?></p>
                                        <p><strong>List:</strong></p>
                                        <ul>
                                    <?php
                                            foreach($port['Open_TCP_Port'] as $prt){
                                                echo "<li class='list-port'>". $prt ."</li>";
                                            }
                                            $counter++;
                                    ?>
                                    </ul>
                                    <?php
                                    }
                                ?>
                                
                            </div>
                            <div class="tab-pane fade" id="co-hosts" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <p><strong>Threat:</strong> <?php echo $jsonData['Threatened'][0]['co_shared_hosts']['Co_Hosted_Site_threat']; ?></p>
                                <p><strong>Solution:</strong> <?php echo $jsonData['Threatened'][0]['co_shared_hosts']['Co_Hosted_Site_solution']; ?></p>
                                <p><strong>Co Hosted Site Source:</strong></p>
                                <?php
                                    foreach($jsonData['Threatened'][0]['co_shared_hosts']['Co_Hosted_Site_source'] as $ip){
                                        echo "<p class='list-hosted'>". $ip ."</p>";
                                    }
                                ?>
                                <p class="mt-4"><strong>Co Hosted Site List:</strong></p>
                                <ul>
                                <?php
                                    foreach($jsonData['Threatened'][0]['co_shared_hosts']['Co_Hosted_Site_List'] as $ip){
                                        echo "<li class='list-share-hosted'>". $ip ."</li>";
                                    }
                                ?>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="human-name" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <p><strong>Threat:</strong> <?php echo $jsonData['Threatened'][0]['human_name']['human_name_threat']; ?></p>
                                <p><strong>Solution:</strong> <?php echo $jsonData['Threatened'][0]['human_name']['human_name_solution']; ?></p>
                                <p><strong>List:</strong></p>
                                <ul>
                                <?php
                                    foreach($jsonData['Threatened'][0]['human_name']['human_name_list'] as $ip){
                                        echo "<li class='list-name'>". $ip ."</li>";
                                    }
                                ?>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="phone-number" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <p><strong>Threat:</strong> <?php echo $jsonData['Threatened'][0]['Phone_number']['phone_number_threat']; ?></p>
                                <p><strong>Solution:</strong> <?php echo $jsonData['Threatened'][0]['Phone_number']['phone_number_solution']; ?></p>
                                <p><strong>List:</strong></p>
                                <ul>
                                <?php
                                    foreach($jsonData['Threatened'][0]['Phone_number']['phone_number_list'] as $ip){
                                        echo "<li class='list-phone'>". $ip ."</li>";
                                    }
                                ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pb-5">
            <div class="col-md-12">
                <!-- Digital user risk - Pie Chart -->
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Digital User Risk</h2>
                        <p><strong>Mail Service:</strong> <?= $jsonData['Digital_User_Risk'][0]['mailservice'] ?></p>
                        <p><strong>Mail Service Description:</strong> <?= $jsonData['Digital_User_Risk'][0]['mailservice_description'] ?></p>
                        <div class="col-md-5 mx-auto">
                            <canvas id="userRiskChart"></canvas>
                        </div>

                        <p class="mt-4"><strong>Email Risks:</strong> <?= $jsonData['Digital_User_Risk'][0]['email_risks'] ?></p>
                        <p><strong>Email Risks Solution:</strong> <?= $jsonData['Digital_User_Risk'][0]['email_risks_solution'] ?></p>
                        <p><strong>Hacked Email address Solution:</strong> <?= $jsonData['Digital_User_Risk'][0]['hacked_email_address']['hacked_email_address_solution'] ?></p>
                        <p><strong>Hacked Email Address:</strong></p>
                        <ul>
                            <?php
                                foreach($jsonData['Digital_User_Risk'][0]['hacked_email_address']['hacked_email_address'] as $ip_new){
                                    echo "<li>". $ip_new ."</li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



    <script>
        // Vulnerable to attacks - Bar Chart
        $('#Vulnerability').DataTable();
        var vulnerableChart = new Chart(document.getElementById('vulnerableChart'), {
            type: 'bar',
            data: {
                labels: ['Low', 'Medium', 'High', 'Critical'],
                datasets: [{
                    label: 'Vulnerabilities',
                    data: [
                        <?php echo $jsonData['report_detail']['Low_vuln']; ?>,
                        <?php echo $jsonData['report_detail']['Medium_vuln']; ?>,
                        <?php echo $jsonData['report_detail']['High_vuln']; ?>,
                        <?php echo $jsonData['report_detail']['Critical_vuln']; ?>
                    ],
                    backgroundColor: 'rgba(23, 50, 79, 0.2)',
                    borderColor: 'rgba(23, 50, 79, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Type of vulnerability - Doughnut Chart
        var vulnerabilityChart = new Chart(document.getElementById('vulnerabilityChart'), {
            type: 'doughnut',
            data: {
                labels: ['<?php echo $jsonData['report_detail']['Vulnerability'][0]['severity']; ?>'],
                datasets: [{
                    data: [1],
                    backgroundColor: ['rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
        
        // Geolocation of the potential attacks - Map
        google.charts.load('current', {
            'packages': ['geochart'],
            'mapsApiKey': 'AIzaSyBYEMCWEyzX_k5lQ-FmaQLr49-VeX3eny8' // Replace with your Google Maps API key
        });
        google.charts.setOnLoadCallback(drawMapChart);

        function drawMapChart() {
        var data = google.visualization.arrayToDataTable([
            ['Country'],
            ['<?php echo $jsonData['Threatened'][0]['vulnerability_threat'][0]['threat_geolocation']; ?>'] // Replace 'EU' with the desired country short code
        ]);

        var options = {
            region: 'world',
            displayMode: 'regions',
            resolution: 'countries'
        };

        var chart = new google.visualization.GeoChart(document.getElementById('mapChart'));
            chart.draw(data, options);
        }

        // Digital user risk - Pie Chart
        var userRiskChart = new Chart(document.getElementById('userRiskChart'), {
            type: 'polarArea',
            data: {
                labels: ['Low Risk', 'Medium Risk', 'High Risk'],
                datasets: [{
                    labels: 'User Risk Chart',
                    data: [
                        <?php echo count($jsonData['Digital_User_Risk'][0]['email_at_risk_low']); ?>,
                        <?php echo count($jsonData['Digital_User_Risk'][0]['email_at_risk_medium']); ?>,
                        <?php echo count($jsonData['Digital_User_Risk'][0]['email_at_risk_high']); ?>
                ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 205, 86, 0.6)',
                        'rgba(255, 99, 132, 0.6)'
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });

        //MAP
        google.charts.load('current', {
        'packages': ['geochart'],
        });
        google.charts.setOnLoadCallback(drawMapChart);

        function drawMapChart() {
        var data = google.visualization.arrayToDataTable([
            ['Country'],
            ['EU'] // Replace 'EU' with the desired country short code
        ]);

        var options = {
            region: 'world',
            displayMode: 'regions',
            resolution: 'countries'
        };

        var chart = new google.visualization.GeoChart(document.getElementById('mapChart'));
        chart.draw(data, options);
        }
    </script>
</body>
</html>
