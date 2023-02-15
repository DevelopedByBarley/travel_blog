
<?php if (isset($params["isLoginFailed"])) : ?>
    <div class="alert alert-danger" role="alert">
        Email vagy jelszó nem létezik!
    </div>
<?php endif ?>

<div class="d-flex flex-column align-items-center  justify-content-center" id="admin-form-container">
    <h1>Admin</h1>
    <form action="/admin-login" method="POST" class="m-5 p-5 text-center" id="admin-form">
        <!-- Email input -->
        <div class="form-outline mb-3">
            <input type="email" id="form2Example1" class="form-control" placeholder="email" name="email" />
            <?php if (!empty($params["errorMessages"]["email"])) : ?>
                <?php foreach ($params["errorMessages"]["email"] as $error) : ?>
                    <p class="text-danger"><?= $error ?></p>
                <?php endforeach ?>
            <?php endif ?>
        </div>

        <!-- Password input -->
        <div class="form-outline  mb-4">
            <input type="password" id="form2Example2" class="form-control" placeholder="password" name="password" />
            <?php if (!empty($params["errorMessages"]["password"])) : ?>
                <?php foreach ($params["errorMessages"]["password"] as $error) : ?>
                    <p class="text-danger"><?= $error ?></p>
                <?php endforeach ?>
            <?php endif ?>
        </div>

        <button type="submit" class="btn btn-outline-info">Bejelentkezés</button>

    </form>

</div>