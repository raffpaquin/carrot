# Carrot

Carrot is a task queuing wrapper develop in PHP using the AMPQ protocol. It's currently released open source in a  BETA version. 

## How it works

**Create a new task**

```
./bin/task.php -event order -payload '{"mode":"test"}'
```




**Start a worker**

```
./bin/worker.php -queue \\Worker\\MyModule\\MyClass
```


## Queue Configuration
You can edit your `etc/carrot.ini` file to control you dispatch rules between your events and queues. This is an example dispatch file dispatching only one event to 2 different queue.


```
TODO
```


## RabbitMQ Server Config

You can edit `etc/server.ini` file with up to 3 diffenrent environment. This is a example config file with only one `prod` running environement.

```
[prod]
user = 	guest
pass = 	guest
host = 	localhost
port = 	5672
vhost = /local
```