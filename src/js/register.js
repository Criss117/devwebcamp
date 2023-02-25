import Swal from "sweetalert2";

(function(){
    let events = [];
    const summary = document.querySelector('#register-summary');

if(summary){
    const eventsButton = document.querySelectorAll('.event__add');
    eventsButton.forEach(button => button.addEventListener('click',selectEvent));

    const formRegister = document.querySelector('#register');
    formRegister.addEventListener('submit', submitForm);

    showEvents();

    function selectEvent({target}){    
        if(events.length < 5){
            events = [...events, {
                eventId: target.dataset.id,
                title: target.parentElement.querySelector('.event__name').textContent.trim()
            }];
            target.disabled = true;
            showEvents();
        }else{
            Swal.fire({
                title: 'Error',
                text: 'Máximo 5 eventos por registros',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    }

    function showEvents(){
        //limpiar html
        clearEvent();

        if(events.length > 0){
            events.forEach(event =>{
                const eventDOM = document.createElement('DIV');
                eventDOM.classList.add('register__event');
                
                const title = document.createElement('H3');
                title.classList.add('register__name');
                title.textContent = event.title;

                const buttonDelete = document.createElement('BUTTON');
                buttonDelete.classList.add('register__delete');
                buttonDelete.innerHTML = `<i class="fa-solid fa-trash"></i>`;
                buttonDelete.onclick = function(){
                    deleteEvent(event.eventId)
                };

                //renderizar en el html
                eventDOM.appendChild(title);
                eventDOM.appendChild(buttonDelete);
                summary.appendChild(eventDOM);
            });
        }else{
            const noRegister = document.createElement('P');
            noRegister.textContent = 'No hay eventos, añade hasta 5 del lado izquierdo';
            noRegister.classList.add('register__text');
            summary.appendChild(noRegister);
        }
    }

    function clearEvent(){
        while(summary.firstChild){
            summary.removeChild(summary.firstChild);
        }
    }

    function deleteEvent(id){
        events = events.filter(events => events.eventId !== id);
        const buttonAdd = document.querySelector(`[data-id="${id}"]`)
        buttonAdd.disabled = false;
        showEvents();
    }

    async function submitForm(e){
        e.preventDefault();

        //obtener regalo
        const giftId = document.querySelector('#gift').value;
        const eventId = events.map(event => event.eventId);

        if(eventId.length === 0 || giftId === ''){
            Swal.fire({
                title: 'Error',
                text: 'Elige al menos un evento y un relago',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }
        const data = new FormData();
        data.append('events',eventId);
        data.append('giftId',giftId);

        const url = '/finish-registration/conferences';
        const answer = await fetch(url,{
            method: 'POST',
            body: data
        });
        const result = await answer.json();
        
        if(result.result){
            Swal.fire(
                'Registro exitoso',
                'Tus conferencias se han almacenado y tu registro a sido exitoso, te esperamos en DevWebCamp',
                'success'
            ).then(()=>location.href = `/ticket?id=${result.token}`);
        }else{
            Swal.fire({
                title: 'Error',
                text: 'Hubo un error',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(()=>location.reload());
        }
    }
}
})();