#!/bin/bash
set -x
`awslocal s3 mb s3://${S3_DEFAULT_BUCKET} --region ${DEFAULT_REGION}`
set +x
