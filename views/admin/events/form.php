<fieldset class="form__fieldset">
    <legend class="form__legend">Informacion del evento</legend>
    <div class="form__block">
        <label for="name" class="form__label">Nombre</label>
        <input 
            type="text" 
            name="name" 
            id="name"
            class="form__input"
            placeholder="Nombre del evento"
            value="<?php echo $event->name ?? '';?>"
        />
    </div>

    <div class="form__block">
        <label for="description" class="form__label">Descripcion</label>
        <textarea 
            name="description" 
            id="description"
            class="form__input"
            placeholder="Descripcion del evento"
            rows="8"
        ><?php echo $event->description ?? '';?></textarea>
    </div>

    <div class="form__block">
        <label for="name" class="form__label">Categoría</label>
        <select 
            class="form__select"
            name="categoryId" 
            id="categoryId"
        >
            <option selected disabled value="">--Seleccionar--</option>
            <?php foreach($categories as $category):?>
                <option <?php echo ($event->categoryId === $category->categoryId) ? 'selected' : '';?> value="<?php echo $category->categoryId; ?>"><?php echo $category->name; ?></option>
            <?php endforeach; ?>    
        </select>
    </div>

    <div class="form__block">
        <label for="name" class="form__label">Selecciona el día</label>
        <div class="form__radio">
            <?php foreach($days as $day): ?>
                <div>
                    <label for="<?php echo strtolower($day->name); ?>"><?php echo $day->name ?></label>
                    <input 
                        type="radio" 
                        id="<?php echo strtolower($day->name);?>"
                        name="day"
                        value="<?php echo $day->dayId ?>" 
                        <?php echo ($event->dayId === $day->dayId) ? 'checked' : ''; ?>   
                    />
                </div>
            <?php endforeach; ?>   
        </div>
        <input type="hidden" name="dayId" value="<?php echo $event->dayId ?? ''; ?>">
    </div>  
    
    <div id="hour" class="form__block">
        <label class="form__label">Seleccionar hora</label>
        <ul class="hours" id="hours">
            <?php foreach($hours as $hour):?>
                <li data-hour-id="<?php echo $hour->hourId ?>" class="hours__hour hours__hour--disable"><?php echo $hour->hour; ?></li>
            <?php endforeach; ?>    
        </ul>    
        <input type="hidden" name="hourId" value="<?php echo $event->hourId ?? ''; ?>">
    </div>
</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">Información extra</legend>

    <div class="form__block">
        <label for="speakers" class="form__label">Ponente</label>
        <input 
            type="text" 
            id="speakers"
            class="form__input"
            placeholder="Buscar ponente"
        />
        <ul id="speakers-list" class="speakers-list"></ul>

        <input type="hidden" name="speakerId" value="<?php echo $event->speakerId ?? ''; ?>">
    </div>

    <div class="form__block">
        <label for="available" class="form__label">Lugares disponibles</label>
        <input 
            type="number" 
            min = "1"
            id="available"
            name="available"
            class="form__input"
            placeholder="Ej, 20"
            value="<?php echo $event->available; ?>"
        />
    </div>
</fieldset>