<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1>About Us</h1>
    <div class="row">
        <div class="col-md-6">
            <img src="https://example.com/about_us_image.jpg" class="img-fluid" alt="About Us Image">
        </div>
        <div class="col-md-6">
            <h3>Our Mission</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel ligula vitae purus gravida laoreet. Curabitur luctus nunc vel odio maximus, vel dignissim neque tincidunt. Fusce sit amet sapien tristique, fringilla nunc id, suscipit arcu.</p>
            <h3>Our Vision</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel ligula vitae purus gravida laoreet. Curabitur luctus nunc vel odio maximus, vel dignissim neque tincidunt. Fusce sit amet sapien tristique, fringilla nunc id, suscipit arcu.</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>