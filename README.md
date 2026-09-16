# BileMoApi

## Docker error

### Error when you try to docker-compose down 

#### Error response from daemon: cannot stop container: 0bfb79f9c1e0808c270704751e3d94465bd45009f75139fcd84656f4c5a1e972: permission denied

Use this command to show Pid of the containers : `sudo docker inspect --format '{{.State.Pid}}' symfony_nginx bilemoapi-database-1 symfony_redis symfony_php symfony_mysql`

Kill the containers with this : `sudo kill -9 Pid1 Pid2 Pid3 Pid4 Pid5`

Remove containers : `sudo docker rm -f symfony_nginx bilemoapi-database-1 symfony_redis symfony_php symfony_mysql`

And down the containers : `docker-compose down`


