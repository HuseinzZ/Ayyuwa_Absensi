<div class="container-fluid">

    <!-- Row Cards Summary -->
    <div class="row">

        <!-- Positions -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Positions
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $display['c_position']; ?> Positions
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white pt-0 pb-0 border-0">
                    <div class="row align-items-center">
                        <div class="col text-right">
                            <a href="<?= base_url('master/position'); ?>"
                                class="text-xs font-weight-bold text-primary text-uppercase">
                                View &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employees -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Employees
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $display['c_employee']; ?> Employees
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-id-badge fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white pt-0 pb-0 border-0">
                    <div class="row align-items-center">
                        <div class="col text-right">
                            <a href="<?= base_url('master'); ?>"
                                class="text-xs font-weight-bold text-success text-uppercase">
                                View &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Attendance -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Today's Attendance
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $display['c_attendance_today']; ?> Checked In
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white pt-0 pb-0 border-0">
                    <div class="row align-items-center">
                        <div class="col text-right">
                            <a href="<?= base_url('master/attendance'); ?>"
                                class="text-xs font-weight-bold text-info text-uppercase">
                                View &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $display['c_users']; ?> Active Users
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white pt-0 pb-0 border-0">
                    <div class="row align-items-center">
                        <div class="col text-right">
                            <a href="<?= base_url('master/users'); ?>"
                                class="text-xs font-weight-bold text-danger text-uppercase">
                                View &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Charts Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Monthly Attendance Overview (<?= date('Y'); ?>)
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Options:</div>
                            <a class="dropdown-item" href="<?= base_url('master/attendance'); ?>">View All Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Overall Attendance Status (%)</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Options:</div>
                            <a class="dropdown-item" href="<?= base_url('report'); ?>">Generate Report</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i>
                            Present (<?= $attendance_status['percentages']['Present']; ?>%)
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-secondary"></i>
                            Late (<?= $attendance_status['percentages']['Late']; ?>%)
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row"><!-- Reserved for future content --></div>

</div>

<script>
    // Data untuk Area Chart (Kehadiran Bulanan)
    var monthlyAttendanceData = <?= json_encode($monthly_attendance); ?>;

    // Data untuk Pie Chart (Status Kehadiran: Present, Late)
    var attendancePieData = [
        <?= $attendance_status['percentages']['Present']; ?>, // Persentase Present (Index 0)
        <?= $attendance_status['percentages']['Late']; ?> // Persentase Late (Index 1)
    ];
</script>