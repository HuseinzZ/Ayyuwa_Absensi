<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Attendance</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('master/e_attendance/' . $attendance['id']); ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $attendance['id']; ?>">
                        <div class="form-group row">
                            <label for="employee_name" class="col-sm-4 col-form-label">Employee</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="employee_id" value="<?= $attendance['employee_id']; ?>">
                                <input type="text" class="form-control" id="employee_name" value="<?= $attendance['employee_name']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="attendance_date" class="col-sm-4 col-form-label">Attendance Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="attendance_date" name="attendance_date" value="<?= set_value('attendance_date', $attendance['attendance_date']); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="check_in" class="col-sm-4 col-form-label">Check-in Time</label>
                            <div class="col-sm-8">
                                <input type="time" class="form-control" id="check_in" name="check_in" value="<?= set_value('check_in', $attendance['check_in']); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_in" class="col-sm-4 col-form-label">Status In</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="status_in" name="status_in">
                                    <option value="">Select Status</option>
                                    <option value="Present" <?= set_select('status_in', 'Present', ($attendance['status_in'] == 'Present')); ?>>Present</option>
                                    <option value="Late" <?= set_select('status_in', 'Late', ($attendance['status_in'] == 'Late')); ?>>Late</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="check_out" class="col-sm-4 col-form-label">Check-out Time</label>
                            <div class="col-sm-8">
                                <input type="time" class="form-control" id="check_out" name="check_out" value="<?= set_value('check_out', $attendance['check_out']); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_out" class="col-sm-4 col-form-label">Status Out</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="status_out" name="status_out">
                                    <option value="">Select Status</option>
                                    <option value="On Time" <?= set_select('status_out', 'On Time', ($attendance['status_out'] == 'On Time')); ?>>On Time</option>
                                    <option value="Left Early" <?= set_select('status_out', 'Left Early', ($attendance['status_out'] == 'Left Early')); ?>>Left Early</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="latitude" class="col-sm-4 col-form-label">Latitude</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="latitude" name="latitude" value="<?= set_value('latitude', $attendance['latitude']); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="longitude" class="col-sm-4 col-form-label">Longitude</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="longitude" name="longitude" value="<?= set_value('longitude', $attendance['longitude']); ?>">
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
                                <span class="text">Update</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>