'use strict';

// Section: search the movie list
function results() {
    const movies = document.querySelectorAll('.movie-list p');
    const noResults = document.querySelector('.no-results');

    for(let movie of movies) {
        let result = movie.textContent;

        if(result.replace(/(\|\s\d{4})/g, '').toLowerCase().indexOf(searchInput.value.toLowerCase()) > -1) {
            movie.classList.remove('hidden');
            movie.classList.add('block');
        }else {
            movie.classList.remove('block');
            movie.classList.add('hidden');
        }
    }

    let displayedMovies = false;

    for(let movie of movies) {
        if(movie.classList.contains('block')) {
            displayedMovies = true;
        }
    }

    if(displayedMovies === false) {
        noResults.classList.remove('hidden');
        noResults.classList.add('block');
    }else {
        noResults.classList.remove('block');
        noResults.classList.add('hidden');
    }
}

const movieNumber = document.querySelector('.movie-number');
const movieList = document.querySelector('.movie-list');
const searchButton = document.querySelector('.search-button');
const searchInput = document.querySelector('input[type="search"]');

// show / hide the search box when you click on the search button
searchButton.addEventListener('click', () => {
    movieNumber.classList.toggle('hidden');
    searchInput.classList.toggle('hidden');
    if(!movieList.classList.contains('hidden')) {
        movieList.classList.toggle('hidden');
    }
});

// hide the movie list when you click (anywhere) / press enter or escape
function hideListIfEvent(event) {
    if(event.which === 27 || event.which === 1) {
        movieList.classList.add('hidden');
        document.removeEventListener('keyup', hideListIfEvent);
        document.removeEventListener('click', hideListIfEvent);
    }
}

// show the movie list when you start typing in the search box
searchInput.addEventListener('keyup', () => {
    results();
    if(movieList.classList.contains('hidden')) {
        movieList.classList.remove('hidden');
    }

    document.addEventListener('keyup', hideListIfEvent);
    document.addEventListener('click', hideListIfEvent);
});

// Section: display / hide about div
const aboutButton = document.querySelector('.about-button');
let aboutToggle = false;

aboutButton.addEventListener('click', () => {
    const about = document.querySelector('.about');
    const aboutImg = aboutButton.querySelector('img');

    if(!aboutToggle) {
        about.classList.remove('hidden');
        about.classList.add('md:flex');
        about.style.height = `${about.scrollHeight}px`;
        aboutImg.setAttribute('src', 'images/close.svg');
        aboutToggle = true;
    }else {
        about.style.height = 0;
        setTimeout(() => {
            about.classList.remove('md:flex');
            about.classList.add('hidden');
        }, 400);
        aboutImg.setAttribute('src', 'images/about.svg');
        aboutToggle = false;
    }
});

// Section: show 'back to top' button
window.addEventListener('scroll', () => {
    const buttonUp = document.querySelector('.go-up');

    if(window.pageYOffset >= 1200) {
        buttonUp.classList.remove('hidden');
        buttonUp.addEventListener('click', () => {
            document.documentElement.scrollTop = 0;
        });
    }else {
        buttonUp.classList.add('hidden');
    }
});

// Section: lazy load posters
// Source: https://developers.google.com/web/fundamentals/performance/lazy-loading-guidance/images-and-video/#inline_images
// document.addEventListener('DOMContentLoaded', () => {
    // let lazyImages = [].slice.call(document.querySelectorAll('.lazy'));
    // let active = false;
//
    // const lazyLoad = () => {
        // if (active === false) {
            // active = true;
//
            // setTimeout(() => {
                // lazyImages.forEach((lazyImage) => {
                    // if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== 'none') {
                        // lazyImage.src = lazyImage.dataset.src;
                        // lazyImage.classList.remove('lazy');
//
                        // lazyImages = lazyImages.filter((image) => {
                            // return image !== lazyImage;
                        // });
//
                        // if (lazyImages.length === 0) {
                            // window.removeEventListener('load', lazyLoad);
                            // document.removeEventListener('scroll', lazyLoad);
                            // window.removeEventListener('resize', lazyLoad);
                            // window.removeEventListener('orientationchange', lazyLoad);
                        // }
                    // }
                // });
//
                // active = false;
            // }, 200);
        // }
    // };
//
    // window.addEventListener('load', lazyLoad);
    // document.addEventListener('scroll', lazyLoad);
    // window.addEventListener('resize', lazyLoad);
    // window.addEventListener('orientationchange', lazyLoad);
// });
//
// Section: Fonts Optimization for Repeat Views
// Source: https://github.com/zachleat/web-font-loading-recipes/blob/master/critical-foft-data-uri.html
(function() {
    if('fonts' in document) {
        if(sessionStorage.fontsLoadedCriticalFoftDataUri) {
            document.documentElement.className += ' oswald';
            return;
        }

        document.fonts.load('Slackey').then(function () {
            document.documentElement.className += ' slackey';

            Promise.all([
                document.fonts.load('Slackey'),
                document.fonts.load('Oswald')
            ]).then(function () {
                document.documentElement.className += ' oswald';

                sessionStorage.fontsLoadedCriticalFoftDataUri = true;
            });
        });
    }
})();
