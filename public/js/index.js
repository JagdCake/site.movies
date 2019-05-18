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
var showSection = function (show, section) {
    if (show) {
        section.classList.add('bg-red-pink');
        section.classList.add('md:flex');
        section.style.height = section.scrollHeight + "px";
    }
    else {
        section.style.height = '0';
        setTimeout(function () {
            section.classList.remove('md:flex');
            section.classList.remove('bg-red-pink');
        }, 400);
    }
    return show;
};
var replaceImage = function (image, newImageSrc) {
    image.setAttribute('src', newImageSrc);
};
var aboutSection = function () {
    var toggleButton = document.querySelector('.about-button');
    var buttonIcon = toggleButton.querySelector('img');
    var buttonOriginalIcon = buttonIcon.getAttribute('src');
    var buttonCloseIcon = 'images/close.svg';
    var section = document.querySelector('.about');
    var sectionDisplayed = false;
    toggleButton.addEventListener('click', function () {
        if (!sectionDisplayed) {
            sectionDisplayed = showSection(true, section);
            replaceImage(buttonIcon, buttonCloseIcon);
        }
        else {
            sectionDisplayed = showSection(false, section);
            replaceImage(buttonIcon, buttonOriginalIcon);
        }
    });
};
var toggleBackToTopButton = function (currentScrollPosition, button) {
    if (currentScrollPosition >= 1200) {
        button.classList.remove('hidden');
    }
    else {
        button.classList.add('hidden');
    }
};
var misc = function () {
    var buttonUp = document.querySelector('.go-up');
    window.addEventListener('scroll', function () {
        setInterval(function () {
            var verticalScrollPosition = window.pageYOffset;
            toggleBackToTopButton(verticalScrollPosition, buttonUp);
        }, 1000);
    });
};
var main = function () {
    movieSearch();
    aboutSection();
    misc();
};
main();
