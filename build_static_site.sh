#!/bin/bash

set -e

build() {
    ~/Documents/my_github/shell_scripts/scripts/./build_web_project.sh "$1" "$2" "$3"
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
    cp -r ./public/js/all.js ./docs/js/
    build js ./docs/js/all.js ./docs/js/
}

uncomment() {
    # uncomment the CSP
    sed -i 's/<!-- //' ./docs/index.html
    sed -i 's/ -->//' ./docs/index.html
}

fix_paths() {
    sed -i 's/href="\/javascript"/href="javascript.html"/g' ./docs/index.html

    sed -i 's/js\/all.js"/js\/min.all.js"/g' ./docs/index.html
}

if [ ! -z "$1" ]; then
    "$1"
else
    printf "Usage:\n"
    printf "  ./build_static_site.sh [FUNCTION NAME]\n\n"
    printf "Functions:\n"
    printf "  build_html\n\n"
    printf "  build_css\n\n"
    printf "  build_js\n\n"
    printf "  uncomment\n\n"
    printf "  fix_paths\n\n"
    printf "\n"

    exit 1
fi

