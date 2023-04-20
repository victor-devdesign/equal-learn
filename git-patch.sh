#!/bin/bash
OLD_COMMIT=$1
OUTPUT_FILE="update.zip"
rm -f update.zip
MODIFIED_FILES=$(git diff --name-only $OLD_COMMIT..HEAD)
echo $MODIFIED_FILES
zip -r $OUTPUT_FILE $MODIFIED_FILES

