<?php
$title = "Company login";
require_once __DIR__ . "/../core/_header.php";
if(isset($error) && $error === true )
{
    require_once __DIR__ . "/login.error.php";
}
?>

<div class = "container w-25">
    <div class = "card mt-5 rounded-4">
        <div class="card-header bg-primary">
            <h2 class = "card-title">Company login</h2>
        </div>
        <div class="card-body">
            <form action="./../../index.php?rt=companyLogin/companyLogin" method = "POST" 
            class= "needs-validation">
                <div class="mb-3">
                    <label for="name" class="form-label">Name of the company:</label>
                    <input id="name" class="form-control" name ="name" type="text" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input id="password" class="form-control" name ="password" type="password" required>
                </div>

                <div class="d-flex flex-row justify-content-between">
                    <div class="col-5 col-md-7">
                        <button type="submit" class="btn bg-primary">Login</button>
                        <br>
                        <br>
                        <a class="card-link" id="login" href="./../login/login.php">Student login</a>
                    </div>
                    <div class="col-7 col-md-5">
                    <ul class="list-group">
                    <li class="list-group-item">
                        <a class="card-link" id="register" href="./../register/register.php" class="card-link">Sign up for students</a>
                        </li>
                        <li class="list-group-item">
                        <a class="card-link" id="register_company" href="./../companyRegister/companyRegister.php" class="card-link">Sign up for companies</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </form>

            <script>
                const redirect = document.getElementById('registerCompany');
                //redirect.setAttribute('href', `${window.location}view/register/company_register.php`);
                
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