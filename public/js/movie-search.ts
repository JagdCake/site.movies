const movieTitle = (movieData: string): string => {
    let title: string;
    title = movieData.replace(/(\|\s\d{4})/g, ''); // removes the separator (|) and the year
    title = title.trim(); // could pose a problem
    title = title.toLowerCase();

    return title;
};

const toggleSearchBox = (movieNumber: HTMLParagraphElement, searchBox: HTMLInputElement): void => {
    movieNumber.classList.toggle('hidden');
    searchBox.classList.toggle('hidden');
};
