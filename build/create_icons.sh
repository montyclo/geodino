#!/bin/sh
convert images/icon.png -resize 144 images/favicons/apple-touch-icon-precomposed-144x144.png 
convert images/icon.png -resize 114 images/favicons/apple-touch-icon-precomposed-114x114.png
convert images/icon.png -resize 72 images/favicons/apple-touch-icon-precomposed-72x72.png
convert images/icon.png -resize 57 images/favicons/apple-touch-icon-precomposed-57x57.png
cp images/icon.png images/favicons/favicon.png
convert images/icon.png images/favicons/favicon.ico
convert images/favicons/apple-touch-icon-precomposed-114x114.png images/favicons/favicon.ico
