<?php
require 'connection.php';
// $page = $_SERVER['PHP_SELF'];
// $timer = "1";

// Eksperimen Gauge
try {
  $sql = 'SELECT * FROM testing';
  $row = $connection->query($sql);
  $row->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Connection to Database Failed!. Please Check Database Connection!!" . $e->getMessage());
}
while ($rows = $row->fetch()) {
  // $nama = $rows["nama"];
  // $sensor_kelembaban = $rows["sensor_kelembaban"];
  // $sensor_n = $rows["sensor_n"];
  // $sensor_p = $rows["sensor_p"];
  // $sensor_k = $rows["sensor_k"];
  // $sensor_ph = $rows["sensor_ph"];
  $timestamps = $rows["timestamp"];
  $sensor_data[] = $rows;
}
$nama = json_encode(array_reverse(array_column($sensor_data, 'nama')), JSON_NUMERIC_CHECK);
$sensor_kelembaban = json_encode(array_reverse(array_column($sensor_data, 'sensor_kelembaban')), JSON_NUMERIC_CHECK);
$sensor_n = json_encode(array_reverse(array_column($sensor_data, 'sensor_n')), JSON_NUMERIC_CHECK);
$sensor_p = json_encode(array_reverse(array_column($sensor_data, 'sensor_p')), JSON_NUMERIC_CHECK);
$sensor_k = json_encode(array_reverse(array_column($sensor_data, 'sensor_k')), JSON_NUMERIC_CHECK);
$sensor_ph = json_encode(array_reverse(array_column($sensor_data, 'sensor_ph')), JSON_NUMERIC_CHECK);
$timestamp = json_encode(array_reverse($sensor_data, 'timestamp'), JSON_NUMERIC_CHECK);

// echo $nama;
// echo $sensor_kelembaban;
// echo $sensor_n;
// echo $sensor_p;
// echo $sensor_k;
// echo $sensor_ph;
// echo $timestamp;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="SMART IRIGATION" />
  <meta name="author" content="GUNADARMA UNIVERSITY" />
  
  <title>IRIGASI TETES</title>

  <link href="css/styles.css" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
  <script data-search-pseudo-elements defer
    src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js"
    crossorigin="anonymous"></script>
  <!-- Button Section -->

  <head>
    <!-- CSS gauge -->
    <!-- <meta http-equiv="refresh" content="10"> -->
    <link href="css/jquery.simplegauge.css" type="text/css" rel="stylesheet" />
    <!-- USE SCRIPT BELOW IF BROWSER REFRESH 10 SECONDS -->
    <!-- <meta http-equiv="refresh" content="10"> --> 

  </head>

  <div id="layoutSidenav_content">
    <main>
      <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
          <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
              <div class="col-auto mt-4">
                <h1 class="page-header-title">
                  <div class="page-header-icon"><i class="fas fa-tachometer-alt"></i></div>
                  Dashboard Utama
                </h1>
                <div class="page-header-subtitle">Sistem Irigasi</div>
              </div>
            </div>
          </div>
      </header>
      <!-- Main page content-->
      <!-- Section 1 -->
      <div class="container-xl px-4 mt-n10">
        <!-- update frequency chart-->
        <!-- <div class="card mb-4">
                            <div class="card-header">Update Frequency</div>
                            <div class="card-body">
                                <div class="chart-area"><canvas id="updateFrequencyChart" width="100%" height="30"></canvas></div>
                            </div>
                            <div class="card-footer small text-muted">Updated today at <?php echo (date("H:i:s", time())); ?> </div>
                        </div> -->
        <!-- Started -->
        <div class="row">
          <div class="col-xl-6 mb-4">
            <div class="card card-collapsable">
              <a class="card-header" href="#collapseCardExampleAccelZ" data-bs-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExampleAccelZ">Sensor Kelembaban
                <div class="card-collapsable-arrow">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </a>
              <div class="collapse show" id="collapseCardExampleAccelZ">
                <div class="container-fuild">
                  <div class="row">
                    <div class="card-body">
                      <div class="chart-area"><canvas id="updateKelembaban" width="100%" height="40"></canvas>
                      </div>
                    </div>
                    <div class="card-footer large text-muted">Updated today at
                     <?php echo $timestamps; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 mb-4">
            <div class="card card-collapsable">
              <a class="card-header" href="#collapseCardExampleGyroX" data-bs-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExampleGyroX">Sensor Nitrogen
                <div class="card-collapsable-arrow">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </a>
              <div class="collapse show" id="collapseCardExampleGyroX">
                <div class="container-fuild">
                  <div class="row">
                    <div class="card-body">
                      <div class="chart-area"><canvas id="updateNitrogen" width="100%" height="40"></canvas>
                      </div>
                    </div>
                    <div class="card-footer large text-muted">Updated today at
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6 mb-4">
            <div class="card card-collapsable">
              <a class="card-header" href="#collapseCardExampleGyroY" data-bs-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExampleGyroY">Sensor Potasium
                <div class="card-collapsable-arrow">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </a>
              <div class="collapse show" id="collapseCardExampleGyroY">
                <div class="container-fuild">
                  <div class="row">
                    <div class="card-body">
                      <div class="chart-area"><canvas id="updatePotasium" width="100%" height="40"></canvas>
                      </div>
                    </div>
                    <div class="card-footer large text-muted">Updated today at
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 mb-4">
            <div class="card card-collapsable">
              <a class="card-header" href="#collapseCardExampleGyroZ" data-bs-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExampleGyroZ">Sensor Kalium
                <div class="card-collapsable-arrow">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </a>
              <div class="collapse show" id="collapseCardExampleGyroZ">
                <div class="container-fuild">
                  <div class="row">
                    <div class="card-body">
                      <div class="chart-area"><canvas id="updateKalium" width="100%" height="40"></canvas>
                      </div>
                    </div>
                    <div class="card-footer large text-muted">Updated today at
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 mb-4">
            <div class="card card-collapsable">
              <a class="card-header" href="#collapseCardExampleGyroZ" data-bs-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExampleGyroZ">Sensor Ph
                <div class="card-collapsable-arrow">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </a>
              <div class="collapse show" id="collapseCardExampleGyroZ">
                <div class="container-fuild">
                  <div class="row">
                    <div class="card-body">
                      <div class="chart-area"><canvas id="updatePh" width="100%" height="40"></canvas>
                      </div>
                    </div>
                    <div class="card-footer large text-muted">Updated today at
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </main>
    <br>
  </div>
  </div>

  </body>

