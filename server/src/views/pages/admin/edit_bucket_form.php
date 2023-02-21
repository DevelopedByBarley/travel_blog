<div class="container">
    <div class="row">
        <div class="col">
            <h1>Bakancslista hozzáadása</h1>
            <form action="/admin/bucket-edit?id=<?= $params["id"] ?>&prevImage=<?= $params["prevImage"] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-outline mb-4">
                    <input type="text" class="form-control" placeholder="Cím" name="title" required value="<?= $params["bucket"]["title"] ?? '' ?>" />
                </div>

                <div class="form-outline mb-4">
                    <input type="file" class="form-control" name="file" required />
                </div>


                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Hozzáadás</button>
            </form>
        </div>
    </div>
</div>