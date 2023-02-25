(function(){
    const speakersInput = document.querySelector('#speakers');
    
    if(speakersInput){
        let speakers = [];
        let leakedSpeakers = [];
        const speakersList = document.querySelector('#speakers-list');
        const speakerHidden = document.querySelector('[name="speakerId"]');
 
        getSpeakers()
        speakersInput.addEventListener('input', searchSpeakers);

        if(speakerHidden.value){
            (async() => {
                const speaker = await getSpeaker(speakerHidden.value);
                const speakerDOM = document.createElement('LI');
                speakerDOM.classList.add('speakers-list__speaker','speakers-list__speaker--selected');
                speakerDOM.textContent = `${speaker.name} ${speaker.surname}`;
                speakersList.appendChild(speakerDOM);
            })();
        }

        async function getSpeakers(){
            const url = `/api/speakers`;
            const answer = await fetch(url);
            const result = await answer.json();
            formatSpeakers(result);
        }   

        async function getSpeaker(speakerId){
            const url = `/api/speaker?id=${speakerId}`;
            const answer = await fetch(url);
            const result = await answer.json();
            return result;
        }
        
        function formatSpeakers(arraySpeakers = []){
            speakers = arraySpeakers.map(speaker =>{
                return{
                    name: `${speaker.name.trim()} ${speaker.surname.trim()}`,
                    speakerId: speaker.speakerId
                }
            });
        }

        function searchSpeakers(e){
            const search = e.target.value;

            if(search.length > 3){
                const expression = new RegExp(search, "i");
                leakedSpeakers = speakers.filter(speaker =>{
                    if(speaker.name.toLowerCase().search(expression) != -1){
                        return speaker;
                    }
                });
            }else{
                leakedSpeakers = [];
            }
            showSpeakers();
        }

        function showSpeakers(){
                while(speakersList.firstChild){
                    speakersList.removeChild(speakersList.firstChild);
                }

                if(leakedSpeakers.length > 0){
                    leakedSpeakers.forEach(speaker =>{ 
                        const speakerHtml = document.createElement('LI');
                        speakerHtml.classList.add('speakers-list__speaker');
                        speakerHtml.textContent = speaker.name;
                        speakerHtml.dataset.speakerId = speaker.speakerId;
                        speakerHtml.onclick = selectSpeaker;
                    
                        //añadir al dom
                        speakersList.appendChild(speakerHtml);
                    });
                }else{
                    const noResults = document.createElement('P');
                    noResults.classList.add('speakers-list__no-results');
                    noResults.textContent = 'No hay resultados para tu búsqueda';
                    speakersList.appendChild(noResults);
                }
        }

        function selectSpeaker(e){
            const speaker = e.target;
            //recomver clase previa
            const previousSpeaker = document.querySelector('.speakers-list__speaker--selected');
            if(previousSpeaker){
                previousSpeaker.classList.remove('speakers-list__speaker--selected');
            }
            speaker.classList.add('speakers-list__speaker--selected');
            speakerHidden.value = speaker.dataset.speakerId;
        }
    }
})();