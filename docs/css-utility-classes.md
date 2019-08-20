# Utility Classes

## .container

The `.container` class is intended to provide a defined max width for layout
elments. It is not intended as a wrapper for the content or blocks, as it limits
the `.alignwide` and `.alignfull` classes.

## .inner-container

The `.inner-container` class is intended to provide the spacing for block based
content. It sets a max-width to it's children and handles `.alignwide` and
`.alignfull`. It has some aliases for compatibility, e.g. `.entry-content` and
`[class*="wp-block"] > [class*="__inner-container"]`.

## .stack

see https://every-layout.dev/layouts/stack/
