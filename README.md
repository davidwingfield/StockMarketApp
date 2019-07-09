# StockApp
## Links

 [Dashboard](http://sem.drumagency.com/SEM/dashboard/scenarios.php)
 
 [MySQL](http://sem.drumagency.com/phpMyAdmin/)
 
###### Documentation

[Class Documentation](http://sem.drumagency.com/SEM/documentation/)

[Data Model](http://sem.drumagency.com/SEM/documentation/database/datamodel.png)

[Wireframe](http://sem.drumagency.com/SEM/documentation/wireframes/wireframe.png)

###### CRON JOB

http://sem.drumagency.com/SEM/shared/build.php

###### MySQL
  user: admin
  pass: password


###### Google Ads Test Accounts:
	email: t.wingfieldsouthern@gmail.com
	pword: Swindon4!
	
	email: t.wingfieldsouthern@gmail.com
	pword: Swindon4!
###### Google Ads PHP client Wrapper
[Link](https://github.com/googleads/google-ads-php)
in order to run the API, you will need to install the Google Ads Client API.
you will also need to then update the google_ads_php.ini file with your developer token, client Id Client Secret and Refresh Token


###### Google Ads PHP client Wrapper
Setting the values for the database as well as the values for the interval is done in the
sem_api_php.ini file located under SEM/src

###### TODO
	dashboard
		disable buttons when nothing to change

	market
		change: add to all devices regardless if there is a bid adjustment set up right now it only changes bids that are set in the google ads dashboard
