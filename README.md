# Dependencies
```bash
$ pear install HTTP_Request2 
```
see http://pear.php.net/package/HTTP_Request2

# Create a GitHub application
https://github.com/settings/applications

# Update your conf
Copy the config-sample.php to config.php
Edit it to add your settings.
Create a virtualhost in Apache pointing to the htdocs directory as the documentroot.
Do an Apache restart.
Edit your /etc/hosts file to point your 'base url' to localhost.

# Run the application
Visit your base URL in a web browser.
Click the link to generate a new token.
You will be redirected to GitHub.
Login and authorize the application.
You will be redirected back to the application and the new token will be displayed.
The token is stored in a cookie and will show up on the application's index page until the cookie expires. (So clear your cookie if you don't want this sensitive data to be lingering.)

# Done!
You can now use your OAuth token to run git commands. See https://github.com/blog/1270-easier-builds-and-deployments-using-git-over-https-and-oauth