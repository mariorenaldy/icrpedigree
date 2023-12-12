<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Dashboard</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center text-primary">Dashboard</h3>
            </div>
        </div>
        <div class="reports mb-5">
        <?php if ($this->session->userdata('use_type_id') != $this->config->item('staff') && $this->session->userdata('use_type_id') != $this->config->item('stock_manager')){ ?>
            <div class="input-group mb-3">
                <label class="control-label col-md-2">Number of Canines</label>
                <div class="col-md-10">
                    <?= $canCount; ?>
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="control-label col-md-2">Number of Members</label>
                <div class="col-md-10">
                    <?= $memCount; ?>
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="control-label col-md-2">Number of Studs</label>
                <div class="col-md-10">
                    <?= $studCount; ?>
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="control-label col-md-2">Number of Births</label>
                <div class="col-md-10">
                    <?= $birthCount; ?>
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="control-label col-md-2">Number of Puppies</label>
                <div class="col-md-10">
                    <?= $stbCount; ?>
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="control-label col-md-2">Number of Trah/Breed</label>
                <div class="col-md-10">
                    <?= $trahCount; ?>
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="control-label col-md-2">Number of Users</label>
                <div class="col-md-10">
                    <?= $userCount; ?>
                </div>
            </div>
            <?php } ?>
            <?php if ($this->session->userdata('use_type_id') != $this->config->item('admin_user')){ ?>
            <div class="input-group mb-3">
                <label class="control-label col-md-2">Number of Products</label>
                <div class="col-md-10">
                    <?= $proCount; ?>
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="control-label col-md-2">Number of Orders</label>
                <div class="col-md-10">
                    <?= $orderCount; ?>
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="control-label col-md-2">Total Income</label>
                <div class="col-md-10">
                    Rp <?= number_format($income, 0, ",", "."); ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <label for="yearpicker">Year: </label>
        <select class="mb-3" name="yearpicker" id="yearpicker"></select>
        <?php if ($this->session->userdata('use_type_id') != $this->config->item('admin_user')){ ?>
        <div id="incomeChart" style="width: 800px; height: 400px;"></div>
        <?php } ?>
        <?php if ($this->session->userdata('use_type_id') != $this->config->item('staff') && $this->session->userdata('use_type_id') != $this->config->item('stock_manager')){ ?>
        <div id="memberChart" style="width: 800px; height: 400px;"></div>
        <?php } ?>
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-success">
                        <?php if ($this->session->flashdata('edit_password')) { ?>
                            <div class="row">
                                <div class="col-12">Password has been saved</div>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('edit_pp')) { ?>
                            <div class="row">
                                <div class="col-12">PP has been changed</div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-dark" id="error-modal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-danger">
                    <div class="row">
                        <div class="col-12">Data not found</div>
                    </div>
                    <div id="error-row" class="row" style="display: none;">
                        <div id="error-col" class="col-12"></div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('templates/footer'); ?>
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.1/dist/echarts.min.js"></script>
    <script>
        var startYear = 2009;
        for (i = new Date().getFullYear(); i > startYear; i--) {
            $('#yearpicker').append($('<option />').val(i).html(i));
        }

        $('#yearpicker').on("change", function(e) {
            e.preventDefault();
            let yearValue = $('#yearpicker').find(":selected").val();
            $.ajax({
                url: "<?= base_url() ?>backend/Dashboard/getIncomeData",
                method: 'post',
                data: {
                    yearValue: yearValue
                },
                success: function(response) {
                    if (response) {
                        updateChart(yearValue, JSON.parse(response));
                    } else {
                        $('#error-modal').modal('show');
                    }
                }
            });
            $.ajax({
                url: "<?= base_url() ?>backend/Dashboard/getReportData",
                method: 'post',
                data: {
                    yearValue: yearValue
                },
                success: function(response) {
                    if (response) {
                        let result = JSON.parse(response);
                        console.log(result.member);
                        console.log(result.canine);
                        console.log(result.stud);
                        console.log(result.birth);
                        updateRegChart(yearValue, result.member, result.canine, result.stud, result.birth);
                    } else {
                        $('#error-modal').modal('show');
                    }
                }
            });
        });

        // Daftar nama bulan dalam bahasa Indonesia
        var monthNamesEnglish = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        function updateChart(year, data) {
            var monthlyDates = data.map(function(item) {
                return item.month;
            });

            var monthlyIncome = data.map(function(item) {
                return item.total_income;
            });

            var chart = echarts.init(document.getElementById('incomeChart'));
            var option = {
                title: {
                    text: 'Income Chart ' + year
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                legend: {
                    data: ['Monthly Income']
                },
                xAxis: {
                    type: 'category',
                    data: monthlyDates,
                    axisLabel: {
                        rotate: 0,
                        interval: 0,
                        formatter: function(value) {
                            var date = new Date(value);
                            return monthNamesEnglish[date.getMonth()];
                        }
                    }
                },
                yAxis: {
                    type: 'value',
                    name: 'Income'
                },
                series: [{
                    name: 'Monthly Income',
                    type: 'bar',
                    data: monthlyIncome
                }]
            };
            chart.setOption(option);
        }

        function updateRegChart(year, data, dataCan, dataStud, dataBirth) {
            var monthlyDates = data.map(function(item) {
                return item.month;
            });

            var monthlyCanineDates = dataCan.map(function(item) {
                return item.month;
            });

            var monthlyStudDates = dataStud.map(function(item) {
                return item.month;
            });

            var monthlyBirthDates = dataBirth.map(function(item) {
                return item.month;
            });

            Array.prototype.unique = function() {
                var a = this.concat();
                for (var i = 0; i < a.length; ++i) {
                    for (var j = i + 1; j < a.length; ++j) {
                        if (a[i] === a[j])
                            a.splice(j--, 1);
                    }
                }

                return a;
            };

            var allDates = monthlyDates.concat(monthlyCanineDates).unique();
            allDates = allDates.concat(monthlyStudDates).unique();
            allDates = allDates.concat(monthlyBirthDates).unique();

            //sort bulan
            var allDates = monthlyDates.concat(monthlyCanineDates).unique();
            allDates.sort(function(a, b) {
                return new Date(a) - new Date(b);
            });

            var monthlyCount = [];
            allDates.forEach(function(date) {
                var index = monthlyDates.indexOf(date);
                if (index !== -1) {
                    monthlyCount.push(data[index].total_member);
                } else {
                    monthlyCount.push(0); // Masukkan 0 jika tidak ada data member pada bulan yang sesuai
                }
            });

            var monthlyCanineCount = [];
            allDates.forEach(function(date) {
                var index = monthlyCanineDates.indexOf(date);
                if (index !== -1) {
                    monthlyCanineCount.push(dataCan[index].total_canine);
                } else {
                    monthlyCanineCount.push(0); // Masukkan 0 jika tidak ada data anjing pada bulan yang sesuai
                }
            });

            var monthlyStudCount = [];
            allDates.forEach(function(date) {
                var index = monthlyStudDates.indexOf(date);
                if (index !== -1) {
                    monthlyStudCount.push(dataStud[index].total_stud);
                } else {
                    monthlyStudCount.push(0); // Masukkan 0 jika tidak ada data pacak pada bulan yang sesuai
                }
            });

            var monthlyBirthCount = [];
            allDates.forEach(function(date) {
                var index = monthlyBirthDates.indexOf(date);
                if (index !== -1) {
                    monthlyBirthCount.push(dataBirth[index].total_birth);
                } else {
                    monthlyBirthCount.push(0); // Masukkan 0 jika tidak ada data lahir pada bulan yang sesuai
                }
            });

            var chart = echarts.init(document.getElementById('memberChart'));
            var option = {
                title: {
                    text: 'Report Chart ' + year
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                legend: {
                    x: 'right',
                    data: ['Member Registered', 'Dog Registered', 'Stud Reported', 'Birth Reported']
                },
                xAxis: {
                    type: 'category',
                    data: allDates,
                    axisLabel: {
                        rotate: 0,
                        interval: 0,
                        formatter: function(value) {
                            var date = new Date(value);
                            return monthNamesEnglish[date.getMonth()];
                        }
                    }
                },
                yAxis: {
                    type: 'value',
                    name: 'Count'
                },
                series: [{
                        name: 'Member Registered',
                        type: 'bar',
                        data: monthlyCount
                    },
                    {
                        name: 'Dog Registered',
                        type: 'bar',
                        data: monthlyCanineCount
                    },
                    {
                        name: 'Stud Reported',
                        type: 'bar',
                        data: monthlyStudCount
                    },
                    {
                        name: 'Birth Reported',
                        type: 'bar',
                        data: monthlyBirthCount
                    }
                ]
            };
            chart.setOption(option);
        }

        var monthlyIncomeData = <?php echo json_encode($monthly_income); ?>;
        <?php if ($this->session->userdata('use_type_id') != $this->config->item('admin_user')){ ?>
        updateChart(<?= $year; ?>, monthlyIncomeData);
        <?php } ?>
        
        var memberData = <?php echo json_encode($memberData); ?>;
        var canineData = <?php echo json_encode($canineData); ?>;
        var studData = <?php echo json_encode($studData); ?>;
        var birthData = <?php echo json_encode($birthData); ?>;
        updateRegChart(<?= $year; ?>, memberData, canineData, studData, birthData);

        $(document).ready(function() {
            <?php
            if ($this->session->flashdata('edit_password') || $this->session->flashdata('edit_pp')) { ?>
                $('#message-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>

</html>