#!/bin/bash
set -x
`awslocal ses verify-email-identity --region ${DEFAULT_REGION} --email-address ${SES_VERIFY_EMAIL}`
set +x
