        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Data Table Users-->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">DataTables Users</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Potition</th>
                                    <th>Username</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data as $dt) :
                                ?>
                                    <tr>
                                        <td class=" align-middle"><?= $i++; ?></td>
                                        <td class=" align-middle"><?= $dt['e_id']; ?></td>
                                        <td class=" align-middle"><?= $dt['e_name']; ?></td>
                                        <td class=" align-middle"><?= $dt['d_id']; ?></td>
                                        <?php
                                        if ($dt['u_username']) : ?>
                                            <td class=" align-middle text-center">
                                                <?= $dt['u_username']; ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="<?= base_url('master/e_users/') . $dt['u_username'] ?>" class="btn btn-warning btn-icon-split btn-sm ">
                                                    <span class="icon text-white" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </a>
                                                <a href="<?= base_url('master/d_users/') . $dt['u_username'] ?>" class="btn btn-danger btn-icon-split btn-sm ml-2" onclick="return confirm('Deleted Users will lost forever. Still want to delete?')">
                                                    <span class="icon text-white" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        <?php else : ?>
                                            <td class=" align-middle text-center">
                                                <a href="<?= base_url('master/a_users/') . $dt['e_id'] . '/' . $dt['d_id']; ?>" class="btn btn-primary">Create Account</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <button class="btn btn-warning btn-icon-split btn-sm" disabled>
                                                    <span class="icon text-white" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </button>
                                                <button class="btn btn-danger btn-icon-split btn-sm ml-2" disabled>
                                                    <span class="icon text-white" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </span>
                                                </button>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        </div>