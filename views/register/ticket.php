<main class="page">
    <h2 class="page__heading"><?php echo $title; ?></h2>
    <p class="page__description">Tu boleto - te recomendamos almacenarlo, puedes compartirlo en redes sociales.</p>

    <div class="ticket-virtual">
        <div class="ticket ticket--<?php echo strtolower($register->package->name);?> ticket--access">
            <div class="ticket__content">
                <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
                <p class="ticket__plan"><?php echo $register->package->name;?></p>
                <p class="ticket__name"><?php echo $register->user->name . ' ' , $register->user->surname;?></p>       
            </div>
            <p class="ticket__code">#<?php echo $register->token;?></p>
        </div>
    </div>
</main>