#!/bin/sh
[ -f "icons.png" ] || echo "missing source file icons.png" && exit 
[ -d "favicons" ] || mkdir favicons 
echo "starting conversion ..."
convert icon.png -resize 144 favicons/apple-touch-icon-precomposed-144x144.png 
convert icon.png -resize 114 favicons/apple-touch-icon-precomposed-114x114.png
convert icon.png -resize 72 favicons/apple-touch-icon-precomposed-72x72.png
convert icon.png -resize 57 favicons/apple-touch-icon-precomposed-57x57.png
cp icon.png favicons/favicon.png
convert icon.png favicons/favicon.ico
convert favicons/apple-touch-icon-precomposed-114x114.png favicons/favicon.ico
echo "terminating conversion."
