<section class="wrapper bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col m-0 p-0">
                <iframe class="w-100" src="<?= $configs['map']; ?>" frameborder="0" style="min-height:400px;" allowfullscreen></iframe>
                <!-- <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13418.053505985636!2d102.73091284411659!3d0.9995695521376537!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x956d9160fe3b9754!2sAMIK+Selat+Panjang!5e0!3m2!1sid!2sid!4v1495599917161" frameborder="0" style="min-height:400px;" allowfullscreen></iframe> -->
            </div>
        </div>
    </div>
</section>

<footer class="wrapper py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <small>Copyright &copy; <?= date('Y'); ?></small>
                <a class="text-body font-weight-bold" href="<?= base_url(''); ?>">
                    <div><?= $configs['copyright']; ?></div>
                </a>
                <small>Powered by-<i><?= $configs['powered']; ?></i></small>
            </div>
            <div class="col-md-3">
                <div class="footer-heading">Follow Us</div>
                <ul class="icon-sosmed-rotate">
                    <li><a href="https://www.facebook.com/" target="_blank"><i class="fa-fw fa-2xx fab fa-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/" target="_blank"><i class="fa-fw fa-2xx fab fa-instagram"></i></a></li>
                    <li><a href="https://www.youtube.com/" target="_blank"><i class="fa-fw fa-2xx fab fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="<?= base_url(''); ?>assets/js/jquery-3.4.1.min.js"></script>
<script src="<?= base_url(''); ?>assets/js/popper.min.js"></script>
<script src="<?= base_url(''); ?>assets/bootstrap4/js/bootstrap.min.js"></script>
</body>

</html>