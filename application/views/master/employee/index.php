        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Data Table Employee-->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">DataTables Employee</h6>
                    <a href="<?= base_url('master/a_employee'); ?>" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text">Add new employee</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Gender</th>
                                    <th>Image</th>
                                    <th>Birth Date</th>
                                    <th>Hire Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($employee as $emp) :
                                ?>
                                    <tr>
                                        <td class="align-middle"><?= $i++; ?></td>
                                        <td class="align-middle"><?= $emp['name']; ?></td>
                                        <td class="align-middle"><?= $emp['potition_id']; ?></td>
                                        <td class="align-middle"><?php if ($emp['gender'] == 'M') {
                                                                        echo 'Male';
                                                                    } else {
                                                                        echo 'Female';
                                                                    }; ?></td>
                                        <td class="text-center"><img src="<?= base_url('assets/img/profile/') . $emp['image']; ?>" style="width: 70px; height: 70px; object-fit: cover; object-position: top;" class="img-rounded"></td>
                                        <td class="align-middle"><?= date('d-m-Y', strtotime($emp['birth_date'])); ?></td>
                                        <td class="align-middle"><?= date('d-m-Y', strtotime($emp['hire_date'])); ?></td>
                                        <td class="align-middle text-center">
                                            <a href="<?= base_url('master/e_employee/') . $emp['id'] ?>" class="btn btn-warning btn-icon-split btn-sm">
                                                <span class="icon text-white">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </a>
                                            <a href="<?= base_url('master/d_employee/') . $emp['id'] ?>" class="btn btn-danger btn-icon-split btn-sm ml-2" onclick="return confirm('Deleted employee will be lost forever. Still want to delete?')">
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
        </div>