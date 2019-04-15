function generateInputIndexFrom(inputs) {
    // selects the '0' from movie[directors][0]
    let oldIndex = inputs[inputs.length - 1].getAttribute('name').slice(-2, -1);
    return ++oldIndex;
}

function cloneAndInsertField(fieldToClone, elementToInsertInto) {
    const field = fieldToClone.cloneNode(true);

    elementToInsertInto.insertAdjacentElement('beforeend', field);

    return field;
}

function updateFieldInput(field, updatedIndex) {
    const input = field.querySelector('input');
    const inputName = input.getAttribute('name');
    const inputId = input.getAttribute('id');

    input.setAttribute('name', inputName.replace('0', updatedIndex));
    input.setAttribute('id', inputId.replace('0', updatedIndex));
    input.value = '';
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

    const sectionInputs = section.querySelectorAll('input');

    if(sectionInputs.length > 2) {
        return;
    }

    const newField = cloneAndInsertField(field, section);
    const newFieldInputIndex = generateInputIndexFrom(sectionInputs);
    updateFieldInput(newField, newFieldInputIndex);

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
