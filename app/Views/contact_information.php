<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1>Contact Information</h1>
    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Location</h3>
            <p>123 Example Street<br>City, State, Country<br>Postal Code</p>
            <h3>Email</h3>
            <p>info@example.com</p>
            <h3>Phone</h3>
            <p>+1 123-456-7890</p>
        </div>
        <div class="col-md-6">
            <h3>Working Hours</h3>
            <p>Monday - Friday: 9am - 5pm<br>Saturday: 10am - 4pm<br>Sunday: Closed</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>