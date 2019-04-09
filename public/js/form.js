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

        const removeButton = document.createElement('button');
        removeButton.append(document.createTextNode('–'));
        removeButton.setAttribute('type', 'button');
        removeButton.className = 'text-2xl';

        input.insertAdjacentElement('afterend', removeButton);
        removeButton.addEventListener('click', () => {
            input.nextElementSibling.remove();
            input.remove();
        });
    });
}

addNewInput(addDirectorButton);
