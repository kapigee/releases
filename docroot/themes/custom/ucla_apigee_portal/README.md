# Getting Started

This theme is for the UCLA Apigee Portal built on SiteFarm Seed.

## Prerequesites 

You'll need [node.js](http://nodejs.org).


## Install and setup
    
From this theme directory, run this to install dependencies:

    $ npm ci

You may have to run that again for updates; so it may be wise to save this: `$ npm ci`. **If you have any problems; this is the first thing to run.**

Finally, to do an initial build of the site and start watching for changes run `npm start`.

```
$ npm start
```

## Sync Pattern Lab styles by importing into site

1. Add the following code into a `gulp-config.local.yml` file and set the `src` to the location of the external Pattern Lab:

```yaml
themeSync:
  enabled: true
  src: ./siteden-patternlab
```

2. Run the themesync gulp task to import styles from Pattern Lab and compile them:

```
$ npm run themesync
```

3. Compile and watching:

```
$ npm start
```

## Assets (CSS & JS)

Sass and Javascript will be automatically compiled into a `/dist/` directory.

To add either CSS or JS third party libraries, use one of these methods:


### Externally loaded Javascript Dependencies

If a Javascript package will be loaded externally (perhaps by a CDN) then you can specify this in config so that Webpack will not add the package into the compiled Javascript file.

```yaml
js:
  externals:
    jquery: 'jQuery'
```

### Local Gulp Configuration

Gulp configuration can be customized to a local environment by creating a `gulp-config.local.yml` file. Any custom config specific to a local setup can be placed in here and it will not be committed to Git.

Project configuration is found in `gulp-config.yml`. You can copy out config you want to change into your custom file. This file overrides default config in [https://github.com/ucdavis/ucd-theme-tasks/blob/master/config.default.js](https://github.com/ucdavis/ucd-theme-tasks/blob/master/config.default.js)

### Gulp Tasks

There are 4 main gulp tasks you should be aware of. Just add `npx gulp` before each task like `$ npx gulp help`.

1. **Help** - Displays a list of all the available tasks with a brief discription of each
2. **Default** - Generate the entire site and start watching for changes to live reload in the browser
3. **Compile** - Generate the entire site with all assets such as css and js
4. **Validate** - Validate CSS and JS by linting

`$ npx gulp` is the one most often used and is the same as `$ npx gulp default`

### Using Gulp with PHPStorm

PHPStorm has [Gulp Tool Window](https://www.jetbrains.com/phpstorm/help/gulp-tool-window.html) for easy use of Gulp tasks.
Right-click on the `gulpfile.js` file and choose `Show Gulp Tasks` to open the window.

Double click `default` to start gulp and begin watching files for changes.

You can double click `help` to see descriptions of available tasks

### BrowserSync

BrowserSync is being used by Gulp to allow live reloading so that changes will be injected automatically into the site without having to reload.

## Windows Users

If you are on Windows you may run into a few issues.

It is recommended you use [Git for Windows](http://git-for-windows.github.io/).

If you get an alert saying that Google Chrome can't run, try passing in a different browser string into your `gulp-config.local.yml` file.

```yaml
browserSync:
  browser: ['chrome']
```
