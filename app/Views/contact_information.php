<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1>Contact Information</h1>
    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Lokasi</h3>
            <p>Perk Tomang Tol Raya Bl A-1/4<br>DKI Jakarta, Jakarta, Indonesia<br>11520</p>
            <h3>Email</h3>
            <p>futurehotel@email.com</p>
            <h3>Nomor Telepon </h3>
            <p>+62 823 4567 890</p>
        </div>
        <div class="col-md-6">
            <h3>Jam Kerja</h3>
            <p>Senin - Jumat: 09.00 - 17.00<br>Sabtu: 10.00 - 16.00<br>Minggu: Tutup</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>