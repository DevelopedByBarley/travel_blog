<div class="container">
    <div class="row">
        <div class="col">
            <h1>Bakancslista hozzáadása</h1>
            <form action="/admin/bucket-new" method="POST" enctype="multipart/form-data">
                <div class="form-outline mb-4">
                    <input type="text" id="form1Example1" class="form-control" placeholder="Cím" name="title" />
                </div>

                <div class="form-outline mb-4">
                    <input type="file" id="form1Example2" class="form-control" name="file" />
                </div>


                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Hozzáadás</button>
            </form>
        </div>
    </div>
</div>