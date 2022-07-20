<?php
require './Database/connectToDatabase.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['id_number'])) {
    header('Location: ./index.php');
}

$sql = "SELECT * FROM Med  
GROUP BY `product_name`,`applied_date`
ORDER BY `Med`.`applied_date` DESC";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM Lab GROUP BY Lab.product_name ";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM `DAG`";
$result3 = $conn->query($sql3);

$sql4 = "SELECT `height`,`weight` FROM `Vitals`  ORDER BY `Vitals`.`read_ndate`  DESC LIMIT 1";
$result4 = $conn->query($sql4);

$sql5 = "SELECT `product_name`,`instructions` FROM Med WHERE `product_name`='DIACARE 2MG CAPSULES * 8' GROUP By `applied_date`  
ORDER BY `Med`.`applied_date`  ASC LIMIT 1";
$result5 = $conn->query($sql5);


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="Assets/Images/palestine.png" sizes="196x196" />
    <title>IonRemedy Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./Assets/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="application/javascript" href="./Assets/bootstrap-4.5.3-dist/js/bootstrap.min.js">
    <link rel="application/javascript" href="./Assets/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <script src="./node_modules/jquery/dist/jquery.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="./node_modules/chart.js/dist/Chart.js"></script>
    <script src="./node_modules/chart.js/dist/Chart.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./node_modules/chart.js/dist/Chart.min.css">
    <style>
    .listGroup1 {
        height: 750px;
        width: 100%;
    }

    .listGroup1 {
        overflow: hidden;
        overflow-y: scroll;
    }

    .listGroup2 {
        height: 750px;
        width: 100%;
    }

    .listGroup2 {
        overflow: hidden;
        overflow-y: scroll;
    }
    </style>



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="Assets/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {
        packages: ["calendar"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn({
            type: 'date',
            id: 'Date'
        });
        dataTable.addColumn({
            type: 'number',
            id: 'Won/Loss'
        });
        dataTable.addRows([
            [new Date(2021, 1, 4), 1],
            [new Date(2021, 2, 5), 2],
            [new Date(2021, 3, 12), 3],
            [new Date(2021, 4, 13), 4],
            [new Date(2021, 5, 19), 1],
            [new Date(2021, 5, 23), 1],
            [new Date(2021, 5, 24), 1],
            [new Date(2021, 5, 19), 1],
            [new Date(2021, 5, 23), 1],
            [new Date(2021, 5, 24), 1],
            [new Date(2021, 5, 30), 1]
        ]);

        var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

        var options = {
            height: 200,
            width: 550
        };

        chart.draw(dataTable, options);
    }
    </script>
    <script>
    function openTab(evt, Name) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("nav-link");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(Name).style.display = "block";
        evt.currentTarget.className += " active";
    }

    $(document).ready(function() {
        getReportingData(1);
        $.ajax({
            url: "./API/blood.php",
            method: "GET",
            dataType: 'JSON',
            cache: true,
            async: true,
            success: function(daraFromDatabase2) {
                var ctx = document.getElementById('linechart_material').getContext('2d');

                var labels = daraFromDatabase2.map(function(e) {
                    return e.read_ndate;
                });

                var data = daraFromDatabase2.map(function(e) {
                    return e.bp_systolic;
                });
                var data2 = daraFromDatabase2.map(function(e) {
                    return e.bp_diastolic;
                });


                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'Systolic',
                                data: data,
                                borderColor: 'rgb(255, 99, 71)',
                                fill: false
                            },
                            {
                                label: 'Diastolic',
                                data: data2,
                                borderColor: 'rgb(238, 130, 238)',
                                fill: false
                            },
                        ]
                    },
                    options: {
                        animations: {
                            radius: {
                                duration: 400,
                                easing: 'linear',
                                loop: (context) => context.active
                            }
                        },
                        hoverRadius: 12,
                        hoverBackgroundColor: 'yellow',
                        interaction: {
                            mode: 'nearest',
                            intersect: false,
                            axis: 'x'
                        },
                        plugins: {
                            tooltip: {
                                enabled: false
                            }
                        }
                    },
                });
                document.getElementById("loading2").style.display = "none";

            },
            error: function(data) {}
        });

        $.ajax({
            url: "./API/blood1.php",
            method: "GET",
            dataType: 'JSON',
            cache: true,
            async: true,
            success: function(daraFromDatabase2) {
                var ctx = document.getElementById('linechart_material1').getContext('2d');

                var labels = daraFromDatabase2.map(function(e) {
                    return e.applied_date;
                });

                var data = daraFromDatabase2.map(function(e) {
                    return e.Number;
                });



                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Adherence Rate for DIACARE 2MG CAPSULES * 8',
                            data: data,
                            borderColor: 'rgb(255, 20, 71)',
                            fill: false
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        animations: {
                            radius: {
                                duration: 400,
                                easing: 'linear',
                                loop: (context) => context.active
                            }
                        },
                        hoverRadius: 12,
                        hoverBackgroundColor: 'yellow',
                        interaction: {
                            mode: 'nearest',
                            intersect: false,
                            axis: 'x'
                        },
                        plugins: {
                            tooltip: {
                                enabled: false
                            }
                        }
                    },
                });
                document.getElementById("loading2").style.display = "none";

            },
            error: function(data) {}
        });

        $.ajax({
            url: "./API/re.php",
            method: "GET",
            dataType: 'JSON',
            cache: true,
            async: true,
            success: function(daraFromDatabase2) {
                var ctx = document.getElementById('pie_chart').getContext('2d');

                var labels = daraFromDatabase2.map(function(e) {
                    return e.name;
                });

                var data = daraFromDatabase2.map(function(e) {
                    return e.id;
                });



                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Adherence Rate for DIACARE 2MG CAPSULES * 8',
                            data: data,
                            fill: false,
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 205, 86)'
                            ],
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        hoverRadius: 12,
                        hoverBackgroundColor: 'yellow',
                        interaction: {
                            mode: 'nearest',
                            intersect: false,
                            axis: 'x'
                        },
                        legend: {
                            display: false //This will do the task
                        },
                        plugins: {
                            tooltip: {
                                enabled: false
                            }
                        }
                    },
                });
                document.getElementById("loading2").style.display = "none";

            },
            error: function(data) {}
        });
    });
    </script>
