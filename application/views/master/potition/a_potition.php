<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Add Potition</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('master/a_potition'); ?>" method="POST">
                        <div class="form-group row">
                            <label for="p_id" class="col-sm-4 col-form-label">Potition ID</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="p_id" name="p_id" value="<?= set_value('p_id'); ?>">
                                <?= form_error('p_id', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="p_name" class="col-sm-4 col-form-label">Potition Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="p_name" name="p_name" value="<?= set_value('p_name'); ?>">
                                <?= form_error('p_name', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-sm-8 text-center">
                                <a href="<?= base_url('master/potition'); ?>" class="btn btn-secondary btn-icon-split mt-3">
                                    <span class="icon text-white">
                                        <i class="fas fa-arrow-left"></i>
                                    </span>
                                    <span class="text">Back</span>
                                </a>
                                <button type="submit" class="btn btn-primary btn-icon-split mt-3 ml-2">
                                    <span class="icon text-white">
                                        <i class="fas fa-save"></i>
                                    </span>
                                    <span class="text">Save</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>