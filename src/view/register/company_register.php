<?php
$title = "Register";
require_once __DIR__ . '/../core/_header.php';

if (isset($error) && $error === true) {
    require_once __DIR__ . "/../login/login.error.php";
}
?>
<div class="container w-25">
    <div class="card mt-5 rounded-4">
        <div class="card-header bg-primary">
            <h2 class="card-title">Sign Up</h2>
        </div>
        <div class="card-body">
            <form action="./../../index.php?rt=company_login/company_login" method="POST" class="needs-validation">
                <div class="mb-3">
                    <label for="name" class="form-label">Name of the company</label>
                    <input id="name" class="form-control" name="name" type="text" required>
                </div>
                <div class="mb-3">
                    <label for="owner" class="form-label">Owner</label>
                    <input id="owner" class="form-control" name="owner" type="text" required>
                </div>
                <div class="mb-3">
                    <label for="oib" class="form-label">Company OIB</label>
                    <input id="oib" class="form-control" name="oib" type="text" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">e-mail</label>
                    <input id="email" class="form-control" name="email" type="text" required>
                </div>
                <div class="mb-3">
                    <label for="industry" class="form-label">Industry</label>
                    <input id="industry" class="form-control" name="industry" type="text" required>
                </div>
                <div class="mb-3">
                    <label for="employees" class="form-label">Number of employees</label>
                    <input id="employees" class="form-control" name="employees" type="text" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label mt-2">Password</label>
                    <input id="password" class="form-control" name="password" type="password" required>
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="form-label mt-2">Confirm your password</label>
                    <input id="password-confirm" class="form-control" type="password" required>
                </div>
                <button id="submit" type="submit" class="btn bg-primary">Sign up</button>
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const pass = document.getElementById('password');
                    const passConfirm = document.getElementById('password-confirm');
                    const btn = document.getElementById('submit');
                    btn.disabled = true;

                    const forms = document.querySelectorAll('needs-validation');
                    forms.forEach(form => form.addEventListener('submit', (event) => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false));

                    passConfirm.addEventListener('keyup', (event) => {
                        btn.disabled = true;
                        if (event.target.value === pass.value) {
                            btn.disabled = false;
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../core/_footer.php"; ?>