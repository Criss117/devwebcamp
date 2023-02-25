<main class="diary">
    <h2 class="diary__heading">WorkShops & Conferencias</h2>
    <p class="diary__description">Talleres y conferencias dictados por expertos en desarrollo web</p>

    <div class="events">
        <h3 class="events__heading">&lt;Conferencias/></h3>
        <p class="events__date">Viernes 18 de Febrero</p>  

        <div class="events__list slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($events['conferences_friday'] as $event): ?>
                    <?php require __DIR__ .'../../templates/event.php'; ?>
                <?php endforeach; ?>
            </div>   
            <div class="swiper-button-next"></div> 
            <div class="swiper-button-prev"></div>  
        </div>

        <p class="events__date">Sábado 18 de Febrero</p>

        <div class="events__list slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($events['conferences_saturday'] as $event): ?>
                    <?php require __DIR__ .'../../templates/event.php'; ?>
                <?php endforeach; ?>
            </div>   
            <div class="swiper-button-next"></div> 
            <div class="swiper-button-prev"></div>  
        </div>
    </div>

    <div class="events events--workshops">
        <h3 class="events__heading">&lt;WorkShops/></h3>
        <p class="events__date">Viernes 18 de Febrero</p>

        <div class="events__list slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($events['workshops_friday'] as $event): ?>
                    <?php require __DIR__ .'../../templates/event.php'; ?>
                <?php endforeach; ?>
            </div>   
            <div class="swiper-button-next"></div> 
            <div class="swiper-button-prev"></div>  
        </div>

        <p class="events__date">Sábado 18 de Febrero</p>

        <div class="events__list slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($events['workshops_saturday'] as $event): ?>
                    <?php require __DIR__ .'../../templates/event.php'; ?>
                <?php endforeach; ?>
            </div>   
            <div class="swiper-button-next"></div> 
            <div class="swiper-button-prev"></div>  
        </div>
    </div>
</main>