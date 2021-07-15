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
         <?php 
            if( isset($_SESSION['cname'])) {
                require_once __DIR__ . '/../../model/company/company.service.php';
                $students = CompanyService::getInstance()->getAppliedStudents($ad->id, $_SESSION['cid']);
                if(count($students) > 0)
                {
                    echo '<ul>';
                        foreach ($students as $student)
                            echo '<li>' . $student->name . ' ' . $student->lastname . '</li>';
                    echo '</ul>';
                }
            }
         ?>
    </div>
</div>