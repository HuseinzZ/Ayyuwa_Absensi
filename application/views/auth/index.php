<div class="container vh-100 d-flex flex-column justify-content-start mt-4 justify-content-lg-center mt-lg-0 align-items-center">

  <div class="login-card p-5 text-center" style="max-width: 450px; width: 100%;">
    <a href="https://share.google/UMIjpeyn1IW6l9pPA">
      <img src="<?= base_url('assets/img/1.png') ?>" alt="Logo Ayyuwa" width="100" class="mb-3">
    </a>
    <h5 class="fw-bold mb-4">LOGIN ABSENSI</h5>

    <!-- Flash message -->
    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('auth'); ?>" method="post">
      <div class="mb-3 text-start">
        <label for="username" class="form-label text-secondary fw-bold" style="font-size: 0.9rem;">
          Username <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username" required>
        <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
      </div>
      <div class="mb-3 text-start">
        <label for="password" class="form-label text-secondary fw-bold" style="font-size: 0.9rem;">
          Password <span class="text-danger">*</span>
        </label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password" required>
        <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
      </div>
      <div class="d-grid mt-4">
        <button type="submit" class="btn btn-primary">Log In</button>
      </div>
    </form>
  </div>

  <div class="mt-3">
    <p class="text-secondary text-center mb-0" style="font-size: 0.8rem;">
      <span>&copy; TOKO KURMA AYYUWA 2025</span>
    </p>
  </div>
</div>