<fieldset class="form__fieldset">
    <legend class="form__legend">Informacion Personal</legend>
    <div class="form__block">
        <label for="name" class="form__label">Nombre</label>
        <input 
            type="text" 
            name="name" 
            id="name"
            class="form__input"
            placeholder="Nombre del ponente"
            value="<?php echo $speaker->name ?? '';?>"
        />
    </div>
    
    <div class="form__block">
        <label for="surname" class="form__label">Apellido</label>
        <input 
            type="text" 
            name="surname" 
            id="surname"
            class="form__input"
            placeholder="Nombre del ponente"
            value="<?php echo $speaker->surname ?? '';?>"
        />
    </div>

    <div class="form__block">
        <label for="city" class="form__label">Ciudad</label>
        <input 
            type="text" 
            name="city" 
            id="city"
            class="form__input"
            placeholder="Ciudad del ponente"
            value="<?php echo $speaker->city ?? '';?>"
        />
    </div>

    <div class="form__block">
        <label for="country" class="form__label">País</label>
        <input 
            type="text" 
            name="country" 
            id="country"
            class="form__input"
            placeholder="País del ponente"
            value="<?php echo $speaker->country ?? '';?>"
        />
    </div>

    <div class="form__block">
        <label for="image" class="form__label">Imagen</label>
        <input 
            type="file" 
            name="image" 
            id="image"
            class="form__input form__input--file"
        />
    </div>
    <?php if(isset($speaker->current_image)):?>
        <p class="form__text">Imagen actual:</p>
        <div class="form__image">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/'.$speaker->image;?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/'.$speaker->image;?>.png" type="image/png">

                <img src="<?php echo $_ENV['HOST'] . '/img/speakers/'.$speaker->image;?>.png" alt="Imagen del ponente">
            </picture>
            
        </div>
    <?php endif; ?>    
</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">Informacion Extra</legend>
    <div class="form__block">
        <label for="tags_input" class="form__label">Áreas de experiencia (separadas por coma)</label>
        <input 
            type="text" 
            id="tags_input"
            class="form__input"
            placeholder="Ej. Node.js, PHP, CSC, Laravel, React"
        />
        <div id="tags" class="form__list"></div>
        <input type="hidden" name="tags" value="<?php echo $speaker->tags ?? ''?>">
    </div>
</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">Redes sociales</legend>

    <div class="form__block">
        <div class="form__container-icon">
            <div class="form__icon">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input 
                type="text" 
                class="form__input--social"
                name="network[facebook]"
                placeholder="Facebook"
                value="<?php echo $network->facebook ?? '';?>"
            />
        </div> 
    </div>

    <div class="form__block">
        <div class="form__container-icon">
            <div class="form__icon">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input 
                type="text" 
                class="form__input--social"
                name="network[twitter]"
                placeholder="Twitter"
                value="<?php echo $network->twitter ?? '';?>"
            />
        </div> 
    </div>

    <div class="form__block">
        <div class="form__container-icon">
            <div class="form__icon">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input 
                type="text" 
                class="form__input--social"
                name="network[instagram]"
                placeholder="Instagram"
                value="<?php echo $network->instagram ?? '';?>"
            />
        </div> 
    </div>

    <div class="form__block">
        <div class="form__container-icon">
            <div class="form__icon">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input 
                type="text" 
                class="form__input--social"
                name="network[youtube]"
                placeholder="YouTube"
                value="<?php echo $network->youtube ?? '';?>"
            />
        </div> 
    </div>

    <div class="form__block">
        <div class="form__container-icon">
            <div class="form__icon">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input 
                type="text" 
                class="form__input--social"
                name="network[tiktok]"
                placeholder="TikTok"
                value="<?php echo $network->tiktok ?? '';?>"
            />
        </div> 
    </div>

    <div class="form__block">
        <div class="form__container-icon">
            <div class="form__icon">
                <i class="fa-brands fa-github"></i>
            </div>
            <input 
                type="text" 
                class="form__input--social"
                name="network[github]"
                placeholder="GitHub"
                value="<?php echo $network->github ?? '';?>"
            />
        </div> 
    </div>
</fieldset> 