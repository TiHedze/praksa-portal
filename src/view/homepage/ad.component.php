<div class="card" id=<?php echo $ad->id; ?>>
    <div class="card-body">
        <h5 class="card-title"><?php echo $ad->title; ?></h5>
        <h6 class="card-subtitle mb-2"><?php echo $ad->companyName; ?></h6>
        <p class="card-text mb-2"><?php echo $ad->text; ?></p>
        <p class="card-text text-muted mb-2"><?php echo $ad->salary; ?></p>
        <button class="btn bg-primary"
        <?php 
            if(!isset($_SESSION['user'])) {
                echo "disabled";
            }
            else {
                echo "value=" . $_SESSION['user']->id;
            }
         ?>>Apply to this position!</button>
    </div>
</div>