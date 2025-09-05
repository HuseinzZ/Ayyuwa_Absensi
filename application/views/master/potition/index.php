        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Data Table Department-->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">DataTables Department</h6>
                    <a href="<?= base_url('master/a_dept'); ?>" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text">Add</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Department Name</th>
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
                                            <a href="<?= base_url('master/e_dept/') . $ptt['id'] ?>" class="btn btn-warning btn-circle">
                                                <span class="icon text-white" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </a> |
                                            <a href="<?= base_url('master/d_dept/') . $ptt['id'] ?>" class="btn btn-danger btn-circle" onclick="return confirm('Deleted Department will lost forever. Still want to delete?')">
                                                <span class="icon text-white" title="Delete">
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