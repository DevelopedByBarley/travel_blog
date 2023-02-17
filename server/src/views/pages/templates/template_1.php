
<br><br>
<div class="container-fluid" id="template_1-container" style="min-height: 200vh">
    <header class="header mb-5" style="background: url('../../../public/images/<?= unserialize($params["trip"]["images"])[0] ?>') center center; background-size: cover;">
        <h1 class="bg-dark text-light" id="header-content-title"><?= $params["trip"]["title"] ?></h1>
    </header>
    
    <h3 class="bg-light border rounded p-5 mt-5 mb-5" id="content-description"><?= $params["trip"]["description"] ?></h3>
    <?php echo "<pre>"; var_dump($params["tripContents"]) ?>

    

</div>
