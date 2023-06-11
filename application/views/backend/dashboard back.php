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
        <canvas id="monthlyIncomeChart"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var dailyIncomeData = <?php echo json_encode($daily_income); ?>;
        var monthlyIncomeData = <?php echo json_encode($monthly_income); ?>;

        var dates = dailyIncomeData.map(function(item) {
            return item.date;
        });

        var monthlyDates = monthlyIncomeData.map(function(item) {
            return item.month;
        });

        var income = dailyIncomeData.map(function(item) {
            return item.total_income;
        });

        var ctx = document.getElementById('dailyIncomeChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Daily Income',
                    data: income,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Income'
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            var value = context.dataset.data[context.dataIndex];
                            return label + ': ' + value;
                        }
                    }
                }
            }
        });

        var ctx = document.getElementById('monthlyIncomeChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthlyDates,
                datasets: [{
                    label: 'Monthly Income',
                    data: income,
                    backgroundColor: 'rgba(192, 75, 192, 0.2)',
                    borderColor: 'rgba(192, 75, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Income'
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            var value = context.dataset.data[context.dataIndex];
                            return label + ': ' + value;
                        }
                    }
                }
            }
        });

        $(document).ready(function() {
            <?php
            if ($this->session->flashdata('edit_password') || $this->session->flashdata('edit_pp')) { ?>
                $('#message-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>

</html>