<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Potition</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('master/e_potition/' . $old_potition['id']); ?>" method="POST">
                        <div class="form-group row">
                            <label for="p_id" class="col-sm-4 col-form-label">Potition ID</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="p_id" name="p_id" value="<?= $old_potition['id']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="p_name" class="col-sm-4 col-form-label">Potition Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="p_name" name="p_name" value="<?= $old_potition['name']; ?>">
                                <?= form_error('p_name', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('master/potition'); ?>" class="btn btn-secondary btn-icon-split">
                                <span class="icon text-white">
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                                <span class="text">Back</span>
                            </a>
                            <button type="submit" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Update</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>