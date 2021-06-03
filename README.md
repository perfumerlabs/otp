What is it
==========

This is a container providing one time passwords sending and verifying through sms and email.
This container must be set up in conjunction with [Queue](https://github.com/perfumerlabs/queue), [SMS](https://github.com/perfumerlabs/sms) and [Email](https://github.com/perfumerlabs/email).

Installation
============

```bash
docker run \
-p 80:80/tcp \
-e OTP_QUEUE_URL="http://queue" \
-e OTP_SMS_URL="http://sms" \
-e OTP_SMS_WORKER=sms \
-e OTP_EMAIL_URL="http://email" \
-e OTP_EMAIL_WORKER=email \
-e PG_HOST=db \
-e PG_REAL_HOST=db \
-e PG_PORT=5432 \
-e PG_DATABASE=otp_db \
-e PG_USER=user \
-e PG_PASSWORD=password \
-d perfumerlabs/otp:v2.2.0
```

Environment variables
=====================

- OTP_QUEUE_URL - [Queue](https://github.com/perfumerlabs/queue) service URL. Required.
- OTP_SMS_URL [SMS](https://github.com/perfumerlabs/sms) service URL. Required.
- OTP_SMS_WORKER - worker that handles sms queueing. Required.
- OTP_EMAIL_URL [Email](https://github.com/perfumerlabs/email) service URL. Required.
- OTP_EMAIL_WORKER - worker that handles email queueing. Required.
- PHP_PM_MAX_CHILDREN - number of FPM workers. Default value is 10.
- PHP_PM_MAX_REQUESTS - number of FPM max requests. Default value is 500.
- PG_HOST - PostgreSQL connection host. Required.
- PG_REAL_HOST - PostgreSQL database instance host (not PgBouncer). Required.
- PG_PORT - PostgreSQL port. Default value is 5432.
- PG_DATABASE - PostgreSQL database name. Required.
- PG_SCHEMA - PostgreSQL database schema. Default is "public".
- PG_USER - PostgreSQL user name. Required.
- PG_PASSWORD - PostgreSQL user password. Required.

Volumes
=======

This image has no volumes.

If you want to make any additional configuration of container, mount your bash script to /opt/setup.sh. This script will be executed on container setup.

API Reference
=============

### Send sms OTP

`POST /sms`

Parameters (json):
- ip [string,optional] - IP of requester. Required, if ip limits are set.
- phone [string,required] - phone to send to, without "+".
- password [string,required] - one time password.
- lifetime [integer,required] - lifetime of password, in seconds.
- message [string,required] - SMS message text to send.

Request example:

```json
{
    "ip": "123.123.123.123",
    "phone": "77011234567",
    "password": "12345",
    "lifetime": 300,
    "message": "Your OTP is 12345"
}
```

Success response example:

```json
{
    "status": true
}
```

Failure response examples:

```json
{
    "status": false,
    "status_code": "ip_limit",
    "message": "IP limit has been reached"
}
```

```json
{
    "status": false,
    "status_code": "phone_limit",
    "message": "Phone limit has been reached"
}
```

### Send call OTP

`POST /call`

Parameters (json):
- ip [string,optional] - IP of requester. Required, if ip limits are set.
- phone [string,required] - phone to send to, without "+".
- password [string,required] - one time password.
- lifetime [integer,required] - lifetime of password, in seconds.

Request example:

```json
{
    "ip": "123.123.123.123",
    "phone": "77011234567",
    "password": "12345",
    "lifetime": 300
}
```

Success response example:

```json
{
    "status": true
}
```

Failure response examples:

```json
{
    "status": false,
    "status_code": "ip_limit",
    "message": "IP limit has been reached"
}
```

```json
{
    "status": false,
    "status_code": "phone_limit",
    "message": "Phone limit has been reached"
}
```

### Send email OTP

`POST /email`

Parameters (json):
- ip [string,optional] - IP of requester. Required, if ip limits are set.
- email [string,required] - email to send to.
- password [string,required] - one time password.
- lifetime [integer,required] - lifetime of password, in seconds.
- subject [string,required] - email subject to send.
- text [string,optional] - email text to send.
- html [string,optional] - email html content to send.

Request example:

```json
{
    "ip": "123.123.123.123",
    "email": "foobar@example.com",
    "password": "12345",
    "lifetime": 300,
    "subject": "Hello",
    "text": "Your OTP is 12345"
}
```

Success response example:

```json
{
    "status": true
}
```

Failure response examples:

```json
{
    "status": false,
    "status_code": "ip_limit",
    "message": "IP limit has been reached"
}
```

```json
{
    "status": false,
    "status_code": "email_limit",
    "message": "Email limit has been reached"
}
```

### Check sms OTP

`GET /sms/check`

Parameters (json):
- phone [string,required] - phone, without "+".
- password [string,required] - one time password.

Request example:

```json
{
    "phone": "77011234567",
    "password": "12345"
}
```

Response example:

```json
{
    "status": true
}
```

### Check email OTP

`GET /email/check`

Parameters (json):
- email [string,required] - email.
- password [string,required] - one time password.

Request example:

```json
{
    "email": "foobar@example.com",
    "password": "12345"
}
```

Response example:

```json
{
    "status": true
}
```

### Set SMS limits

`POST /limit/sms`

Parameters (json):
- ips [array,optional] - set of rules for IP.
- phones [array,optional] - set of rules for phones.

Each rule consists of minutes and rate parameter which means "how many tries allowed for number of minutes".

Request example:

```json
{
    "ips": [
        {
            "minutes": 10,
            "rate": 3
        },
        {
            "minutes": 60,
            "rate": 10
        }
    ],
    "phones": [
        {
            "minutes": 10,
            "rate": 3
        }
    ]
}
```

Response example:

```json
{
    "status": true
}
```

### Set CALL limits

`POST /limit/call`

Parameters (json):
- ips [array,optional] - set of rules for IP.
- phones [array,optional] - set of rules for phones.

Each rule consists of minutes and rate parameter which means "how many tries allowed for number of minutes".

Request example:

```json
{
    "ips": [
        {
            "minutes": 10,
            "rate": 3
        },
        {
            "minutes": 60,
            "rate": 10
        }
    ],
    "phones": [
        {
            "minutes": 10,
            "rate": 3
        }
    ]
}
```

Response example:

```json
{
    "status": true
}
```

### Set email limits

`POST /limit/email`

Parameters (json):
- ips [array,optional] - set of rules for IP.
- emails [array,optional] - set of rules for phones.

Each rule consists of minutes and rate parameter which means "how many tries allowed for number of minutes".

Request example:

```json
{
    "ips": [
        {
            "minutes": 10,
            "rate": 3
        },
        {
            "minutes": 60,
            "rate": 10
        }
    ],
    "emails": [
        {
            "minutes": 10,
            "rate": 3
        }
    ]
}
```

Response example:

```json
{
    "status": true
}
```

Software
========

1. Ubuntu 18.04 Bionic
3. Nginx 1.20
4. PHP 7.4

Contributing
============

Feel free to make any pull requests.
