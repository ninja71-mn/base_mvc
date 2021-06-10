<footer>
    <a class="nav-link" href="<?= URLROOT ?>"><img class="nav-logo-img" src="<?= URLROOT ?>/img/oblivion_logo.png" alt="">
    </a>
    <div class="navbar-nav ml-auto mr-auto" dir="ltr" style="display: inline-block">

            <a class="nav-link" href="<?= URLROOT ?>/#about" style="font-weight: normal;display: inline-block;"
              > ABOUT US <span style="padding: 0 10px;">|</span> </a>

            <a class="nav-link" href="<?= URLROOT ?>/#apply" style="font-weight: normal;display: inline-block;"
              > APPLY HERE <span style="padding: 0 10px;">|</span> </a>

            <a class="nav-link" href="<?= URLROOT ?>/#shop" style="font-weight: normal;display: inline-block;"
              > SHOP <span style="padding: 0 10px;">|</span> </a>

            <a class="nav-link" href="https://discord.gg/oblivionboost" style="font-weight: normal;display: inline-block;"
              > CONTACT US</a>


    </div>
    <br>
    <p style="font-size: 12px;color: #fff">©2004 Blizzard Entertainment, Inc. All rights reserved. World of Warcraft, Warcraft and Blizzard Entertainment are trademarks or registered trademarks of Blizzard Entertainment, Inc. in the U.S. and/or other countries.
        <br>
    This is a fan site and we are not affiliated in any kind with Blizzard Entertainment. <br>
        All services provided by Oblivion Boosting can only be <span style="color:#fff">bought with in-game currency (gold)</span>.</p>
</footer>
<?php
if (isset($_SESSION['csrf_token'])) {
    ?>
    <input type="hidden" value="<?php echo $_SESSION['csrf_token']; ?>" name="token">
    <?php
} else {
    ?>
    <input type="hidden" value="" name="token">
    <?php
}
?>

<script src="<?=URLROOT?>/js/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/71bbc1392d.js" crossorigin="anonymous"></script>
<script src="<?= URLROOT ?>/js/bootstrap.min.js"></script>
<script src="<?= URLROOT ?>/js/js.js"></script>
</body>
</html>

