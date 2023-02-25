(function(){
    const hours = document.querySelector('#hours');

    if(hours){
        const category = document.querySelector('[name="categoryId"]');
        const days = document.querySelectorAll('[name = "day"]');
        const inputHiddenDay = document.querySelector('[name = "dayId"]');
        const inputHiddenHour = document.querySelector('[name = "hourId"]');

        category.addEventListener('change',searchTerm)
        days.forEach(day => day.addEventListener('change',searchTerm));

        let search = {
            categoryId: +category.value || '',
            day: +inputHiddenDay.value || ''
        }
        
        if(!Object.values(search).includes('')){      
            (async ()=>{
                await searchEvents();

                //resaltar hora actual
                const id = inputHiddenHour.value;
                const selectedHour = document.querySelector(`[data-hour-id="${id}"]`);
    
                selectedHour.classList.remove('hours__hour--disable');
                selectedHour.classList.add('hours__hour--selected');
                
                selectedHour.onclick = selectHour;
            })();
        }

        function searchTerm(e){
            search[e.target.name] = e.target.value;

            //reiniciar campos ocultos
            inputHiddenHour.value = '';
            inputHiddenDay.value = '';
            
            //desabilitar la hora previa
            const previusHour = document.querySelector('.hours__hour--selected');
            if(previusHour){
                previusHour.classList.remove('hours__hour--selected');
            }

            if(Object.values(search).includes('')){
                return;
            }
            searchEvents();
        }

        async function searchEvents(){
            const{categoryId, day} = search;
            const url = `/api/event-schedule?dayId=${day}&categoryId=${categoryId}`;
            const result = await fetch(url);
            const events = await result.json();
            getAvailableHours(events);
        }

        function getAvailableHours(events){
            //reiniciar horas
            const listHours = document.querySelectorAll('#hours li');
            listHours.forEach(li => li.classList.add('hours__hour--disable'));

            //comprobar eventos ya tomados
            const selectedHours = events.map(event => event.hourId);
            const listHoursArray = Array.from(listHours);

            const result = listHoursArray.filter(li => !selectedHours.includes(li.dataset.hourId));
            result.forEach(li => li.classList.remove('hours__hour--disable'));

            const availableHours = document.querySelectorAll('#hours li:not(.hours__hour--disable)');
            availableHours.forEach(hour => hour.addEventListener('click', selectHour));
        }

        function selectHour(e){
            //desabilitar la hora previa
            const previusHour = document.querySelector('.hours__hour--selected');
            if(previusHour){
                previusHour.classList.remove('hours__hour--selected');
            }
            //agregar clase de seleccionado
            e.target.classList.add('hours__hour--selected');

            inputHiddenHour.value = e.target.dataset.hourId;

            //llenar el campo oculto de dia
            inputHiddenDay.value = document.querySelector('[name="day"]:checked').value;
        }
    }
})();