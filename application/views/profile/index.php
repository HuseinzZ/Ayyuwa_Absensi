<div class="container-fluid">

    <!-- Spacer Row -->
    <div class="row">
        <div class="col-sm-10 mb-4"></div>
    </div>

    <!-- Profile Card -->
    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <div class="card shadow mb-4" style="min-height: 400px;">
                <div class="card-body d-flex flex-column justify-content-center">

                    <div class="row no-gutters align-items-center">
                        <!-- Profile Image -->
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <img src="<?= base_url('assets/img/profile/') . $account['image']; ?>"
                                alt="<?= $account['name'] ?>'s Profile Picture"
                                class="img-fluid rounded-circle border border-primary p-1"
                                style="width: 180px; height: 180px; object-fit: cover; object-position: top; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                            <h5 class="card-title mt-3 text-gray-800"><?= $account['name'] ?></h5>
                            <p class="card-text text-muted"><?= $account['position_name'] ?></p>
                        </div>

                        <!-- Personal Data -->
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title mb-4 text-gray-800">Data Personal</h4>
                                <table class="table table-sm table-hover table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Employee ID</th>
                                            <td>: <?= $account['id']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Gender</th>
                                            <td>:
                                                <?= ($account['gender'] == 'M') ? 'Male' : 'Female'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Position</th>
                                            <td>: <?= $account['position_name'] ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Birthday</th>
                                            <td>: <?= $account['birth_date']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Joined On</th>
                                            <td>: <?= $account['hire_date'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Personal Data -->

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>