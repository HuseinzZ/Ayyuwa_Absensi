<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Employee</h6>
        </div>
        <div class="card-body">
            <?= form_open_multipart('master/e_employee/' . $employee['id']); ?>
            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-6">
                    <!-- Employee ID -->
                    <div class="form-group">
                        <label for="emp_id">ID</label>
                        <input type="text" class="form-control" id="emp_id" name="emp_id"
                            value="<?= $employee['id']; ?>" readonly>
                    </div>

                    <!-- Name -->
                    <div class="form-group">
                        <label for="emp_name">Name</label>
                        <input type="text" class="form-control" id="emp_name" name="emp_name"
                            value="<?= $employee['name']; ?>">
                        <?= form_error('emp_name', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="emp_email">Email</label>
                        <input type="email" class="form-control" id="emp_email" name="emp_email"
                            value="<?= $employee['email']; ?>">
                        <?= form_error('emp_email', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <!-- Gender -->
                    <div class="form-group">
                        <label for="emp_gender">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="emp_gender" id="genderMale"
                                value="M" <?= ($employee['gender'] == 'M') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="genderMale">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="emp_gender" id="genderFemale"
                                value="F" <?= ($employee['gender'] == 'F') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="genderFemale">Female</label>
                        </div>
                        <?= form_error('emp_gender', '<small class="text-danger d-block">', '</small>'); ?>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-6">
                    <!-- Date of Birth -->
                    <div class="form-group">
                        <label for="emp_birth_date">Date of Birth</label>
                        <input type="date" class="form-control" id="emp_birth_date" name="emp_birth_date"
                            value="<?= $employee['birth_date']; ?>">
                        <?= form_error('emp_birth_date', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <!-- Hire Date -->
                    <div class="form-group">
                        <label for="emp_hire_date">Hire Date</label>
                        <input type="date" class="form-control" id="emp_hire_date" name="emp_hire_date"
                            value="<?= $employee['hire_date']; ?>">
                        <?= form_error('emp_hire_date', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <!-- Position -->
                    <div class="form-group">
                        <label for="emp_position_id">Position</label>
                        <select name="emp_position_id" id="emp_position_id" class="form-control">
                            <option value="">Select Position</option>
                            <?php foreach ($positions as $p): ?>
                                <option value="<?= $p['id']; ?>" <?= ($employee['position_id'] == $p['id']) ? 'selected' : ''; ?>>
                                    <?= $p['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('emp_position_id', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <!-- Current Image -->
                    <div class="form-group">
                        <label>Current Image</label><br>
                        <img src="<?= base_url('assets/img/profile/') . $employee['image']; ?>"
                            class="img-thumbnail mb-2"
                            style="height: 250px; width: 100%; object-fit: cover; object-position: top;">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="emp_image" name="emp_image">
                            <label class="custom-file-label" for="emp_image">Choose new file</label>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('master/index'); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>