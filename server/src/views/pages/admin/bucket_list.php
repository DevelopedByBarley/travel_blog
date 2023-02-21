<div class="container-fluid">
    <div class="row">
        <?php foreach ($params["bucketList"] as $listItem) : ?>
            <div class="col-sm-4 d-flex flex-column align-items-center justify-content-center mb-5">
                <div class="card" style="width: 18rem;">
                    <div class="card-background" style="background: url('../../../public/images/<?= $listItem["bucketImage"] ?>') center center; background-size: cover; min-height: 250px;"></div>
                    <div class="card-body text-center">
                        <h5 class="card-title text-center"><?= $listItem["title"] ?></h5>
                        <a href="/admin/edit-bucket?id=<?= $listItem["bucketId"] ?>&prevImage=<?= base64_encode($listItem["bucketImage"]) ?>" class="btn btn-warning text-light">Szerkesztés</a>
                        <a href="/admin/delete-bucket?id=<?= $listItem["bucketId"] ?>" class="btn btn-danger">Törlés</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>