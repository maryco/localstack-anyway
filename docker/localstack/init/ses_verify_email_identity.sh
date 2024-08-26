#!/bin/bash

EMAILS=(${SES_VERIFY_EMAILS//,/ })

set -x

for EMAIL in "${EMAILS[@]}"
do
  `awslocal ses verify-email-identity --region ${DEFAULT_REGION} --email-address ${EMAIL}`
done

set +x
