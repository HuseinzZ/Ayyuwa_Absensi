        <div class="container-fluid">

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">DataTables Attendance</h6>
                    <a href="<?= base_url('master/a_attendance'); ?>" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text">Add Attendance</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Employee</th>
                                    <th>Check-in</th>
                                    <th>Status In</th>
                                    <th>Check-out</th>
                                    <th>Status Out</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($attendance as $row):
                                ?>
                                    <tr>
                                        <td class="align-middle"><?= $i++; ?></td>
                                        <td class="align-middle"><?= date('d-m-Y', strtotime($row['attendance_date'])); ?></td>
                                        <td class="align-middle"><?= $row['employee_name']; ?></td>
                                        <td class="align-middle"><?= $row['check_in'] ?: '-'; ?></td>
                                        <td class="align-middle"><?= $row['status_in'] ?: '-'; ?></td>
                                        <td class="align-middle"><?= $row['check_out'] ?: '-'; ?></td>
                                        <td class="align-middle"><?= $row['status_out'] ?: '-'; ?></td>
                                        <td class="align-middle">
                                            <?php if ($row['latitude'] && $row['longitude']): ?>
                                                <a href="https://www.google.com/maps/search/?api=1&query=<?= $row['latitude']; ?>,<?= $row['longitude']; ?>"
                                                    target="_blank" class="text-primary">
                                                    View Location
                                                </a>
                                            <?php else: ?> - <?php endif; ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="<?= base_url('master/e_attendance/' . $row['id']); ?>" class="btn btn-warning btn-icon-split btn-sm">
                                                <span class="icon text-white">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </a>
                                            <a href="<?= base_url('master/d_attendance/' . $row['id']); ?>"
                                                onclick="return confirm('Deleted Attendance will lost forever. Still want to delete?');"
                                                class="btn btn-danger btn-icon-split btn-sm ml-2">
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