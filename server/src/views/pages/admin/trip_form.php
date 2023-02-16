<div class="container-fluid">
	<h1>Új utazás hozzáadása!</h1>
	<form action="/admin/add-trip?id=<?= $params["adminId"] ?>" method="POST" enctype="multipart/form-data" class="w-100">
		<div class="form-outline mb-4">
			<input type="text" id="form4Example1" class="form-control" name="title" placeholder="Cím" />
		</div>
		<div class="form-outline mb-4">
			<input type="text" id="form4Example2" class="form-control" name="description" placeholder="Leírás" />
		</div>

		<label>Tartalom hozzáadása(max 3)</label>
		<button class="btn btn-outline-primary m-2" onclick="addContentField(event)">
			<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
				<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
				<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
			</svg>
		</button>
		<div id="content-container">
			<div id="content-template" data-id=0 ">
			</div>
		</div>

				<label for=" date">Utazás időpontja</label>
				<input id="date" class="form-control" type="date" name="time" />
				<div class="files">
					<input type="file" name="files[]" class="m-2 mt-5" multiple class="form-control" />
				</div>
				<br>

				<select class="form-select mb-5" aria-label="Default select example" name="ratings">
					<option selected disabled>Utazás értékelése</option>
					<option value="1">Rossz élmény, senkinek sem ajánlom...</option>
					<option value="2">Rossz volt, de rosszabbúl is járhattam volna</option>
					<option value="3">Nem volt rossz, de ha ván más választásod nem ajánlanám!</option>
					<option value="4">Kellemes élmény volt, menj el ha van rá lehetőséged!</option>
					<option value="4">Nagyszerű élmény volt, mindenképp menj el!!</option>
				</select>


				<!-- Submit button -->
				<button type="submit" class="btn btn-primary btn-block mb-4">Út mentése</button>
	</form>
</div>

<script type="text/javascript" src="../../../public/js/trip_form.js"></script>