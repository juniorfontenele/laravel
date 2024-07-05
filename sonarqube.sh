#!/bin/sh

docker run \
    --rm \
    --env-file .env \
    -v "./:/usr/src" \
    sonarsource/sonar-scanner-cli
