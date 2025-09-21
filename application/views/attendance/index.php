<div class="container">
    <h3>Absensi Hari Ini</h3>
    <?= $this->session->flashdata('message'); ?>

    <?php if (!$attendance): ?>
        <form method="post" action="<?= base_url('attendance/do_attendance'); ?>">
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <button type="submit" class="btn btn-success">Absen</button>
        </form>
    <?php elseif ($attendance && !$attendance['check_out']): ?>
        <p>Jam Masuk: <?= $attendance['check_in']; ?> (<?= $attendance['status_in']; ?>)</p>
        <form method="post" action="<?= base_url('attendance/do_attendance'); ?>">
            <button type="submit" class="btn btn-danger">Absen Pulang</button>
        </form>
    <?php else: ?>
        <p>Jam Masuk: <?= $attendance['check_in']; ?> (<?= $attendance['status_in']; ?>)</p>
        <p>Jam Pulang: <?= $attendance['check_out']; ?> (<?= $attendance['status_out']; ?>)</p>
        <span class="badge bg-success">Absensi Selesai</span>
    <?php endif; ?>
</div>

<script>
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
        });
    }
</script>