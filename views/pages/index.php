<?php require_once __DIR__ . '/conferences.php'; ?>  

<section class="summary">
    <div class="summary__grid">
        <div class="summary__block" <?php aos_animation();?>>
            <p class="summary__text summary__text--number"><?php echo $totalSpeakers ?></p>
            <p class="summary__text">ponentes</p>
        </div>

        <div class="summary__block" <?php aos_animation();?>>
            <p class="summary__text summary__text--number"><?php echo $totalConferences ?></p>
            <p class="summary__text">conferencias</p>
        </div>

        <div class="summary__block" <?php aos_animation();?>>
            <p class="summary__text summary__text--number"><?php echo $totalWorkshops ?></p>
            <p class="summary__text">workshops</p>
        </div>

        <div class="summary__block" <?php aos_animation();?>>
            <p class="summary__text summary__text--number">500</p>
            <p class="summary__text">asistentes</p>
        </div>
    </div>
</section>

<section class="speakers">
    <h2 class="speakers__heading">Speakers</h2>
    <p class="speakers__description">Conoce a nuestros expertos de DevWebCamp</p>

    <div class="speakers__grid">
    <?php foreach($speakers as $speaker):?>
        <div class="speaker" data-aos-once="false">
            <picture >
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/'.$speaker->image;?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/'.$speaker->image;?>.png" type="image/png">
                <img class="speaker__image" loading="lazy"  width="200" height="300" src="<?php echo $_ENV['HOST'] . '/img/speakers/'.$speaker->image;?>.png" alt="Imagen del ponente">
            </picture>

            <div class="speaker__info">
                <h4 class="speaker__name">
                    <?php echo $speaker->name . ' ' . $speaker->surname;?>
                </h4>
                <p class="speaker__location">
                    <?php echo $speaker->city . ',' . $speaker->country;?>
                </p>

                <nav class="speaker-social">
                    <?php 
                        $network = json_decode($speaker->network);
                    ?>
                    <?php if(!empty($network->facebook)): ?>
                        <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="<?php echo $network->facebook;?>">
                            <span class="speaker-social__hide">Facebook</span>
                        </a> 
                    <?php endif; ?>

                    <?php if(!empty($network->twitter)): ?>
                        <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="<?php echo $network->twitter;?>">
                            <span class="speaker-social__hide">Twitter</span>
                        </a> 
                    <?php endif; ?>
                    
                    <?php if(!empty($network->youtube)): ?>
                        <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="<?php echo $network->youtube;?>">
                            <span class="speaker-social__hide">YouTube</span>
                        </a> 
                    <?php endif; ?>

                    <?php if(!empty($network->instagram)): ?>
                        <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="<?php echo $network->instagram;?>">
                            <span class="speaker-social__hide">Instagram</span>
                        </a> 
                    <?php endif; ?>
                    
                    <?php if(!empty($network->tiktok)): ?>
                        <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="<?php echo $network->tiktok;?>">
                            <span class="speaker-social__hide">Tiktok</span>
                        </a> 
                    <?php endif; ?>
                    
                    <?php if(!empty($network->github)): ?>
                        <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="<?php echo $network->github;?>">
                            <span class="speaker-social__hide">GitHub</span>
                        </a>
                    <?php endif; ?>
                </nav>

                <ul class="speaker__list-skills">
                    <?php $tags = explode(',',$speaker->tags);?>
                    <?php foreach($tags as $tag): ?>
                        <li class="speaker__skill"><?php echo $tag; ?></li>
                    <?php endforeach; ?>
            </ul>   
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</section>

<div id="map" class="map"></div>

<section class="tickets">
    <h2 class="tickets__heading">Boletos y precios</h2>
    <p class="tickets__description">Precios para DevWebCamp</p>
    <div class="tickets__grid">
        <div class="ticket ticket--presencial">
            <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
            <p class="ticket__plan">Presencial</p>
            <p class="ticket__price">$199</p>
        </div>

        <div class="ticket ticket--virtual" >
            <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
            <p class="ticket__plan">Virtual</p>
            <p class="ticket__price">$49</p>
        </div>

        <div class="ticket ticket--gratis" >
            <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
            <p class="ticket__plan">Gratis</p>
            <p class="ticket__price">Gratis - $0</p>
        </div>
    </div>

    <div class="ticket__link-container">
        <a href="/packages" class="ticket__link">Ver Paquetes</a>
    </div>
</section>