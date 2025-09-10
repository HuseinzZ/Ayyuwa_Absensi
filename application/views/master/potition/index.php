        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Data Table Potition-->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">DataTables Potition</h6>
                    <a href="<?= base_url('master/a_potition'); ?>" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text">Add new potition</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Potition Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($potition as $ptt) :
                                ?>
                                    <tr>
                                        <td class="align-middle"><?= $i++; ?></td>
                                        <td class="align-middle"><?= $ptt['id']; ?></td>
                                        <td class="align-middle"><?= $ptt['name']; ?></td>
                                        <td class="align-middle text-center">
                                            <a href="<?= base_url('master/e_potition/') . $ptt['id'] ?>" class="btn btn-warning btn-icon-split btn-sm">
                                                <span class="icon text-white">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </a>
                                            <a href="<?= base_url('master/d_potition/') . $ptt['id'] ?>" class="btn btn-danger btn-icon-split btn-sm ml-2" onclick="return confirm('Deleted Potition will lost forever. Still want to delete?')">
                                                <span class="icon text-white">
                                                    <i class="fas fa-trash-alt"></i>
                                                </span>
                                            </a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->