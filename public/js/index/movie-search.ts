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

const showMovieElement = (show: boolean, movieElement: HTMLElement): void => {
    if (show) {
        movieElement.classList.remove('hidden');
    } else {
        movieElement.classList.add('hidden');
    }
};

const searchMoviesBy = (searchString: string, movies: HTMLParagraphElement[]): void => {
    movies.map((movie: HTMLParagraphElement) => {
            // @ts-ignore
            const title = movieTitle(movie.textContent);
            const charsToSearchFor = searchString.toLowerCase();

            if (title.indexOf(charsToSearchFor) > -1) {
                showMovieElement(true, movie);
            } else {
                showMovieElement(false, movie);
            }
        });
};

const movieSearch = (): void => {
    const searchButton = document.querySelector('.search-button') as HTMLButtonElement;
    const movieNumber = document.querySelector('.movie-number') as HTMLParagraphElement;
    const searchBox = document.querySelector('input[type="search"]') as HTMLInputElement;
    const movieList = document.querySelector('.movie-list') as HTMLParagraphElement;

    searchButton.addEventListener('click', () => {
        toggleSearchBox(movieNumber, searchBox);
        showMovieElement(false, movieList);
    });

     // [].slice.call() converts a node list to array
    const movies = [].slice.call(document.querySelectorAll('.movie-list p')) as HTMLParagraphElement[];

    searchBox.addEventListener('keyup', () => {
        showMovieElement(true, movieList);
        searchMoviesBy(searchBox.value, movies);

        document.addEventListener('keyup', (event) => {
            if (event.which === 27 || event.which === 1) {
                showMovieElement(false, movieList);
            }
        });
        document.addEventListener('click', (event) => {
            if (event.which === 27 || event.which === 1) {
                showMovieElement(false, movieList);
            }
        });
    });
};
