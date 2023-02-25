<main class="auth">
    <h2 class="auth__heading"><?php echo $title; ?></h2>
    <p class="auth__text">Recupera tu cuenta de DevWebCamp</p>

    <?php require_once __DIR__ . '/../templates/alerts.php'; ?>

    <form action="<?php echo $_ENV['HOST'];?>identify" class="form" method="POST">
        <div class="form__block">
            <label for="email" class="form__label">Correo</label>
            <input 
                type="email"
                class="form__input"
                placeholder="Correo electrónico"
                id="email"
                name="email"
            />
        </div><!-- form__block -->

        <input type="submit" value="Buscar" class="form__submit">
    </form><!-- form -->

    <div class="actions">
        <a href="<?php echo $_ENV['HOST'];?>create" class="actions__link">¿Aún no tienes cuenta? Crea una</a>
        <a href="<?php echo $_ENV['HOST'];?>login" class="actions__link">¿Ya tiene una cuenta? Inicia sesíon</a>
    </div>
</main>