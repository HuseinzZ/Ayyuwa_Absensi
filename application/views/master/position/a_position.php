<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <!-- Flash Message -->
            <?= $this->session->flashdata('message'); ?>

            <!-- Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Add Position</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('master/a_position'); ?>" method="POST">

                        <!-- Position ID -->
                        <div class="form-group row">
                            <label for="p_id" class="col-sm-4 col-form-label">Position ID</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    id="p_id"
                                    name="p_id"
                                    value="<?= set_value('p_id'); ?>">
                                <?= form_error('p_id', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>

                        <!-- Position Name -->
                        <div class="form-group row">
                            <label for="p_name" class="col-sm-4 col-form-label">Position Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    id="p_name"
                                    name="p_name"
                                    value="<?= set_value('p_name'); ?>">
                                <?= form_error('p_name', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>

                        <hr>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('master/position'); ?>" class="btn btn-secondary btn-icon-split">
                                <span class="icon text-white">
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                                <span class="text">Back</span>
                            </a>
                            <button type="submit" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            <!-- End Card -->

        </div>
    </div>
</div>