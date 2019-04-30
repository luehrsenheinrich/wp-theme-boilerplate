# Font Loader
Loading fonts on the web can be tricky, especially when we are considering
performance and bandwidth budgets. Traditional font loading techniques often rely
on the browser to cache the file request and handle the font loading.

After a lot of experimentation we have settled on a different approach. Our font
loading is working like this:

1. A non-blocking script is embedded into the header of the page
2. The script checks localstorage, if there is already a version of the fonts stored
3. If no local version of the fonts is found, we start loading it asynchronisly
from webfonts.css and out the result into localstorage
4. The webfonts.css holds the webfonts as base64 encoded string

## Changing the font

While this method is highly efficient in terms of performance, handling these
fonts is unintuitive. Follow these steps if you want to change / update fonts.

1. Add the new woff-fonts-files to `build/fonts` and remove the unneeded files
2. Update the `@font-face` references in `build/less/webfonts.less`
3. Run `npx grunt handle_fonts` to create a new webfonts.css
4. Clear your localstorage in the browser to check if the new fonts are loaded correctly
