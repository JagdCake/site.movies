const showSection = (show: boolean, section: HTMLElement): boolean => {
    if (show) {
        section.classList.add('bg-red-pink');
        section.classList.add('md:flex');
        section.style.height = `${section.scrollHeight}px`;
    } else {
        section.style.height = '0';
        setTimeout(() => {
            section.classList.remove('md:flex');
            section.classList.remove('bg-red-pink');
        }, 400);
    }

    return show;
};

const replaceImage = (image: HTMLImageElement, newImageSrc: string): void => {
    image.setAttribute('src', newImageSrc);
};

const aboutSection = (): void => {
    const toggleButton: HTMLButtonElement = document.querySelector('.about-button');
    const buttonIcon: HTMLImageElement = toggleButton.querySelector('img');
    const buttonOriginalIcon: string = buttonIcon.getAttribute('src');
    const buttonCloseIcon: string = 'images/close.svg';

    const section: HTMLElement = document.querySelector('.about');
    let sectionDisplayed: boolean = false;

    toggleButton.addEventListener('click', () => {
        if (!sectionDisplayed) {
            sectionDisplayed = showSection(true, section);
            replaceImage(buttonIcon, buttonCloseIcon);
        } else {
            sectionDisplayed = showSection(false, section);
            replaceImage(buttonIcon, buttonOriginalIcon);
        }
    });
};
