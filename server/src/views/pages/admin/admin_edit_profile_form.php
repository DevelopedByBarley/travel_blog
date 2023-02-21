<form action="/admin/profile-edit?prevImage=<?= $params["prevImage"] ?>&id=<?= $params["id"] ?>" method="POST" enctype="multipart/form-data">
    <!-- 2 column grid layout with text inputs for the first and last names -->
    <div class="row mb-4">
        <div class="col">
            <div class="form-outline">
                <input type="text" name="name" id="form3Example1" class="form-control" placeholder="név" required value="<?= $params["profile"]["name"] ?? '' ?>" />
            </div>
        </div>
    </div>

    <div class="form-outline mb-4">
        <input type="email" name="email" id="form3Example3" class="form-control" placeholder="email" required value="<?= $params["profile"]["email"] ?? '' ?>" />
    </div>

    <div class=" form-outline mb-4">
        <input type="number" name="age" id="form3Example4" class="form-control" placeholder="kor" required value="<?= $params["profile"]["age"] ?? '' ?>"/>
    </div>

    <div class=" form-outline mb-4">
        <input type="file" name="file" id="form3Example4" class="form-control" placeholder="kor" required />
    </div>



    <!-- Submit button -->
    <button type=" submit" class="btn btn-primary btn-block mb-4">Szerkesztés</button>
</form>