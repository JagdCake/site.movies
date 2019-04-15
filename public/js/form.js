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

function updateFieldInput(field, updatedIndex) {
    const input = field.querySelector('input');
    const inputName = input.getAttribute('name');
    const inputId = input.getAttribute('id');

    input.setAttribute('name', inputName.replace('0', updatedIndex));
    input.setAttribute('id', inputId.replace('0', updatedIndex));
    input.value = '';

    return input;
}

function changeIntoRemoveButton(button) {
    button.classList.remove('button-add-director');
    button.classList.add('button-remove-director');
    button.textContent = '–';
}

function removeParentOnClick(buttonToClick) {
    buttonToClick.addEventListener('click', function() {
        this.parentElement.remove();
    });
}

function addNewField(field) {
    const section = field.parentElement;

    const fieldIndex = generateFieldIndex(section);

    if(fieldIndex.numOfInputs > 2) {
        return;
    }

    const newField = cloneAndInsertField(field, section);
    const updatedInput = updateFieldInput(newField, fieldIndex.i);

    const fieldButton = newField.querySelector('button');
    changeIntoRemoveButton(fieldButton);
    // remove the parent of the button (the new field)
    removeParentOnClick(fieldButton);
}

function main() {
    const addDirectorButton = document.querySelector('.button-add-director');
    addDirectorButton.addEventListener('click', function() {
        // use the first director field to create a new one
        addNewField(this.parentElement);
    });

    const removeDirectorButtons = document.querySelectorAll('.button-remove-director');
    for(let removeButton of removeDirectorButtons) {
        removeParentOnClick(removeButton);
    }
}

main();
