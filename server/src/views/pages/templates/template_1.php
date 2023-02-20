<br><br>



<div class="container-fluid" id="template_1-container">
    <h1 class="bg-dark text-light m-2" id="header-content-title"><?= $params["trip"]["title"] ?></h1>
    <header class="header mb-3" style="background: url('../../../public/images/<?= unserialize($params["trip"]["images"])[0] ?>') center center; background-size: cover;">
    </header>
    <h4 class="bg-light">Utazás időpontja: <?= date('m/d/Y', $params["trip"]["time"]) ?></h4>
    <h3 class="bg-light border rounded p-5" id="content-description"><?= $params["trip"]["description"] ?></h3>

    <?php if (!empty($params["tripContents"][0])) : ?>
        <div class="mb-5 row first-row">
            <div class="col-lg-6 p-5 d-flex justify-content-center  flex-column">
                <h1 class="mb-5"><?= $params["tripContents"][0]["title"] ?></h1>
                <?php foreach ($params["tripContents"][0]["paragraphs"] as $paragraph) : ?>
                    <p><?= $paragraph ?></p>
                <?php endforeach ?>
            </div>
            <div class="col-lg-6 image first-image" style="background: url('../../../public/images/<?= unserialize($params["trip"]["images"])[1] ?? 'forest.jpg' ?>') no-repeat center center; background-size: cover;"></div>
        </div>
    <?php endif ?>
    <br><br>
    <?php if (!empty($params["tripContents"][1])) : ?>
        <div class="row second-row mt-5 text-light bg-dark">
            <div class="col p-5 text-center">
                <h1 class="mb-5"><?= $params["tripContents"][1]["title"] ?></h1>
                <?php foreach ($params["tripContents"][1]["paragraphs"] as $paragraph) : ?>
                    <p><?= $paragraph ?></p>
                <?php endforeach ?>
            </div>
            <div class="second-image image" style="background: url('../../../public/images/<?= unserialize($params["trip"]["images"])[2] ?? 'forest.jpg' ?>') center center; background-size: cover;"></div>
        </div>
    <?php endif ?>
    <br><br><br>
    <?php if (!empty($params["tripContents"][2])) : ?>
        <div class="mb-5 mt-5 row first-row">
            <div class="col-lg-6 image first-image" style="background: url('../../../public/images/<?= unserialize($params["trip"]["images"])[3] ?? 'forest.jpg' ?>') no-repeat center center; background-size: cover;"></div>
            <div class="col-lg-6 p-5 d-flex justify-content-center  flex-column">
                <h1 class="mb-5"><?= $params["tripContents"][2]["title"] ?></h1>
                <?php foreach ($params["tripContents"][2]["paragraphs"] as $paragraph) : ?>
                    <p><?= $paragraph ?></p>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif ?>

    <div class="summary-container row">
        <div class="col">
            <h1 class="bg-dark text-light p-4 d-inline-block m-5 mb-0">Összegzés</h1>
            <p class="summary border rounded p-5">
                <?= $params["trip"]["summary"] ?>
            </p>
        </div>
    </div>



    <div class="rating-container row">
        <div class="col text-center">
            <h1 class="border">Értékelés</h1>
            <?php foreach ($params["ratings"]["stars"] as $star) : ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="mt-5 bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg>
            <?php endforeach ?>
            <h3 class="bg-info text-light mt-5 p-5"><?= $params["ratings"]["message"] ?></h3>
        </div>
    </div>

</div>