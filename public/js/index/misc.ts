const toggleBackToTopButton = (currentScrollPosition: number, button: HTMLButtonElement): void => {
    if (currentScrollPosition >= 1200) {
        button.classList.remove('hidden');
    } else {
        button.classList.add('hidden');
    }
};

const misc = (): void => {
    const buttonUp: HTMLButtonElement = document.querySelector('.go-up');

    window.addEventListener('scroll', () => {
        setInterval(() => {
            const verticalScrollPosition = window.pageYOffset;

            toggleBackToTopButton(verticalScrollPosition, buttonUp);
        }, 1000);
    });
};
