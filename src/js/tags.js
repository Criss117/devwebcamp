(function(){
    const tagsInput = document.querySelector('#tags_input');

    if(tagsInput){
        const tagsDiv = document.querySelector('#tags');
        const tagsInputHidden = document.querySelector('[name="tags"]');

        let tags = [];

        // Recuperar del input oculto
        if(tagsInputHidden.value !== '') {
            tags = tagsInputHidden.value.split(',');
            showTags();
        }

        //Escuchar los cambios en el input
        tagsInput.addEventListener('keypress', saveTag);

        function saveTag(e){
            if(e.keyCode === 44){
                e.preventDefault();
                if(e.target.value.trim() === '' || e.target.value < 1 ){
                    tagsInput.value = '';
                    return;
                }
                tags = [...tags, e.target.value.trim()];
                tagsInput.value = '';
                showTags();
            }
        }

        function showTags(){
            tagsDiv.textContent = '';
            tags.forEach(tag => {
                const label = document.createElement('LI');
                label.classList.add('form__tag');
                label.textContent = tag;
                label.ondblclick = deleteTag;
                tagsDiv.appendChild(label);
            })
            updateInputHidden();   
        }

        function deleteTag(e){
            e.target.remove();
            tags = tags.filter(tag => tag !== e.target.textContent);
            updateInputHidden();
        }

        function updateInputHidden(){
            tagsInputHidden.value = tags.toString();
        }
    }
})() //IIFE