<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Dashboard</title>
    <?php $this->load->view('templates/head'); ?>
</head>

<body>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center text-primary">Dashboard</h3>
            </div>
        </div>
        <div class="reports">
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
        </div>
        <canvas id="dailyIncomeChart"></canvas>
        <div id="incomeChart" style="width: 800px; height: 400px;"></div>
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
    <?php $this->load->view('templates/footer'); ?>
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.1/dist/echarts.min.js"></script>
    <script>
        var dailyIncomeData = <?php echo json_encode($daily_income); ?>;
        var monthlyIncomeData = <?php echo json_encode($monthly_income); ?>;

        var dailyDates = dailyIncomeData.map(function(item) {
            return item.date;
        });

        var monthlyDates = monthlyIncomeData.map(function(item) {
            return item.month;
        });

        var dailyIncome = dailyIncomeData.map(function(item) {
            return item.total_income;
        });

        var monthlyIncome = monthlyIncomeData.map(function(item) {
            return item.total_income;
        });

        var chart = echarts.init(document.getElementById('incomeChart'));
        var option = {
            title: {
                text: 'Income Chart'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                }
            },
            legend: {
                data: ['Daily Income', 'Monthly Income']
            },
            xAxis: {
                type: 'category',
                data: dailyDates,
                axisLabel: {
                    rotate: 45,
                    interval: 0
                }
            },
            yAxis: {
                type: 'value',
                name: 'Income'
            },
            series: [{
                    name: 'Daily Income',
                    type: 'bar',
                    data: dailyIncome
                },
                {
                    name: 'Monthly Income',
                    type: 'bar',
                    data: monthlyIncome
                }
            ]
        };
        chart.setOption(option);

        $(document).ready(function() {
            <?php
            if ($this->session->flashdata('edit_password') || $this->session->flashdata('edit_pp')) { ?>
                $('#message-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>

</html>