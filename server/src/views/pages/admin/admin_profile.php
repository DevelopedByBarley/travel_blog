<div class="container" id="profile-container">
    <div class="row m-5">
        <div class="col text-center">
            <h1 class="mt-5 mb-5">Profil áttekintése</h1>
            <img src="../../../public/images/<?= $params["admin"]["profileImage"] ?>" alt="" style="height: 300px;">
            <h3>Név:</h3>
            <h5><?= $params["admin"]["name"] ?></h5>
            <h3>Email:</h3>
            <h5><?= $params["admin"]["email"] ?></h5>
            <h3>Életkor:</h3>
            <h5><?= $params["admin"]["age"] ?> éves</h5>
            <h3>Utazások száma:</h3>
            <h5><?= $params["trips"] ?></h5>
            <a href="/admin/profile-edit?prevImage=<?=$params["admin"]["profileImage"]?>">
                <div class="mt-5 btn btn-warning text-light">Profil Szerkesztése</div>
            </a>
        </div>
    </div>
</div>