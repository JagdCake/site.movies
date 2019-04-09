const addDirectorButton = document.querySelector('.add-director-field');

function addNewInput(addButton) {
    addButton.addEventListener('click', function() {
        const formSection = this.parentElement;
        const formField = formSection.querySelector('input');

        let index = formSection.querySelectorAll('input').length;
        if(index > 2) {
            return;
        }
        const newIndex = index++;

        const input = formField.cloneNode(false);
        const inputName = input.getAttribute('name');
        const inputId = input.getAttribute('id');

        input.setAttribute('name', inputName.replace('0', newIndex));
        input.setAttribute('id', inputId.replace('0', newIndex));
        formSection.insertAdjacentElement('beforeend',input);
        input.value = '';
    });
}

addNewInput(addDirectorButton);
