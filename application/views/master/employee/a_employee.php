<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Add New Employee</h6>
        </div>
        <div class="card-body">
            <?= form_open_multipart('master/a_employee'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="emp_id">ID</label>
                        <input type="text" class="form-control" id="emp_id" name="emp_id" value="<?= set_value('emp_id'); ?>">
                        <?= form_error('emp_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="emp_name">Name</label>
                        <input type="text" class="form-control" id="emp_name" name="emp_name" value="<?= set_value('emp_name'); ?>">
                        <?= form_error('emp_name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="emp_email">Email</label>
                        <input type="email" class="form-control" id="emp_email" name="emp_email" value="<?= set_value('emp_email'); ?>">
                        <?= form_error('emp_email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="emp_gender">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="emp_gender" id="genderMale" value="M" <?= set_radio('emp_gender', 'M'); ?>>
                            <label class="form-check-label" for="genderMale">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="emp_gender" id="genderFemale" value="F" <?= set_radio('emp_gender', 'F'); ?>>
                            <label class="form-check-label" for="genderFemale">Female</label>
                        </div>
                        <?= form_error('emp_gender', '<small class="text-danger d-block">', '</small>'); ?>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="emp_birth_date">Date of Birth</label>
                        <input type="date" class="form-control" id="emp_birth_date" name="emp_birth_date" value="<?= set_value('emp_birth_date'); ?>">
                        <?= form_error('emp_birth_date', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="emp_hire_date">Hire Date</label>
                        <input type="date" class="form-control" id="emp_hire_date" name="emp_hire_date" value="<?= set_value('emp_hire_date'); ?>">
                        <?= form_error('emp_hire_date', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="emp_potition_id">Position</label>
                        <select name="emp_potition_id" id="emp_potition_id" class="form-control">
                            <option value="">Select Position</option>
                            <?php foreach ($potitions as $p) : ?>
                                <option value="<?= $p['id']; ?>" <?= set_select('emp_potition_id', $p['id']); ?>>
                                    <?= $p['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('emp_potition_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="emp_image">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="emp_image" name="emp_image">
                            <label class="custom-file-label" for="emp_image">Choose file</label>
                        </div>
                        <?= form_error('emp_image', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('master/index'); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Add
                </button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>