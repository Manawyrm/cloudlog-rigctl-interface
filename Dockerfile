FROM php:cli-alpine3.16
ARG RIGCTL_HOST
WORKDIR /app
COPY *.php ./
CMD ["php", "/app/rigctlCloudlogInterface.php"]
