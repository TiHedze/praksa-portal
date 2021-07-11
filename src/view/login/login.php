<?php
$title = "Login";
require_once __DIR__ . "/../core/_header.php";
if(isset($error) && $error === true)
{
    require_once __DIR__ . "/login.error.php";
} 
?>
<div class="container w-25">
    <div class="card mt-5 rounded-4">
        <div class="card-header bg-primary">
            <h2 class="card-title">Login</h2>
        </div>
        <div class="card-body">
            <form action="index.php?rt=login/login" method="POST" class="needs-validation">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" class="form-control" name="username" type="text" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label mt-2">Password</label>
                    <input id="password" class="form-control" name="password" type="password" required>
                </div>
                <div class="d-flex flex-row justify-content-between">
                    <div class="col-5 col-md-7">
                        <button type="submit" class="btn bg-primary">Login</button>
                    </div>
                    <div class="col-7 col-md-5">
                    <ul class="list-group">
                    <li class="list-group-item">
                        <a class="card-link" id="register" href="" class="card-link">Sign up for students</a>
                        </li>
                        <li class="list-group-item">
                        <a class="card-link" id="register_company" href="" class="card-link">Sign up for companies</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </form>
            <script>
                const redirect = document.getElementById('register');
                redirect.setAttribute('href', `${window.location}view/register/register.php`);
                
                const forms = document.querySelectorAll('needs-validation');

                const redirect = document.getElementById('register_company');
                redirect.setAttribute('href', `${window.location}view/register/company_register.php`);
                
                const forms = document.querySelectorAll('needs-validation');
                
                forms.forEach(form => form.addEventListener('submit', (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false));
            </script>
        </div>
    </div>
</div>
<?php require_once __DIR__ . "/../core/_footer.php"; ?>