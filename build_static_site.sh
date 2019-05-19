#!/bin/bash

set -e

build() {
    ~/Documents/my_github/shell_scripts/scripts/./build_web_project.sh "$1" "$2" "$3"
}

uncomment() {
    # uncomment the CSP
    sed -i 's/<!-- //' ./docs/index.html
    sed -i 's/ -->//' ./docs/index.html
}

fix_paths() {
    sed -i 's/\/css\/main.css/css\/main.css/g' ./docs/index.html

    sed -i 's/href="\/javascript"/href="javascript.html"/g' ./docs/index.html

    sed -i 's/\/js\/index.js"/js\/min.index.js"/g' ./docs/index.html
}

build_html() {
    build html ./docs/index.html ./docs/
    cp ./templates/javascript.html ./docs/
    build html ./docs/javascript.html ./docs/
}

build_css() {
    cp -r ./public/css/main.css ./docs/css/
    uncss --ignore '.md\:flex' ./docs/index.html > ./docs/css/main.css
    build css ./docs/css/main.css ./docs/css/
    cp ./public/css/tachyons.min.css ./docs/css/
}

build_js() {
    cp -r ./public/js/index.js ./docs/js/
    build js ./docs/js/index.js ./docs/js/
}

first_build() {
    uncomment
    fix_paths
    build_html
    build_css
    build_js
}

update_build() {
    uncomment
    fix_paths
    build_html
}

if [ ! -z "$1" ]; then
    "$1"
else
    printf "Usage:\n"
    printf "  ./build_static_site.sh [FUNCTION NAME]\n\n"
    printf "Grouped functions:\n"
    printf "  first_build — when building for the first time\n\n"
    printf "  update_build — after updating the site with new movies\n\n"
    printf "Functions:\n"
    printf "  uncomment\n\n"
    printf "  fix_paths\n\n"
    printf "  build_html\n\n"
    printf "  build_css\n\n"
    printf "  build_js\n\n"
    printf "\n"

    exit 1
fi

