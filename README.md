# wrdpress theme
Simple wordpress theme used as backend for the React.js SPA *wordpress-reactSassWebpack* connected via the Wordpress REST API

## Installation
*Project requires Node.js v6+ to run.*

### Install Wordpress
**Download a local wordpress installation**
https://wordpress.org/download/

**Download plugins**
Install and activate plugins:
- ACF 
- ACF to REST API
- WP Rest API

**Import database**
Create a empty database and import tables from SQL file from "database" folder, update wp-config.php file to connect to database. 

### Install theme
Clone/download the theme to you're local repository and place theme it in wordpress/wp-content/themes folder. 

Install the dependencies + devDependencies in theme folder and start server:

```
$ cd yourLocalRepositoryRoot
$ yarn install
$ yarn start

or

$ npm install
$ npm run start
```


