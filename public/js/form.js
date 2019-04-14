const addDirectorButton = document.querySelector('.add-director-field');

function addNewField(addButton) {
    addButton.addEventListener('click', function() {
        const formField = this.parentElement;
        const formSection = formField.parentElement;
        const inputs = formSection.querySelectorAll('input');
        let index = inputs[inputs.length - 1].getAttribute('name').slice(-2, -1);
        if(inputs.length > 2) {
            return;
        }
        const newIndex = ++index;

        const field = formField.cloneNode(true);
        const input = field.querySelector('input');
        const inputName = input.getAttribute('name');
        const inputId = input.getAttribute('id');

        formSection.insertAdjacentElement('beforeend', field);
        input.setAttribute('name', inputName.replace('0', newIndex));
        input.setAttribute('id', inputId.replace('0', newIndex));
        input.value = '';

        const removeButton = field.querySelector('button');
        removeButton.className = 'remove-director-button text-2xl';
        removeButton.textContent = '–';

        removeButton.addEventListener('click', () => {
            input.nextElementSibling.remove();
            input.remove();
        });
    });
}

function main() {
    addNewField(addDirectorButton);

    const allRemoveButtons = document.querySelectorAll('.remove-director-field');
    for(let removeButton of allRemoveButtons) {
        removeButton.addEventListener('click', function()  {
            this.previousElementSibling.remove();
            this.remove();
        });
    }
}

main();
