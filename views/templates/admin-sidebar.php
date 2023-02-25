<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="<?php echo $_ENV['HOST'];?>admin/dashboard" class="dashboard__link <?php echo actual_page('/dashboard') ? 'dashboard__link--actual' : '';?>">
            <i class="fa-solid fa-house dashboard__icon"></i>
            <span class="dashboard__menu-text">
                Inicio
            </span>
        </a>
        <a href="<?php echo $_ENV['HOST'];?>admin/speakers" class="dashboard__link <?php echo actual_page('/speakers') ? 'dashboard__link--actual' : '';?>">
            <i class="fa-solid fa-microphone dashboard__icon"></i>
            <span class="dashboard__menu-text">
                Ponentes
            </span>
        </a>
        <a href="<?php echo $_ENV['HOST'];?>admin/events" class="dashboard__link <?php echo actual_page('/events') ? 'dashboard__link--actual' : '';?>">
            <i class="fa-solid fa-calendar dashboard__icon"></i>
            <span class="dashboard__menu-text">
                Eventos
            </span>
        </a>
        <a href="<?php echo $_ENV['HOST'];?>admin/register" class="dashboard__link <?php echo actual_page('/register') ? 'dashboard__link--actual' : '';?>">
            <i class="fa-solid fa-users dashboard__icon"></i>
            <span class="dashboard__menu-text">
                Registrados
            </span>
        </a>
        <a href="<?php echo $_ENV['HOST'];?>admin/gifts" class="dashboard__link <?php echo actual_page('/gifts') ? 'dashboard__link--actual' : '';?>">
            <i class="fa-solid fa-gift dashboard__icon"></i>
            <span class="dashboard__menu-text">
                Regalos
            </span>
        </a>
    </nav>
</aside>