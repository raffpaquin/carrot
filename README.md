https://www.codeship.io/projects/99d71b80-603f-0131-895d-3e668197b56e/status

# Carrot

Carrot is a task queuing wrapper develop in PHP using the AMPQ protocol. It's currently released open source in a  BETA version. 

## How it works

**Create a new task**

```
bin/task.php -event mybiz.example.event -payload '{"message":"hello world"}'
```




**Start workesr**

```
bin/worker.php -queue \\Workers\\Example1 &
bin/worker.php -queue \\Workers\\Example2 &
```


## Queue Configuration
You can edit your `etc/carrot.ini` file to control you dispatch rules between your events and queues. This is an example dispatch file dispatching only one event to 2 different queue.


```
;Define the event key
[mybiz.example.event]

;Name the event for the web interface
name = An example event

;Define each worker that will process this event
queues[] = \Workers\Example1
queues[] = \Workers\Example2
```


## RabbitMQ Server Config

You can edit `etc/server.ini` file with up to 3 diffenrent environment. This is a example config file with only one `prod` running environement.

```
[prod]
user = 	guest
pass = 	guest
host = 	localhost
port = 	5672
vhost = /prod
```
