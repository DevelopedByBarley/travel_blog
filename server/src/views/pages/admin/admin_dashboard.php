<nav id="admin-navbar" class="navbar navbar-expand-md bg-light border">
    <div class="container-fluid navbar-container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            Menu
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active text-dark" aria-current="page" href="/admin/profile">Profil</a>
                <a class="nav-link active text-dark" aria-current="page" href="/admin/trips">Útazások</a>
                <a class="nav-link active text-dark" aria-current="page" href="/admin/new-trip">Új utazás hozzáadása</a>
                <a class="nav-link text-dark" href="/admin/emails">Emailek</a>
                <a href="/admin/logout" class="mt-5">
                    <button class="btn btn-danger text-light">Logout</button>
                </a>
            </div>
        </div>
    </div>
</nav>
<div id="inner-container">
    <h1 class="m-5">Üdvözöllek az Admin felületen!</h1>
   <?php echo $params["innerContent"] ?? ""?>
</div>