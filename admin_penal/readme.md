<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
	<p>PHP Version ^7.2.5|^8.0 </p>
	<p>Laravel Framework 8.0 </p>
</p>

## Note (For ubuntu users only)
- To give full permissions/access to project folder, Open terminal ( **Ctrl + Alt + t** )

      sudo chmod -R a+rwx  /opt/lampp/htdocs/Project Name
      
- To give full permissions/access to specific folder, Example : 

      sudo chmod -R a+rwx  /opt/lampp/htdocs/Project Name/storage/logs
  
## Project installation steps

- Step 1 : composer update
- Step 2 : composer dumpa
- Step 3 : php artisan key:generate
- Step 4 : php artisan storage:link
- Step 5 : ./clean-up.sh


      
## Default setting keys

- application_logo : For all Admin_Panel and app logo
- favicon_logo : For Admin_Panel and app favicon image
- application_title : For Admin_Panel Site Name Change
- loader_logo : For Admin_Panel Loader Logo Images

## Define .env mailtrap Email And Password

- MAIL_MAILER=smtp
- MAIL_HOST=smtp.mailtrap.io
- MAIL_PORT=2525
- MAIL_USERNAME=144672c78128e2
- MAIL_PASSWORD=2ac32efa5350de
- MAIL_ENCRYPTION=tls