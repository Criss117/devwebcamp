<h2 class="page__heading"><?php echo $title; ?></h2>
<p class="page__description">Elije hasta 5 eventos para asistir de forma presencial</p>

<div class="events-register">
    <main class="events-register__list">
        <h3 class="events-register__heading--conferences">&lt;Conferencias/></h3>
        <p class="events-register__date">Viernes 17 de Febrero</p>  
            
        <div class="events-register__grid">
            <?php foreach($events['conferences_friday'] as $event): ?>
                <?php require __DIR__ .'/event.php'; ?>
            <?php endforeach; ?>
        </div>

        <p class="events-register__date">Sábado 18 de Febrero</p>

        <div class="events-register__grid">
            <?php foreach($events['conferences_saturday'] as $event): ?>
                <?php require __DIR__ .'/event.php'; ?>
            <?php endforeach; ?>
        </div>

        <h3 class="events-register__heading--workshops">&lt;WorkShops/></h3>
        <p class="events-register__date">Viernes 17 de Febrero</p>  
            
        <div class="events-register__grid events--workshops">
            <?php foreach($events['workshops_friday'] as $event): ?>
                <?php require __DIR__ .'/event.php'; ?>
            <?php endforeach; ?>
        </div>

        <p class="events-register__date">Sábado 18 de Febrero</p>

        <div class="events-register__grid events--workshops">
            <?php foreach($events['workshops_saturday'] as $event): ?>
                <?php require __DIR__ .'/event.php'; ?>
            <?php endforeach; ?>
        </div>
    </main>
    <aside class="register">
        <h2 class="register__heading">Tu registro</h2>
        <div class="register__summary" id="register-summary"></div>

        <div class="register__gift">
            <label for="gift" class="register__label">Selecciona un regalo</label>
            <select id="gift" class="register__select">
                <option value="" disabled selected>-- Seleccione un regalo --</option>
                <?php foreach($gifts as $gift): ?>
                    <option value="<?php echo $gift->giftId;?>"><?php echo $gift->name;?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <form id="register" class="form">
            <div class="form__block">
                <input type="submit" value="Registrame" class="form__submit">
            </div>
        </form>
    </aside>
</div>