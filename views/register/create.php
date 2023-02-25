<main class="register">
    <h2 class="register__heading"><?php echo $title; ?></h2>
    <p class="register__description">Elige tu plan</p>

    <div class="packages__grid">
        <div class="package">
            <h3 class="package__name">Pase gratis</h3>
            <ul class="package__list">
                <li class="package__element">Acceso virtual a DevWebCamp</li>
            </ul>

            <p class="package__price">$0</p>

            <form action="/finish-registration/free" method="POST">
                <input type="submit" class="packages__submit" value="Inscripción gratis">
            </form>
        </div>
        <div class="package">
            <h3 class="package__name">Pase presencial</h3>
            <ul class="package__list">
                <li class="package__element">Acceso presencial a DevWebCamp</li>
                <li class="package__element">Pase por 2 días</li>
                <li class="package__element">Acceso a talleres y conferencias</li>
                <li class="package__element">Acceso a grabaciones</li>
                <li class="package__element">Camisa del Evento</li>
                <li class="package__element">Comida y bebida</li>
            </ul>

            <p class="package__price">$199</p>
            <div id="smart-button-container">
            <div style="text-align: center;">
            <div id="paypal-button-container"></div>
    </div>
</div>
        </div>
        <div class="package">
            <h3 class="package__name">Pase virtual</h3>
            <ul class="package__list">
                <li class="package__element">Acceso virtual a DevWebCamp</li>
                <li class="package__element">Pase por 2 días</li>
                <li class="package__element">Enlace a talleres y conferencia</li>
                <li class="package__element">Acceso a grabaciones</li>
            </ul>

            <p class="package__price">$49</p>
            <div id="smart-button-container">
            <div style="text-align: center;">
            <div id="paypal-button-container-virtual"></div>
      </div>
    </div>
        </div>
    </div>
</main>


<script src="https://www.paypal.com/sdk/js?client-id=ATMsK1h0PYTmzzl2iHvngXJzYmmd2SNMf910X8u1MmwgaJyR9mobvEPMrtXVCR6-l3wFCL8RqHUh445T&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
    function initPayPalButton() {
        paypal.Buttons({
        style: {
            shape: 'rect',
            color: 'blue',
            layout: 'vertical',
            label: 'pay',
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"1","amount":{"currency_code":"USD","value":246.81,"breakdown":{"item_total":{"currency_code":"USD","value":199},"shipping":{"currency_code":"USD","value":10},"tax_total":{"currency_code":"USD","value":37.81}}}}]
          });
        },

        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                const data = new FormData();
                data.append('packageId',orderData.purchase_units[0].description);
                data.append('payId',orderData.purchase_units[0].payments.captures[0].id);

                fetch('/finish-registration/pay',{
                    method: 'POST',
                    body: data
                })
                .then(answer => answer.json())
                .then(answer =>{
                    if(answer.result){
                        actions.redirect('http://localhost:3000/finish-registration/conferences');
                    }
                });
            });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');


      paypal.Buttons({
        style: {
            shape: 'rect',
            color: 'blue',
            layout: 'vertical',
            label: 'pay',
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"2","amount":{"currency_code":"USD","value":49}}]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            const data = new FormData();
                data.append('packageId',orderData.purchase_units[0].description);
                data.append('payId',orderData.purchase_units[0].payments.captures[0].id);

                fetch('/finish-registration/pay',{
                    method: 'POST',
                    body: data
                })
                .then(answer => answer.json())
                .then(answer =>{
                    if(answer.result){
                        actions.redirect('http://localhost:3000/finish-registration/conferences');
                    }
                });
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container-virtual');
    }
    initPayPalButton();
  </script>