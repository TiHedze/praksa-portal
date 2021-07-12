<?php require_once __DIR__ . "/../core/_header.php";
require_once __DIR__ . "/../core/navbar.php";?>


<div class="card" id=; ?>
    <div class="card-body">
        <h5 class="card-title">Upotpuni svoj profil: </h5>
            <form action="index.php?rt=user/profil" method="post">
                <div class="mb-3">
                    <label for="age" class="form-label">Age:</label>
                    <input id="age" class="form-control" name="age" type="text">
                </div>
                <div class="mb-3">
                    <label for="college" class="form-label">College:</label>
                    <input id="college" class="form-control" name="college" type="text">
                </div>
                <div class="mb-3">
                    <label for="grades" class="form-label">Grades average:</label>
                    <input id="grades" class="form-control" name="grades" type="text">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">e-mail:</label>
                    <input id="email" class="form-control" name="email" type="text">
                </div>
                <button class="btn bg-primary" type="submit">Dodaj!</button>
            </form>
    </div>
</div>

<?php require_once __DIR__ . "/../core/_footer.php"; ?>
