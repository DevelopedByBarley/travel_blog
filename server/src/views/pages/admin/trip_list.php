<div id="trip-list-container" class="container-fluid">
    <h1>Utazások Listája!</h1>
    <div class="row">
        <?php foreach ($params["trips"] as $trip) : ?>
            <div class="col col-md-6 col-lg-3">
                <div class="card text-center">
                    <div class="card-image" style="background: url('../../../public/images/<?= unserialize($trip["images"])[0] ?>') center center; background-size: cover; height: 300px"></div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $trip["title"] ?></h5>
                        <p class="card-text"><?= $trip["description"] ?></p>
                        <a href="#" class="btn btn-primary m-1">Megtekintés</a>
                        <a href="#" class="btn btn-warning m-1">Szerkesztés</a>
                        <a href="#" class="btn btn-danger m-1">Törlés</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>