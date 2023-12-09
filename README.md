
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
SES_VERIFY_EMAIL=localstack-debug@example.com
S3_DEFAULT_BUCKET=localstack-debug
```
NOTE: For allows access from other container you should set same name to "COMPOSE_PROJECT_NAME" 

```
cd docker
docker compose up -d
```

- Check available services.
  > curl -s "http://127.0.0.1:4566/health" | jq .

```
docker exec -it localstack-debug /bin/bash
```

- Check default bucket are created.
  > awslocal s3 ls
- Check SES verified identities.
  > awslocal ses list-identities --region ap-northeast-1 <br>
  
  If list is empty, add one using region and email address you want to set up. (NOTE: **Region option is required.**)
  > awslocal ses verify-email-identity --region ap-northeast-1 --email-address localstack-debug@example.com

## Commands you might use

- Retrieving and deleting emails received in SES
  > curl -X GET 'http://localhost:4566/_localstack/ses/' <br>
  > curl -X DELETE 'http://localhost:4566/_localstack/ses?id=jdlzfxnetmecxvwk-rfnufcll-fuvy-jild-nkwf-yvjrnolawnsx-bsuuqu'

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
  - AWS 開発環境｜ LocalStack をさわってみた。
  https://aws.taf-jp.com/blog/78562

- [Compose CLI 環境変数:COMPOSE_PROJECT_NAME](https://docs.docker.jp/compose/reference/envvars.html#compose-project-name)
  - docker-composeのコンテナ名のデフォルト名は「プロジェクト名-サービス名-インデックス番号」
  https://shinkufencer.hateblo.jp/entry/2022/03/19/000000
- [Compose 内の環境変数](https://docs.docker.jp/compose/environment-variables.html)

- verify-email-identity 実行時に regionの指定が必要
  > SendRawEmail operation: Did not have authority to send from email xxxx@example.com
  >> SES was made region-aware in LocalStack 1.4.
  https://github.com/localstack/localstack/issues/7896#issuecomment-1477848752

- 【Docker】コンテナとNetworkの関係
https://qiita.com/kenny_J_7/items/77de780d7193b75444c3
  
  > すなわちコンテナ名が同じであれば同じネットワーク
  >> docker-compose.yml が格納されているディレクトリ名がコンテナ名？
