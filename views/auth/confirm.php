<main class="auth">
    <h2 class="auth__heading"><?php echo $title; ?></h2>
    <p class="auth__text">Tu cuenta DevWebCamp</p>
    <?php require_once __DIR__ . '/../templates/alerts.php'; ?>
    <?php if(isset($alerts['success'])):?>
        <div class="actions--center">
            <a href="<?php echo $_ENV['HOST'];?>login" class="actions__link">Iniciar sesíon</a>
        </div>
    <?php endif; ?>
</main>