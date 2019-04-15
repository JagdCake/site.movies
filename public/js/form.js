function generateFieldIndex(fields) {
    const inputs = fields.querySelectorAll('input');
    const numOfInputs = inputs.length;
    // selects the '0' from movie[directors][0]
    let index = inputs[numOfInputs - 1].getAttribute('name').slice(-2, -1);

    return {
        numOfInputs: numOfInputs,
        i: ++index,
    };
}

function cloneAndInsertField(fieldToClone, parentElement) {
    const field = fieldToClone.cloneNode(true);

    parentElement.insertAdjacentElement('beforeend', field);

    return field;
}

function addNewField(addButton) {
    addButton.addEventListener('click', function() {
        const formField = this.parentElement;
        const formSection = formField.parentElement;
        const fieldIndex = generateFieldIndex(formSection);
        if(fieldIndex.numOfInputs > 2) {
            return;
        }

        const newField = cloneAndInsertField(formField, formSection);

        const input = newField.querySelector('input');
        const inputName = input.getAttribute('name');
        const inputId = input.getAttribute('id');
        input.setAttribute('name', inputName.replace('0', fieldIndex.i));
        input.setAttribute('id', inputId.replace('0', fieldIndex.i));
        input.value = '';

        const removeButton = newField.querySelector('button');
        removeButton.className = 'remove-director-button text-2xl';
        removeButton.textContent = '–';

        removeButton.addEventListener('click', () => {
            input.nextElementSibling.remove();
            input.remove();
        });
    });
}

function main() {
    const addDirectorButton = document.querySelector('.add-director-field');
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
