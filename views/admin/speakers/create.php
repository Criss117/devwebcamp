<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container-button">
    <a class="dashboard__button" href="<?php echo $_ENV['HOST'];?>admin/speakers">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__form">
    <?php require_once __DIR__ . '../../../templates/alerts.php'; ?>

    <form method="POST" action="<?php echo $_ENV['HOST'];?>admin/speakers/create" enctype="multipart/form-data" class="form">

        <?php require_once __DIR__ . '/form.php'; ?>
        <input class="form__submit" type="submit" value="Registrar ponente">
    </form>
</div>