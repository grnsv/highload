#!/bin/sh

# Create Rabbitmq user
( rabbitmqctl wait --timeout 60 $RABBITMQ_PID_FILE ; \
rabbitmqctl add_user $RABBITMQ_USER $RABBITMQ_PASSWORD 2>/dev/null ; \
rabbitmqctl set_user_tags $RABBITMQ_USER administrator ; \
rabbitmqctl set_permissions -p / $RABBITMQ_USER ".*" ".*" ".*" ; \
echo "*** User '$RABBITMQ_USER' with '$RABBITMQ_PASSWORD' created. ***" ; \
echo "*** Log in the WebUI at port 15672 (example: http://localhost:15672) ***") &
rabbitmq-server $@
