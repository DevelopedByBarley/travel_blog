<form action="/admin/profile-edit?prevImage=<?= $params["prevImage"] ?>&id=<?= $params["id"] ?>" method="POST" enctype="multipart/form-data">
    <!-- 2 column grid layout with text inputs for the first and last names -->
    <div class="row mb-4">
        <div class="col">
            <div class="form-outline">
                <input type="text" name="name" id="form3Example1" class="form-control" placeholder="név" />
            </div>
        </div>
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" name="email" id="form3Example3" class="form-control" placeholder="email" />
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="number" name="age" id="form3Example4" class="form-control" placeholder="kor" />
    </div>

    <div class="form-outline mb-4">
        <input type="file" name="file" id="form3Example4" class="form-control" placeholder="kor" />
    </div>



    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Szerkesztés</button>
</form>