<?php 
$title = "Add new ad";
session_start();

require_once __DIR__ . "/../core/_header.php";
require_once __DIR__ . "/../core/navbar.php";

?>


<div class="card" id=;>
    <div class="card-body">
        <h5 class="card-title">Dodaj oglas za posao:</h5>
            <form action="./../../index.php?rt=ad/addNewAd" method="post">
                <div class="mb-3">
                    <label for="adTitle" class="form-label">Title:</label>
                    <input id="adTitle" class="form-control" name="adTitle" type="text">
                </div>
                <div class="mb-3">
                    <label for="adText" class="form-label">Text:</label>
                    <input id="adText" class="form-control" name="adText" type="text">
                </div>
                <div class="mb-3">
                    <label for="adSalary" class="form-label">Salary:</label>
                    <input id="adSalary" class="form-control" name="adSalary" type="text">
                </div>
                <button  class="btn bg-primary" type="submit">Dodaj!</button>
            </form>
    </div>
</div>

<?php require_once __DIR__ . "/../core/_footer.php"; ?>