</head>


<nav class="navbar navbar-dark bg-dark container-fluid" style="background-color: #28a4ca !important;">
    <!-- <a class="navbar-brand" href="#"> <img src="./Assets/Images/pniph.png" alt="Logo" style="width:70px;height: 30px;"></a> -->
    <!-- <a class="topnav-icons fa fa-menu w3-hide-large w3-left w3-bar-item w3-button" onclick="w3_open()">
          <img src="./Assets/Images/icons8-menu-240-w.png" style="width:20px;height: 20px;">
      </a> -->
    <div class="container-fluid d-flex justify-content-between row">
        <div class="navbar-nav mr-auto">
            <a class="nav-link active" aria-current="page" href="#" style="color:white;">IonRemedy</a>
        </div>

    </div>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<body style="background-color: #F3F3F3;">


    <div class="d-flex justify-content-between w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left"
        style="width:250px;" id="mySidebar">
        <div class="card">
            <div class="card-header">
                Patiant info
            </div>
            <div class="card-body">
                <?php
                    if (mysqli_num_rows($result3) > 0) {
                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            ?>
                            <h5 class="card-title">ID</h5>
                            <p><?php echo $row3['patient_id']; ?></p>
                            <h5 class="card-title">Age</h5>
                            <p><?php echo $row3['age']; ?></p>
                            <h5 class="card-title">Diagnosis</h5>
                            <p><?php echo $row3['diagnosis']; ?></p>
                            <?php
                        }
                    }
                ?>

            </div>
        </div>



        <a class="w3-bar-item w3-button" data-toggle="tab" onclick="openTab(event, 'A')" href="#panel11" role="tab">
            <img src="./Assets/Images/icons8-activity-96.png" class="img-responsive" alt="Responsive image" width="30"
                height="30" />

            Adherence rate </a>
        <a class="w3-bar-item w3-button" data-toggle="tab" onclick="openTab(event, 'B')" href="#panel12" role="tab">
            <img src="./Assets/Images/icons8-pills-64.png" class="img-responsive" alt="Responsive image" width="30"
                height="30" />
            Medications</a>
        <a class="w3-bar-item w3-button" data-toggle="tab" onclick="openTab(event, 'C')" href="#panel13?getLog=true"
            role="tab">
            <img src="./Assets/Images/icons8-reports-64.png" class="img-responsive" alt="Responsive image" width="30"
                height="30" />
            Reports </a>
        <!-- <a class="w3-bar-item w3-button" data-toggle="tab" onclick="openTab(event, 'D')" href="#panel14" role="tab">
            <img src="./Assets/Images/icons8-info-48.png" class="img-responsive" alt="Responsive image" width="30"
                height="30" />
            Patient Info</a> -->
        <a class="w3-bar-item w3-button" data-toggle="tab" onclick="openTab(event, 'E')" href="#panel15" role="tab">
            <img src="./Assets/Images/icons8-human-organs-64.png" class="img-responsive" alt="Responsive image"
                width="30" height="30" />

            Vital signs & Readings </a>
        <div class="card">
            <div class="card-header">
                Connected Devices
            </div>
            <div class="card-body">
                <h5 class="card-title">iPhone</h5>
                <p style="color:red;">Disconnected</p>
                <h5 class="card-title">Apple Watch</h5>
                <p style="color:red;">Disconnected</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <a href="./operations/logout.php"><button class="btn btn-danger col-12" type="button">Logout</button></a>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="container my-4">
            <!--Grid column-->
            <div class="col-md-11 mb-4">
                <!-- Tab panels -->
                <div class="tab-content pt-0">
                    <div id="A" class="tabcontent">
                        <div class="row mb-2">
                            <div class="card col-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                                <label class="control-label" for="datepicker-start">Start Date</label>
                                                <input type="date" class="form-control" id="datepicker-start">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                                <label class="control-label" for="datepicker-end">End Date</label>
                                                <input type="date" class="form-control" id="datepicker-end">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-between">
                            <div class="card">
                                <div class="card-header">
                                    Adherence rate
                                </div>
                                <div class="card-body" style="width: 700px !important">
                                    <canvas id="linechart_material1"></canvas>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Medications
                                </div>
                                <div class="card-body" style="width: 300px !important">
                                    <div class="card">
                                        <div class="card-body">
                                        <?php
                    if (mysqli_num_rows($result5) > 0) {
                        while ($row5 = mysqli_fetch_assoc($result5)) {
                            ?>
                      <h5 class="card-title"><?php echo $row5['product_name']; ?></h5>
                                            <p><?php echo $row5['instructions']; ?></p>
                            <?php
                        }
                    }
                ?>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-between mt-2">
                            <div class="card">
                                <div class="card-header">
                                    Reason for non adherence
                                </div>
                                <div class="card-body" style="width: 700px !important">
                                    <div id="calendar_basic" style="width: 200px; height: 180px;"></div>

                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Reason for non adherence

                                </div>
                                <div class="card-body" style="width: 300px !important">
                                    <canvas id="pie_chart"></canvas>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="B" class="tabcontent" style="display: none;">
                        <div class="card">
                            <h5 class="card-header">Medication</h5>
                            <div class="card-body">
                                <div class="container">
                                    <div class="listGroup1">
                                        <table id="data_table"
                                            class="table table-responsive-sm table-responsive-md  table-border-0">
                                            <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <th style="border: 0;">
                                                    <div class="container">
                                                        <div class="row d-flex justify-content-between">
                                                            <div><a data-id="<?php echo $row["id"]; ?>"
                                                                    class="userinfo1"><strong
                                                                        style="color: black;"><?php echo $row["product_name"]; ?></strong>
                                                            </div>
                                                            <div class="text-right" style="color: black; ">
                                                                <?php echo $row["applied_date"]; ?></div>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </th>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="C" class="tabcontent" style="display: none;">
                        <div class="continer">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            Reports
                                        </div>
                                        <div class="card-body">
                                            <div class="listGroup2">

                                                <table id="data_table"
                                                    class="table table-responsive-sm table-responsive-md  table-border-0">
                                                    <?php
                                            if (mysqli_num_rows($result2) > 0) {
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    ?>
                                                    <tr>
                                                        <th style="border: 0;">
                                                            <img src="./Assets/Images/icons8-data-sheet-96.png"
                                                                width="30">
                                                            <a data-id="<?php echo $row2["product_name"]; ?>"
                                                                class="userinfo"><strong
                                                                    style="color: black;"><?php echo $row2["product_name"]; ?></strong></a>

                                                        </th>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                    <div id="E" class="tabcontent" style="display: none;">
                        <div class="container">
                            <div class="row">

                                <div class="col-9">
                                    <div class="card">
                                        <div class="card-header">
                                            vitals
                                        </div>
                                        <div class="card-body">
                                            <select class="custom-select" onchange="getReportingData(this.value)"
                                                name="vitals" id="vitals">
                                                <option disabled>Choose a vitals</option>
                                                <option value="1">Temp</option>
                                                <option value="2">pules</option>
                                                <option value="3">respiratory</option>
                                            </select>
                                            <div class="row" id="column_chart_values">
                                                <canvas id="columnchart_values"></canvas>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-3">
                                    <div>
                                        <div class="card">
                                            <div class="card-header">
                                                Max
                                            </div>
                                            <div class="card-body text-center">
                                                <h2>
                                                    <div id="max"></div>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="card">
                                            <div class="card-header">
                                                Min
                                            </div>
                                            <div class="card-body text-center">
                                                <h2>
                                                    <div id="min"></div>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="card">
                                            <div class="card-header">
                                                Avg
                                            </div>
                                            <div class="card-body text-center">
                                                <h2>
                                                    <div id="avg"></div>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-9">
                                    <div class="card">
                                        <div class="card-header">
                                            Blood Pressure
                                        </div>
                                        <div class="card-body">
                                            <div class="col-12">
                                                <canvas id="linechart_material"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                </div>
                <script src="coverage/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
                <script>
                bsCustomFileInput.init()

                var form = document.querySelector('form')
                </script>

            </div>
        </div>
    </div>
    </div>




    <div class="modal fade" id="empModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Reports</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="empModal1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Medication instructions</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script>
$(document).ready(function() {
    $(document).on('click', '.userinfo', function() {
        var product_name = $(this).data('id');
        // AJAX request
        $.ajax({
            url: 'ajaxfile.php',
            type: 'post',
            data: {
                product_name: product_name
            },
            success: function(response) {
                // Add response in Modal body
                $('.modal-body').html(response);

                // Display Modal
                $('#empModal').modal('show');
            }
        });
    });

    $(document).on('click', '.userinfo1', function() {
        var med_id = $(this).data('id');
        // AJAX request
        $.ajax({
            url: 'ajaxfile1.php',
            type: 'post',
            data: {
                med_id: med_id
            },
            success: function(response) {
                // Add response in Modal body
                $('.modal-body').html(response);

                // Display Modal
                $('#empModal1').modal('show');
            }
        });
    });
});

function w3_open() {
    if (document.getElementById("mySidebar").style.display == "block") {
        document.getElementById("mySidebar").style.display = "none";

    } else {
        document.getElementById("mySidebar").style.display = "block";

    }
}

function getReportingData(id) {
    $.ajax({
        url: "./API/json_chart.php?id=" + id,
        method: "GET",
        dataType: 'JSON',
        cache: true,
        async: true,
        success: function(daraFromDatabase5) {
            $('#columnchart_values').remove();
            $('#column_chart_values').append('<canvas id="columnchart_values"><canvas>');

            if (daraFromDatabase5.length != 0) {
                var ctx5 = document.getElementById('columnchart_values').getContext('2d');


                var labels5 = daraFromDatabase5.map(function(e) {
                    return e.read_ndate;
                });
                var name = "";
                var color = "";
                var chart_type = 'line';
                if (id == 1) {
                    var chart_type = 'line';
                    name = "Temp";
                    color = 'rgb(206, 52, 71)';
                    var data = daraFromDatabase5.map(function(e) {
                        return parseFloat(e.temp).toFixed(2);
                    });
                } else if (id == 2) {
                    var chart_type = 'line';
                    name = "Pulse";
                    color = 'rgb(252, 121, 71)';
                    var data = daraFromDatabase5.map(function(e) {
                        return parseFloat(e.pulse).toFixed(2);
                    });
                } else if (id == 3) {
                    var chart_type = 'line';
                    name = "Respiratory Rate";
                    color = 'rgb(252, 121, 131)';
                    var data = daraFromDatabase5.map(function(e) {
                        return parseFloat(e.respiratory_rate).toFixed(2);
                    });
                }
                var max = Math.max(...data);
                var min = Math.min(...data);

                var sum = 0;
                data.forEach((num) => {
                    sum += parseInt(num)
                });
                document.getElementById('max').innerHTML = max;
                document.getElementById('min').innerHTML = min;
                document.getElementById('avg').innerHTML = parseFloat(sum / data.length).toFixed(2);

                var myChart5 = new Chart(ctx5, {
                    type: chart_type,
                    data: {
                        labels: labels5,
                        datasets: [{
                                label: name,
                                data: data,
                                decimals: 2,
                                borderColor: color,
                                backgroundColor: 'rgba(54, 163, 235)',
                                fill: false,
                                stack: 'Stack 0',

                            }

                        ]
                    },

                });


            }



        },
        error: function(data) {
            $('#columnchart_values').remove();
            $('#column_chart_values').append('<canvas id="columnchart_values"><canvas>');
            Chart.plugins.register({
                afterDraw: chart => {
                    if (chart.data.datasets[0].data.length === 0) {
                        var ctx = chart.chart.ctx;
                        ctx.save();
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.font = "22px Arial";
                        ctx.fillStyle = "gray";
                        ctx.fillText('No data available', chart.chart.width / 2, chart.chart
                            .height / 2);
                        ctx.restore();
                    }
                }
            });
            new Chart(document.getElementById('columnchart_values'), {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        data: []
                    }]
                },
                options: {
                    legend: {
                        display: false
                    }
                }
            });

            document.getElementById("loading3").style.display = "none";
            document.getElementById('report_date').disabled = false;
            document.getElementById('loading5').style.display = 'none';
            document.getElementById('loading8').style.display = 'none';
        }
    });

}
</script>