<main class="auth">
    <h2 class="auth__heading"><?php echo $title; ?></h2>
    <p class="auth__text">Inicia Sesión en DevWebCamp</p>

    <?php require_once __DIR__ . '/../templates/alerts.php'; ?>

    <form action="<?php $_ENV['HOST'];?>login" class="form" method="POST">
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
        <div class="form__block">
            <label for="password" class="form__label">Contraseña</label>
            <input 
                type="password"
                class="form__input"
                placeholder="Contraseña"
                id="password"
                name="password"
            />
        </div><!-- form__block -->

        <input type="submit" value="Iniciar Sesión" class="form__submit">
    </form><!-- form -->

    <div class="actions">
        <a href="<?php echo $_ENV['HOST'];?>create" class="actions__link">¿Aún no tienes cuenta? Crea una</a>
        <a href="<?php echo $_ENV['HOST'];?>identify" class="actions__link">¿Olvidaste tu contraseña?</a>
    </div>
</main>