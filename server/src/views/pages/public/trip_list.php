<div class="container-fluid" style="margin-top: 100px">
    <div class="row mt-5 trips ">
        <?php foreach ($params["trips"] as $index => $trip) : ?>
            <div class="col-md-4 col-lg-2 mb-5 d-flex flex-column align-items-center justify-content-center">
                <div class="card">
                    <div class="card-image" style="background: url('../../../public/images/<?= unserialize($params["trips"][$index]["images"])[0] ?>') center center; background-size: cover; min-height: 250px;"></div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $trip["title"] ?></h5>
                        <p class="card-text"><?= $trip["description"] ?></p>
                        <a href="/trip-single?id=<?= $trip["id"] ?>" class="btn btn-info text-l">Megtekintés</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>