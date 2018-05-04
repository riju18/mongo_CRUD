# mongo_CRUD
# advantage:
    * no-sql
    * schema free
    * rich queries
    * auto created id
    * No complex joins
   
 # in php:
    any operation can be done by just by asociative array format ( key-value format )
 # in js:
     just json format
# insatallation:
   # php:
         * download latest version: https://pecl.php.net/package/mongodb (as php version)
         * download & install composer
         * set environment variable path of composer
         * download & install mongodb: https://www.mongodb.com/
         * set environment variable path of mongo
   # project create:
         * create a folder in wamp or xampp;
         * goto that folder & open terminal & type: composer require mongodb/mongodb
   # for mongodb gui method:
         * open stdio 3T;
         * open terminal & type mongod; if not works type mongod.exe
         * set connection name & click connect;
   #  for mongodb cli method
         * open another terminal & type mongo
         * a connection will be created on port 27017 by default;
   # database set:
     for gui method: select intellishell & type as following:
         * set db:           use profile
         * set collection:   db.createCollection('information')
     for cli method: in last opened terminal type as above
     
     // profile is a db & information is a collection name
      
# done         
         
