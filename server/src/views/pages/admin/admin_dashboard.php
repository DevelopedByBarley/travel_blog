<nav id="admin-navbar" class="navbar navbar-expand-md bg-light border">
    <div class="container-fluid navbar-container">
        <button class="navbar-toggler btn btn-outline-danger border" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            Admin
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active text-dark" aria-current="page" href="/admin/profile">Profil</a>
                <a class="nav-link active text-dark" aria-current="page" href="/admin/trips">Útazások</a>
                <a class="nav-link active text-dark" aria-current="page" href="/admin/new-trip">Új utazás hozzáadása
                    <span>
                        <i class="text-info disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z" />
                            </svg>
                        </i>
                    </span>
                </a>
                <a class="nav-link active" aria-current="page" href="/admin/bucketList">Bakancslista</a>
                <a class="nav-link active text-dark" aria-current="page" href="/admin/bucket-form">Új Bakancslista hozzáadása
                    <span>
                        <i class="text-info disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z" />
                            </svg>
                        </i>
                    </span>
                </a>
                <a class="nav-link bg-danger text-light disabled" href="/admin/emails">Emailek &nbsp;
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-mailbox2" viewBox="0 0 16 16">
                            <path d="M9 8.5h2.793l.853.854A.5.5 0 0 0 13 9.5h1a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5H9v1z" />
                            <path d="M12 3H4a4 4 0 0 0-4 4v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7a4 4 0 0 0-4-4zM8 7a3.99 3.99 0 0 0-1.354-3H12a3 3 0 0 1 3 3v6H8V7zm-3.415.157C4.42 7.087 4.218 7 4 7c-.218 0-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0c0 .334-.164.264-.415.157z" />
                        </svg>
                    </span>
                </a>
                <a href="/admin/logout" class="mt-5">
                    <button class="btn btn-danger text-light">Kijelentkezés</button>
                </a>
            </div>
        </div>
    </div>
</nav>
<br><br>
<h1 class="text-center">Üdvözöllek az admin felületen!</h1>
<br><br>
<div id="inner-container">
    <?php echo $params["innerContent"] ?? "" ?>
</div>