</html>


<!-- Testing -->

<script src="assets/demo/jquery.min.js"></script>
<script src="assets/demo/jquery.js"></script>
<!-- jQuery Knob -->
<!-- <script src="assets/demo/jquery.knob.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-latest.js" type="text/javascript" charset="utf-8"></script>
        <script src="assets/demo/jquery.simplegauge.js" type="text/javascript"></script> -->

<!-- Costume -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
  crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" crossorigin="anonymous"></script>
<script src="js/updatefreq.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables/datatables-simple-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
<script src="js/litepicker.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"
  integrity="sha256-GMN9UIJeUeOsn/Uq4xDheGItEeSpI5Hcfp/63GclDZk=" crossorigin="anonymous"></script>
<script
  src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

<!-- Javascript  -->
<script>
  let kelembaban = <?php echo $sensor_kelembaban; ?>;
  let n = <?php echo $sensor_n; ?>;
  let p = <?php echo $sensor_p; ?>;
  let k = <?php echo $sensor_k; ?>;
  let ph = <?php echo $sensor_ph; ?>;
  let time = <?php echo $timestamp ?>;

$(document).ready(function() {
const ctx = document.getElementById('updateKelembaban').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [10,20,30,40,50,60,70,80,90,100],
        datasets: [{
            label: "Update per minutes",
            lineTension: 0.3,
            backgroundColor: "rgba(0, 97, 242, 0.05)",
            borderColor: "rgba(0, 97, 242, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(0, 97, 242, 1)",
            pointBorderColor: "rgba(0, 97, 242, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(0, 97, 242, 1)",
            pointHoverBorderColor: "rgba(0, 97, 242, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [kelembaban ]
        }]
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                time: {
                    unit: "time"
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 10
                }
            }],
            y: {
                beginAtZero: true
            }
        },
        legend: {
            display: true
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: "#6e707e",
            titleFontSize: 14,
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: "index",
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel =
                        chart.datasets[tooltipItem.datasetIndex].label || "";
                    return datasetLabel + ": $" + number_format(tooltipItem.yLabel);
                }
            }
        }
    }
});
});
</script>

</body>

</html>