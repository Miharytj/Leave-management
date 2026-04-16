<?php
include 'entete.php';
?>

<div class="home-content2">
    <div class="overview-boxes2">
        <div class="box2">
        <ul class="nav-links3">
            <li>
                <a href="typeconge.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="ttypeconge.php" ? "active" : "" ?> ">
                    <i class="bx bx-calendar"></i>
                    <span class="links_name">Type de congé</span>
                </a>
            </li>
            <li>
                <a href="jourf.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="jourf.php" ? "active" : "" ?> ">
                    <i class="bx bx-calendar-star"></i>
                    <span class="links_name">Liste des jours feries</span>
                </a>
            </li>
            <li>
                <a href="admin.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="admin.php" ? "active" : "" ?> ">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Admin</span>
                </a>
            </li>
            <li>
                <a href="apropos.php" class="<?php echo basename($_SERVER['PHP_SELF'])=="apropos.php" ? "active" : "" ?> ">
                    <i class="bx bx-info-circle"></i>
                    <span class="links_name">A propos</span>
                </a>
            </li>
            
        </ul>

        </div>
    </div>
</div>
</section>

<?php
include 'enpied.php';
?>