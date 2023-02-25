<main class="auth">
    <h2 class="auth__heading"><?php echo $title; ?></h2>
    <p class="auth__text">Recupera tu cuenta de DevWebCamp</p>

    <?php require_once __DIR__ . '/../templates/alerts.php'; ?>
    <?php if($display): ?>
        <form class="form" method="POST">
            <div class="form__block">
                <label for="password" class="form__label">Nueva Contraseña</label>
                <input 
                    type="password"
                    class="form__input"
                    placeholder="Escribe tu nueva contraseña"
                    id="password"
                    name="password"
                />
            </div><!-- form__block -->
            <div class="form__block">
                <label for="password" class="form__label">Confirmar Contraseña</label>
                <input 
                    type="password"
                    class="form__input"
                    placeholder="Vuelve a escribe tu nueva contraseña"
                    id="password2"
                    name="password2"
                />
            </div><!-- form__block -->

            <input type="submit" value="Guardar contraseña" class="form__submit">
        </form><!-- form -->
    <?php endif; ?>
</main>