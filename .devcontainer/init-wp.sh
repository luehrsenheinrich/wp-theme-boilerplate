#! /bin/bash
npm start
npx wp-env run cli "wp config set WP_HOME https://${CODESPACE_NAME}-8888.githubpreview.dev/"
npx wp-env run cli "wp config set WP_SITEURL https://${CODESPACE_NAME}-8888.githubpreview.dev/"