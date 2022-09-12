FROM rabbitmq:3.8-management-alpine

ENV RABBITMQ_USER highload
ENV RABBITMQ_PASSWORD Password@123
ENV RABBITMQ_PID_FILE /var/lib/rabbitmq/mnesia/rabbitmq

EXPOSE 15672

# Define default command
CMD ["/init.sh"]
