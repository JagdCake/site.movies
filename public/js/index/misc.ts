const toggleBackToTopButton = (currentScrollPosition: number, button: HTMLButtonElement): void => {
    if (currentScrollPosition >= 1200) {
        button.classList.remove('hidden');
    } else {
        button.classList.add('hidden');
    }
};
