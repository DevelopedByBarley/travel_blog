<div id="header">
    <div class="profile-image" style="background: url('../../../public/images/<?= $params["profile"]["profileImage"] ?>') center center; background-size: cover;"></div>
    <div class=" header-content text-center">
        <h1><?= $params["profile"]["name"] ?></h1>
    </div>
</div>
<div class="container about-me-container">
    <div class="row mb-5 mt-5">
        <div class="col-sm text-center about-me d-flex align-items-center justify-content-center flex-column">
            <h1>Rólam</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Ex autem, enim quaerat voluptatum provident porro quo soluta,
                reiciendis odio voluptatibus,
                tenetur ipsa! Autem laboriosam, vel iste et eum culpa iure.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Ex autem, enim quaerat voluptatum provident porro quo soluta,
                reiciendis odio voluptatibus,
                tenetur ipsa! Autem laboriosam, vel iste et eum culpa iure.
            </p>
        </div>
    </div>
</div>
<div id="latest-trips-container">
    <div class="row latest-trips">
        <div class="col-sm-5 d-flex align-items-center justify-content-center flex-column p-5 latest-trips-description">
            <h1 class="mb-5">Legutóbbi Élményeim</h1>
            <p class="text-center">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                Animi totam nisi minus odit harum asperiores
                tempore aspernatur neque inventore mollitia recusandae
                dolores in obcaecati quisquam aut, fuga excepturi ex qui.
            </p>
        </div>
        <div class="col-sm-7 latest-trips-carousel">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" style="min-height: 500px">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <?php foreach ($params["carouselTrips"] as $index => $trip) : ?>
                        <a href="/trip-single?id=<?= $trip["id"] ?>">
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" style="background: url('../../../public/images/<?= unserialize($params["trips"][$index]["images"])[0] ?>') center center; background-size: cover;">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><?= $trip["title"] ?></h5>
                                    <p><?= $trip["description"] ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>






<div id="trips-container" class="container-fluid p-5 bg-dark d-flex flex-column align-items-center justify-content-center" style="min-height: 500px">
    <h1 class="text-light text-center mt-5">Ahová még utaztam.</h1>
    <div class="row mt-5 trips ">
        <?php foreach ($params["anotherTrips"] as $index => $trip) : ?>
            <div class="col-md-4 col-lg-2 mb-5 d-flex flex-column align-items-center justify-content-center">
                <div class="card">
                    <div class="card-image" style="background: url('../../../public/images/<?= unserialize($params["trips"][$index]["images"])[0] ?>') center center; background-size: cover;"></div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $trip["title"] ?></h5>
                        <p class="card-text"><?= $trip["description"] ?></p>
                        <a href="/trip-single?id=<?= $trip["id"] ?>" class="btn btn-info text-l">Megtekintés</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <a href="/trip-list">
        <button class="btn btn-outline-info text-light">További utak</button>
    </a>
</div>


<div id="bucket-list-container" class="container" style="min-height: 500px;">
    <div class="planned-trips mt-5 row">
        <h1 class="text-center mt-5">Bakancslista</h1>
        <p class="text-center mb-5">Amerre még nem jártam.</p>
        <?php foreach ($params["bucketList"] as $index => $listItem) : ?>
            <div class="col-sm-4 d-flex flex-column align-items-center justify-content-center mb-5">
                <div class="img-bubble" style="background: url('../../../public/images/<?= $listItem["bucketImage"] ?>') center center; background-size: cover;"></div>
                <div class="content mt-3">
                    <h3><?= $listItem["title"] ?></h3>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<div id="contact-me-container" class="container mt-5 bg-dark text-light p-5">
    <div class="row">
        <div class="col-sm-6 content d-flex flex-column align-items-center justify-content-center">
            <h1>Ha van egy jó tipped, vedd fel velem a kapcsolatod!</h1>
        </div>
        <div class="col-sm-6 form">
            <form>
                <!-- Name input -->
                <div class="form-outline mb-4">
                    <input type="text" id="form4Example1" class="form-control" placeholder="Név" />
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="form4Example2" class="form-control" placeholder="Email" />
                </div>

                <!-- Message input -->
                <div class="form-outline mb-4">
                    <textarea class="form-control" id="form4Example3" rows="4" placeholder="Üzenet..."></textarea>
                </div>


                <!-- Submit button -->
                <button type="submit" class="btn btn-outline-info btn-block text-light mb-4">Küldés</button>
            </form>
        </div>
    </div>
</div>