<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Add Attendance</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('master/a_attendance'); ?>" method="POST">
                        <!-- Employee -->
                        <div class="form-group row">
                            <label for="employee_id" class="col-sm-4 col-form-label">Employee</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="employee_id" name="employee_id">
                                    <option value="">Select Employee</option>
                                    <?php foreach ($employees as $employee) : ?>
                                        <option value="<?= $employee['id']; ?>" <?= set_select('employee_id', $employee['id']); ?>>
                                            <?= $employee['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('employee_id', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>

                        <!-- Attendance Date -->
                        <div class="form-group row">
                            <label for="attendance_date" class="col-sm-4 col-form-label">Attendance Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="attendance_date" name="attendance_date" value="<?= set_value('attendance_date'); ?>">
                                <?= form_error('attendance_date', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>

                        <!-- Check-in -->
                        <div class="form-group row">
                            <label for="check_in" class="col-sm-4 col-form-label">Check-in Time</label>
                            <div class="col-sm-8">
                                <input type="time" class="form-control" id="check_in" name="check_in" value="<?= set_value('check_in'); ?>">
                                <?= form_error('check_in', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>

                        <!-- Status In -->
                        <div class="form-group row">
                            <label for="status_in" class="col-sm-4 col-form-label">Status In</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="status_in" name="status_in">
                                    <option value="">Select Status</option>
                                    <option value="Present" <?= set_select('status_in', 'Present'); ?>>Present</option>
                                    <option value="Late" <?= set_select('status_in', 'Late'); ?>>Late</option>
                                </select>
                                <?= form_error('status_in', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>

                        <!-- Check-out -->
                        <div class="form-group row">
                            <label for="check_out" class="col-sm-4 col-form-label">Check-out Time</label>
                            <div class="col-sm-8">
                                <input type="time" class="form-control" id="check_out" name="check_out" value="<?= set_value('check_out'); ?>">
                                <?= form_error('check_out', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>

                        <!-- Status Out -->
                        <div class="form-group row">
                            <label for="status_out" class="col-sm-4 col-form-label">Status Out</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="status_out" name="status_out">
                                    <option value="">Select Status</option>
                                    <option value="On Time" <?= set_select('status_out', 'On Time'); ?>>On Time</option>
                                    <option value="Left Early" <?= set_select('status_out', 'Left Early'); ?>>Left Early</option>
                                </select>
                                <?= form_error('status_out', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('master/attendance'); ?>" class="btn btn-secondary btn-icon-split">
                                <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                                <span class="text">Back</span>
                            </a>
                            <button type="submit" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white"><i class="fas fa-save"></i></span>
                                <span class="text">Add</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>