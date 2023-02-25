<header class="header">
    <div class="header__container">
        <nav class="header__navigation">
            <?php if(isAuth()){ ?>
                <a href="<?php echo is_admin() ? '/admin/dashboard' : '/finish-registration'; ?>" class="header__link">Administrar</a>
                <form action="/logout" method="POST" class="header__form">
                    <input type="submit" value="Cerrar Sesión" class="header__submit">
                </form>
            <?php } else { ?>
                <a href="<?php echo $_ENV['HOST'];?>create" class="header__link">Crear cuenta</a>
                <a href="<?php echo $_ENV['HOST'];?>login" class="header__link">Iniciar Sesión</a>
           <?php } ?>
        </nav>

        <div class="header__contents">
            <a href="<?php echo $_ENV['HOST'];?>">
                <h1 class="header__logo">&#60;DevWebCamp/></h1>
            </a>
            <p class="header__text">Enero 29-30 - 2023</p>
            <p class="header__text header__text--modality">En linea - Presencial</p>

            <a href="<?php echo $_ENV['HOST'];?>create" class="header__button">Comprar Pase</a>
            
        </div>
    </div>
</header>

<div class="bar">
    <div class="bar__contents">
        <a href="<?php echo $_ENV['HOST'];?>"><h2 class="bar__logo">&#60;DevWebCamp/></h2></a>
        <nav class="navigation"></nav>
            <a 
                href="<?php echo $_ENV['HOST'];?>devwebcamp" 
                class="navigation__link <?php echo actual_page('/devwebcamp') ? 'navigation__link--actual' : ''; ?>">Evento</a>
            <a 
                href="<?php echo $_ENV['HOST'];?>packages" 
                class="navigation__link <?php echo actual_page('/package') ? 'navigation__link--actual' : ''; ?>">Paquetes</a>
            <a 
                href="<?php echo $_ENV['HOST'];?>workshops-conferences" 
                class="navigation__link <?php echo actual_page('/workshops-conferences') ? 'navigation__link--actual' : ''; ?>">Workshops / Conferencias</a>
            <a 
                href="<?php echo $_ENV['HOST'];?>create" 
                class="navigation__link <?php echo actual_page('/create') ? 'navigation__link--actual' : ''; ?>">Comprar pase</a>
        </nav>
    </div>
</div>