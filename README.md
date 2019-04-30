# Luehrsen // Heinrich Theme Boilerplate for WordPress

There are probably more theme boilerplates than actual themes available for
bootstrapping your work on an amazing WordPress theme. And that is very much
okay, because every developer, every agency has their own little flavors in how
they like to do things.

That is the reason we made this theme boilerplate. We liked the work of so many
other developers before us, but we never found the perfect boilerplate that fit
our style of work. The result is this, a very opinionated theme boilerplate
based on docker, grunt and less-css.

This boilerplate will give you all the tools you need to write, test and publish
your theme, either for commercial clients or to publish the theme in the
WordPress.org repository.


## Getting started

These steps will guide you through the setup process up until you can start
writing functions, markup and styles for your theme.

For the sake of scope we will assume, that you know the slug of your theme.
Please make sure that the slug is unique to the system of the client, our
projects and the WordPress.org theme repository.

We will also assume, that you have already configured your GitHub repository to
your liking, downloaded the source of the boilerplate and uploaded it to your
new repository. So let's get started:

### Theme Slug & Names

- [ ] Search & Replace `_lhtbp` with your new WordPress theme slug
- [ ] Check success in `package.json`, `docker-compose.json` & `bin/install-wordpress.sh`

### Test & Run

- [ ] Type `npm run setup` into the terminal to spin up the docker enviroment
- [ ] Open `http://localhost/wp-admin` and log in with `wordpress:wordpress`
- [ ] Make sure the theme unit demo content is installed and the theme is active

### Finishing touches

- [ ] Edit the `theme-README.md` with the appropriate text about your theme
- [ ] Delete (or rename) the `README.md` (this file)
- [ ] Rename the `theme-README.md` to `README.md`
- [ ] 🎉  Celebrate!
