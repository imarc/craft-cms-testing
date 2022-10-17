# Craft Site Testing with Codeception and Cypress

This document describes the process for adding Codeception and Cypress testing for an existing site on Craft CMS (Craft added support for Codeception testing beginning with v3.2). The repository contains example tests copied from *asc-es.com* in the **/tests** and **/cypress** folders as well as some example configuraton files. 

**This project is a work in progress. We will continue updating it as our experience and best practices evolve.**

## Craft/Codeception 

[Codeception](https://codeception.com/) extends [PHP Unit](https://phpunit.readthedocs.io/en/9.5/index.html) testing. It supports 3 types of tests. 

 - ***Unit tests*** are run with **PHP Unit** and have direct access to all of the application's PHP code. Unit tests are best suited to testing your plugin and module functions.
 - ***Functional tests*** run by fetching the raw HTML from a page using **PhpBrowser** (leverages CURL). Functional tests are fast because they only look at raw HTML, but they don't support testing anything that uses javascript, cookies, etc.
 - ***Acceptance tests*** run by loading the page into a **WebDriver** browser (leverages Chromedriver or Selenium server). Acceptance tests can test everything, but are slower because they run through a browser engine.

 *(LINNEA: I think Unit tests make sense for some modules & plugins, but for a lot of them, when they're dealing so much with the guts of Craft, unit testing either ends up testing craft, or becomes so cumbersome to mock that it may not be worth it)*

### Installing Codeception

    composer require codeception/codeception --ignore-plaftorm-reqs
    ./craft tests/setup

Copy your **.env** file to **tests/.env**

Copy **app.php**, **general.php**, **routes.php** and any other config files from ***config*** to the ***tests/_craft/config***

*(LINNEA: No need to copy over config folders though.)*

*(Bill: I should probably reword this to say "any plugin-specific PHP config files".)*

Confirm that the environment variable names you set in your **.env** match those configured in **tests/_craft/config/db.php**

Edit **codeception.yml** and change `entryUrl: 'https://your-site-url.test/index.php'` to match the URL of your test environment. 

    entryUrl: 'https://asc-es.imarc.io/index.php'

Update the ***tests/_bootstrap.php*** file to point your site templates instead of the default template file generated by `./craft tests/setup`

    define('CRAFT_TEMPLATES_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates');

You'll probably want to add the following to your gitignore file:

 - */tests/.env*
 - */tests/_craft/storage*
 - */tests/_output*

#### Codeception 3 vs Codeception 4

If your site's current Craft version uses Codeception 3 and you installed Codeception 4 you'll run into errors related to missing packages when you run tests. Codeception 4 separated some functionality into separate modules which you may need to add separately using composer. A future version of Craft will require Codeception 4 and the necessary dependencies. Run the following composer require statements to resolve the errors.

    composer require codeception/module-yii2 --ignore-platform-reqs
    composer require codeception/module-asserts --dev --ignore-platform-reqs

### Configuration Notes

#### Project Config

Modify the configuration in the **codeception.yml** file in your project root.

If your site uses project config don't copy the **config/project folder** to **tests/_craft/config**. You should specify the path to your site's config file in the *codeception.yml* file and set reset: true.

    projectConfig: {folder: '/config/project'}
    reset: true

#### Fixtures

When running tests without a database you'll probably need to include some fixture files for populating data. Add a **tests/fixtures** folder and a **tests/fixtures/data** subfolder. Your fixture file gets added to the fixtures folder and it's corresponding data file gets added in the subfolder.

Relavent documentation can be found here: https://craftcms.com/docs/4.x/testing/testing-craft/fixtures.html

Be sure to add the namespace to the autoload in your `composer.json` file, then run `composer dumpautoload` to add your new fixture to the class map. The documentation overlooks this fact but most of the tests subfolders get parsed by composer when running autoload, but this folder does not unless you specifically add it to the class map.

    "autoload": {
        "psr-4": {
            "modules\\": "modules/",
            "tests\\fixtures\\": "tests/fixtures"
        }
    }

#### Database

The `./craft tests/setup` command adds configuration to set up an empty Craft database by default. This will generate a clean Craft install with none of your site content when it initiates testing. This is valuable if your site uses project config and you plan to mock all of the site data to test tools. 

    dbSetup: {clean: true, setupCraft: true}

The `clean` option will drop all of the existing tables from the database and the `setupCraft` option will 

If you don't have project config enabled or you plan to run tests against actual site content you'll need to configure the database to use your local db.

    dbSetup: {clean: false, setupCraft: false}

### Running Tests

**Unit test file names should end in ...Test.php, while functional and acceptance tests should end in ...Cest.php to conform with PHPUnit and CodeCeption convention respectively. Failing to name your tests according to convention may result in tests not being run as expected.**

When running tests in your local ops environment you can do so directly from inside the ops shell. You may run all tests together or run specific test suites (unit, functional, acceptance), specific test files, or even specific test functions. The [documenation](https://codeception.com/docs/02-GettingStarted#Running-Tests) has more information about that in detail.

    ops shell
    vendor/bin/codecept run {suiteName {testFileName}} {--debug}

You can also add/modify an ops-commands.sh file to add a function for passing the commands through ops to the shell. The following function will pass codeception commands and flags through to the shell and run them using vendor/bin/codecept as above.

    // /ops-commands.sh
    ops-codecept() {
        cmd-doc "Run codeception tests."
        ops shell vendor/bin/codecept "$@"
    }

Now you can execute your tests using:

    ops codecept run {suiteName {testFileName}} {--debug}

#### Acceptance Tests

The `./craft tests/setup` command installs the framework for basic unit and functional tests. More advanced Acceptance testing should be done using Cypress if possible. If you need Codeception based acceptance tests, you'll need to add an **acceptance.suite.yml** file to configure WebDriver and a **tests/acceptance** folder to hold your test files.

*(LINNEA: I actually found that it could run at least the simple acceptance tests I wrote after the above configuration steps, but I agree that Cypress is easier to use)*

### TODO

 - Document the process of configuring WebDriver to support acceptance tests

----------

### References:

 - [Craft Testing Setup](https://craftcms.com/docs/3.x/testing/testing-craft/setup.html)
 - [Introduction to Codeception](https://codeception.com/docs/01-Introduction)
 - [Running Tests](https://codeception.com/docs/02-GettingStarted#Running-Tests)
 - [Writing PHP Unit Tests](https://phpunit.readthedocs.io/en/9.5/writing-tests-for-phpunit.html)

## Cypress

Cypress is a javascript based, end-to-end testing suite which runs using NPM.

### Install and Configuration

Cypress uses software that's installed on your computer and an NPM package to execute it. Install the Cypress testing software on your computer, then use NPM to install Cypress package. 

- [Instructions](https://docs.cypress.io/guides/getting-started/installing-cypress)

The install will create a /cypress folder structure. You save your test files in the `cypress/e2e` folder on Cypress v10 and `cypress/integration` folder in older versions. The install loads the folder with numerous example files which can be a valuable reference for writing your own tests. If you wish to keep them it's best to move them to a separate examples folder to avoid running them with your own site tests.

    cp -r cypress/e2e/ cypress/examples
    rm -r cypress/e2e/*
    
*(LINNEA: Cypress doesn't create these files until you run it for the first time.)*

You can set testing global and environment variables in the `cypress.json` file. Example:
    
    // /cypress.json
    {
        "requestTimeout":6000,
        "env": {
            "LOGIN_PATH": "/account/login",
            "LOGOUT_PATH": "/account/logout"
        }
    }

    // /cypress/e2e/your-test.js
    describe('My Test', () => {
        it('Test Homepage', () => {
            cy.visit('/')
            ...
        })
        it('Test Login', () => {
            cy.visit(Cypress.env('LOGIN_PATH'))
            ...
        })
        ...

**DO NOT SAVE PASSWORDS OR PRIVATE API KEYS** in the cypress.json file if it is committed to the repository (and it probably should be). If you have them set in your local .env file you can configure them for cypress using a [plugin](https://docs.cypress.io/guides/guides/environment-variables#Option-5-Plugins). The easiest way to do this is to modify the example `cypress/plugins/index.js` file. Just paste the following into the file generated by the NPM install: 
    
    // /.env
    DEFAULT_SITE_URL="https://yourdomain.imarc.io/"
    CYPRESS_LOGIN_NAME="name@yourdomain.com"
    CYPRESS_LOGIN_PASSWORD="user password here"


    // /cypress/plugins/index.js
    require('dotenv').config()

    /**
     * @type {Cypress.PluginConfig}
     */
    // eslint-disable-next-line no-unused-vars
    module.exports = (on, config) => {
        // `on` is used to hook into various events Cypress emits
        // `config` is the resolved Cypress config

        // copy any needed variables from process.env to config.env
        config.baseUrl = process.env.DEFAULT_SITE_URL

        config.env.CYPRESS_LOGIN_NAME = process.env.CYPRESS_LOGIN_NAME
        config.env.CYPRESS_LOGIN_PASSWORD = process.env.CYPRESS_LOGIN_PASSWORD

        // do not forget to return the changed config object!
        return config
    } 

When you run tests Cypress will create folders for screenshots and videos. Add the following to your .gitignore file.

 - */cypress/screenshots*
 - */cypress/videos*

### Testing Notes

Now you can open Cypress from your project root one of the following ways:

    ./node_modules/.bin/cypress open

    $(npm bin)/cypress open

Use the *cypress run* command to run all of the tests in the **cypress/e2e** folder, or use the `-s --spec` flags to specify a specific test file

    $(npm bin)/cypress run

    $(npm bin)/cypress run -s cypress/e2e/my-test.cy.js

#### Testing Logged In User State

Testing logged in users will run very slowly if you need to fill out the log in form at the beginning of every test. There is a beta version of a cypress session handler which you can implement to handle your logins. This allows you to run multiple tests on one login. [This article](https://www.cypress.io/blog/2021/08/04/authenticate-faster-in-tests-cy-session-command/) explains it in more detail. 

If you followed the configuration instructions above to set your testing login name/password variables from your .env file you can use this code example.

    // /cypress/suppport/commands.js

    Cypress.Commands.add('login', (username, password) => {
        cy.session([username, password], () => {
            cy.visit(Cypress.env('LOGIN_PATH'))
            cy.get('.login form')
                .find('input[name=username]')
                .type(username)
            cy.get('.login form')
                .find('input[type=password]')
                .type(password)
            cy.get('.login form').submit()
            cy.location('pathname').should('include', 'account') // Validate that the logged in user has been redirected to the /account page
        })
    })

You can now reference the `cy.login` function from your tests and call it from anywhere you need it. **Remember to enable the `experimentalSessionSupport` flag** in your test file.
    
    // /cypess/e2e/your-test-file.js

    Cypress.config('experimentalSessionSupport', true)

    describe('Test Logged In User', () => {
        beforeEach(() => {
            cy.login(Cypress.env('CYPRESS_LOGIN_NAME'), Cypress.env('CYPRESS_LOGIN_PASSWORD'))
        })

        it('Update Profile', () => {
            cy.visit('/account/my-profile')
            cy.get('form.profile #zipCode').type('01913')
            cy.get('form.profile').submit()
        })

        it('Update Profile', () => {
            cy.visit('/account/dashboard')
            ...
        })
    })

### References:
 - [Introduction to Cypress](https://www.cypress.io/how-it-works/)
 - [Cypress Documentation](https://docs.cypress.io/guides/getting-started/installing-cypress)

## Automated Testing and Continuous Integration

There are several options for doing continuous integration. 

### Buddy

You can run tests on Buddy as part of a continuous deployment process.

#### Running Cypress tests on Buddy deployment

1. Add the environment variables you configured in `/cypress/plugins/index.js` to the Buddy project or pipeline. In the example configuration above we configured *DEFAULT_SITE_URL*, *CYPRESS_LOGIN_NAME*, and *CYPRESS_LOGIN_PASSWORD*.     

    Define project variables that are the same for all pipelines

        CYPRESS_LOGIN_NAME  test@imarc.com  (settable, plain text)
        CYPRESS_LOGIN_PASSWORD  "***********" (settable, encrypted)

    Define pipeline specific variables. If the pipeline you wish to test has **basic authentication enabled** you'll need to configure the URL for the pipeline to contain the auth credentials. We recommend using a specific variable with a CYPRESS_ prefix for this. 

    The format for passing basic authentication credentials as part of the base url is **http://username:password@domain**

        CYPRESS_SITE_URL https://username:password@dev.yourdomain.com (settable, plain text)

    Modify the plugin file that sets environment variables to work on buddy or locally

            // /cypress/plugins/index.js

            ...
            config.baseUrl = process.env.CYPRESS_SITE_URL ? process.env.CYPRESS_SITE_URL : process.env.DEFAULT_SITE_URL
            ...

2. Add a Cypress action to the Buddy deployment pipeline(s) you want to test. By default this will create a node environment using cypress/base @latest. If the project deployment environment specifies a fixed version, this step should be configured to use the same version as the regular deployment. By default, this will also be configured to use a cache rather than doing a clean install. The cache setting should also match the regular deployment environment.

We recommend setting up a testing step on UAT and DEV.

        npm install
        npm install cypress
        $(npm bin)/cypress run 


### Gitlab Pipeline

You can run tests on Gitlab when you push a commit to a branch. This is done by adding a YAML configuration file named **.gitlab-ci.yml** at the root level of your project. 

### TODO

- Determine best practices for when/how to run tests automatically and document how to implement the process here.
