<div class="container-fluid">

    <!-- Flash Message -->
    <?= $this->session->flashdata('message'); ?>

    <!-- Filter Card -->
    <div class="card shadow mb-5 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Attendance Report</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('report'); ?>" method="post">

                <div class="row">
                    <!-- Employee -->
                    <div class="col-md-4 mb-3">
                        <label for="employee_id">Employee</label>
                        <select class="form-control" id="employee_id" name="employee_id" required>
                            <option value="all" <?= ($selected_employee_id == 'all') ? 'selected' : ''; ?>>
                                All Employees
                            </option>
                            <?php if (isset($all_employees)): ?>
                                <?php foreach ($all_employees as $employee): ?>
                                    <option value="<?= $employee['id']; ?>"
                                        <?= ($selected_employee_id == $employee['id']) ? 'selected' : ''; ?>>
                                        <?= $employee['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <?= form_error('employee_id', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <!-- Start Date -->
                    <div class="col-md-4 mb-3">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="<?= $start_date ?: set_value('start_date'); ?>" required>
                        <?= form_error('start_date', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <!-- End Date -->
                    <div class="col-md-4 mb-3">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                            value="<?= $end_date ?: set_value('end_date'); ?>" required>
                        <?= form_error('end_date', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            Generate Report
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Data -->
    <?php if ($summary_data !== null): ?>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Summary Data (<?= date('d M Y', strtotime($start_date)); ?>
                            to <?= date('d M Y', strtotime($end_date)); ?>)
                        </h6>
                        <a href="<?= base_url('report/print_report?start_date=' . $start_date . '&end_date=' . $end_date . '&employee_id=' . $selected_employee_id); ?>"
                            target="_blank" class="btn btn-success btn-sm">
                            <i class="fas fa-print"></i> Print Report
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 3%;">No</th>
                                        <th style="width: 40%;">Nama Pegawai</th>
                                        <th style="width: 30%;">Jabatan</th>
                                        <th style="width: 27%;">Total Kehadiran (Hari)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if ($summary_data): foreach ($summary_data as $row): ?>
                                            <tr>
                                                <td class="text-center"><?= $i++; ?></td>
                                                <td><?= $row['employee_name']; ?></td>
                                                <td class="text-center"><?= $row['position_name'] ?: '-'; ?></td>
                                                <td class="text-center font-weight-bold"><?= $row['total_hadir']; ?></td>
                                            </tr>
                                        <?php endforeach;
                                    else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                Tidak ada ringkasan kehadiran ditemukan untuk periode ini.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif ($start_date && $end_date): ?>
        <div class="alert alert-info mt-4">
            No attendance data found for the selected filter.
        </div>
    <?php endif; ?>

</div>