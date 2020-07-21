# cals-global
 CALS Global Wordpress theme

This is the theme for the CALS Global website.

To Get Started:

1. Download the repo.

2. Navigate to the theme directory and run "npm install" to get all necessary packages.

3. Adjust the proxyTarget configuration to whatever you use for a local wordpress site. In the following example I have set up local by flywheel with a site at http://multisite2.local

Step 1: edit resources/compiler/config.js
Step 2: change "proxyTarget" value to the url of your local site (example: http://multisite2.local) and save your changes.

4. Run "npm run serve" to see your site in the browser. When you make changes to your sass or js files the changes will appear automatically in the browser without a refresh needed.

5. When you are ready to commit any changes for deployment, run "npm run build". This will process the files and place them in the root assets folder ready to be used on the site.

Notes

- Make sure you actually put the theme directory into your Wordpress site and activate the theme. :)

- This theme needs the Advanced Custom Fields (ACF) plugin.
