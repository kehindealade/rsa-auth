I used a new guard, "Admin", not the "User" guard. 
I could not find laravel ways of storing the RSA encryption in the database, so I modified it manually, please dont
migrate, but import the "admin.sql" in the base directory of laravel. Thanks. The authentication works, registration and logging in and the endpoint that accepts RSA encrypted key and decrypts it. 

The codes are properly commented, Instead of using Laravel's Hash, it nows uses RSA. 

The Public key and the Private keys are in the base directory too. 

Thank you.