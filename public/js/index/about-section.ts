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
