var movieTitle = function (movieData) {
    var title;
    title = movieData.replace(/(\|\s\d{4})/g, '');
    title = title.trim();
    title = title.toLowerCase();
    return title;
};
var toggleSearchBox = function (movieNumber, searchBox) {
    movieNumber.classList.toggle('hidden');
    searchBox.classList.toggle('hidden');
};
var showMovieElement = function (show, movieElement) {
    if (show) {
        movieElement.classList.remove('hidden');
    }
    else {
        movieElement.classList.add('hidden');
    }
};
var searchMoviesBy = function (searchString, movies) {
    movies.map(function (movie) {
        var title = movieTitle(movie.textContent);
        var charsToSearchFor = searchString.toLowerCase();
        if (title.indexOf(charsToSearchFor) > -1) {
            showMovieElement(true, movie);
        }
        else {
            showMovieElement(false, movie);
        }
    });
};
var movieSearch = function () {
    var searchButton = document.querySelector('.search-button');
    var movieNumber = document.querySelector('.movie-number');
    var searchBox = document.querySelector('input[type="search"]');
    var movieList = document.querySelector('.movie-list');
    searchButton.addEventListener('click', function () {
        toggleSearchBox(movieNumber, searchBox);
        showMovieElement(false, movieList);
    });
    var movies = [].slice.call(document.querySelectorAll('.movie-list p'));
    searchBox.addEventListener('keyup', function () {
        showMovieElement(true, movieList);
        searchMoviesBy(searchBox.value, movies);
        document.addEventListener('keyup', function (event) {
            if (event.which === 27 || event.which === 1) {
                showMovieElement(false, movieList);
            }
        });
        document.addEventListener('click', function (event) {
            if (event.which === 27 || event.which === 1) {
                showMovieElement(false, movieList);
            }
        });
    });
};
var main = function () {
    movieSearch();
};
main();
