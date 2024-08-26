
Email viewer for debugging with Localstack Community Edition.

![gif](https://un4dc.com/images/demo-mail-viewer.gif)

## Requirement

- node@^18

## Installation: only mail viewer

If you're already using Localstack with ses, just do:
```
cd community-ui
yarn install
yarn serve:proxy
```

Then access to http://localhost:3003/

## Installation: localstack

```
cd docker
cp .env.example .env
```

- Edit .env
```ini
COMPOSE_PROJECT_NAME=docker
LOCALSTACK_VOLUME_DIR=localstack-debug
AWS_ACCESS_KEY=localstack
AWS_SECRET_KEY=localstack-secret
AWS_SECRET_ACCESS_KEY=localstack-secret
DEFAULT_REGION=ap-northeast-1
SES_VERIFY_EMAILS=localstack-debug@example.com,any@example.com
S3_DEFAULT_BUCKET=localstack-debug
SERVICES=s3,ses
```
NOTE: For access from other container you should add network 'localstack-c6y' to your compose.yml

```
docker network create localstack-c6y-net
cd docker
docker compose up --build
```

- Check available services.
  > curl -X GET http://127.0.0.1:4566/_localstack/health | jq .

```
docker exec -it localstack-c6y /bin/bash
```

- Check default bucket are created.
  > awslocal s3 ls
- Check SES verified identities.
  > awslocal ses list-identities --region ap-northeast-1 <br>
  
  If list is empty, add one using region and email address you want to set up. (NOTE: **Region option is required.**)
  > awslocal ses verify-email-identity --region ap-northeast-1 --email-address localstack-debug@example.com

## Commands you might use

- Retrieving and deleting emails received in SES
  > curl -X GET http://127.0.0.1:4566/_aws/ses | jq . <br>
  > curl -X DELETE http://127.0.0.1:4566/_aws/ses?id={message-id}

## With Laravel

config/mail.php
```php
    'ses' => [
        'transport' => 'ses',
        'endpoint' => env('AWS_ENDPOINT'),
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION'),
    ],
```

.env
```ini
AWS_ACCESS_KEY_ID=localstack
AWS_SECRET_ACCESS_KEY=localstack-secret
AWS_DEFAULT_REGION=ap-northeast-1
AWS_BUCKET=localstack-debug
AWS_USE_PATH_STYLE_ENDPOINT=true
AWS_ENDPOINT=http://localstack:4566

MAIL_MAILER=ses
MAIL_FROM_ADDRESS=localstack-debug@example.com
```

NOTE:
> AWS_USE_PATH_STYLE_ENDPOINT=true
>> http://localstack:4566/{bucket_name}
>
> AWS_USE_PATH_STYLE_ENDPOINT=false ❌Could not resolve host
>> http://{bucket_name}.localstack:4566

- Test by tinker (SES)
  > php artisan tinker <br>
  > Mail::raw('', function ($m) { $m->from('localstack-debug@example.com'); $m->to('test@example.com'); })

---

## Reference

- [Localstack - docker-compose](https://docs.localstack.cloud/getting-started/installation/#docker-compose)
  - [AWS Service Feature Coverage](https://docs.localstack.cloud/user-guide/aws/feature-coverage/)

- verify-email-identity 実行時に regionの指定が必要
  > SendRawEmail operation: Did not have authority to send from email xxxx@example.com
  >> SES was made region-aware in LocalStack 1.4.
  https://github.com/localstack/localstack/issues/7896#issuecomment-1477848752
