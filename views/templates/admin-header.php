<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <a href="<?php echo $_ENV['HOST'];?>">
            <h2 class="dashboard__logo">&#60;DevWebCamp/></h2>
        </a>

        <nav class="dashboard__nav">
            <form action="<?php echo $_ENV['HOST'];?>logout" method="POST" class="dasboard__form">
                <input type="submit" value="Cerrar Sesión" class="dashboard__submit--logout">
            </form>
        </nav>
    </div>
</header>