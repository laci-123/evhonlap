#!/usr/bin/sh

# dependencies: pup (https://github.com/ericchiang/pup)

set -e

URL='https://www.evangelikus.hu/hitunk/lelki-taplalek?napiigenap='

start_date="$1"
number_of_days="$2"

for i in `seq 0 $number_of_days`
do
    tmp_file=$(mktemp)

    datum=$(date -d "$start_date $i days" +%Y-%m-%d)
    echo "$datum:"
    curl -s "$URL$datum" > "$tmp_file"
    cat "$tmp_file" | pup 'h5:contains("Napi igék") + p text{}' | tr '\n' ' ' | sed 's/(.*)/\n/'
    cat "$tmp_file" | pup 'h5:contains("Napi igék") + p > a'    | tr '\n' ' '

    printf "\n\n\n"

    rm "$tmp_file"
done
