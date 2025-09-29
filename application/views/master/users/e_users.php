<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Account</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('master/e_users/' . $user['username']); ?>" method="POST">

                        <div class="form-group row">
                            <label for="u_username" class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control"
                                    id="u_username"
                                    name="u_username"
                                    value="<?= $user['username']; ?>"
                                    readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="u_password" class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="u_password" name="u_password">
                                <?= form_error('u_password', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="u_password2" class="col-sm-4 col-form-label">Repeat New Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="u_password2" name="u_password2">
                                <?= form_error('u_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('master/users'); ?>" class="btn btn-secondary btn-icon-split">
                                <span class="icon text-white">
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                                <span class="text">Back</span>
                            </a>
                            <button type="submit" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Update Password</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>