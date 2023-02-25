<main class="auth">
    <h2 class="auth__heading" id="tittle"><?php echo $title; ?></h2>
    <p class="auth__text">Regístrate en DevWebCamp</p>

    <?php require_once __DIR__ . '/../templates/alerts.php'; ?>

    <form action="<?php echo $_ENV['HOST'];?>create" class="form" method="POST">
        <div class="form__block">
            <label for="name" class="form__label">Nombre</label>
            <input 
                type="text"
                class="form__input"
                placeholder="Tu nombre"
                id="name"
                name="name"
                value="<?php echo $user->name ?? ''; ?>"
            />
        </div><!-- form__block -->
        <div class="form__block">
            <label for="surname" class="form__label">Apellido</label>
            <input 
                type="text"
                class="form__input"
                placeholder="Tu apellido"
                id="surname"
                name="surname"
                value="<?php echo $user->surname ?? ''; ?>"
            />
        </div><!-- form__block -->
        <div class="form__block">
            <label for="email" class="form__label">Correo Electrónico</label>
            <input 
                type="email"
                class="form__input"
                placeholder="Tu correo electronico"
                id="email"
                name="email"
                value="<?php echo $user->email ?? ''; ?>"
            />
        </div><!-- form__block -->
        <div class="form__block">
            <label for="password" class="form__label">Contraseña</label>
            <input 
                type="password"
                class="form__input"
                placeholder="Debe de tener al menos 6 caracteres"
                id="password"
                name="password"
            />
        </div><!-- form__block -->
        <div class="form__block">
            <label for="password2" class="form__label">Vuelve a escribir la Contraseña</label>
            <input 
                type="password"
                class="form__input"
                id="password2"
                name="password2"
            />
        </div><!-- form__block -->
        <input type="submit" value="Crear cuenta" class="form__submit">
    </form><!-- form -->

    <div class="actions">
        <a href="<?php echo $_ENV['HOST'];?>login" class="actions__link">¿Ya tiene una cuenta? Inicia sesíon</a>
        <a href="<?php echo $_ENV['HOST'];?>identify" class="actions__link">¿Olvidaste tu contraseña?</a>
    </div>
</main>