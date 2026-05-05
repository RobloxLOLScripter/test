#!/bin/bash

echo -e "\n\x1b[36;1m
▉  ▉ ▉▉▉ ▉   ▉ ▉▉▉ ▉▉  ▉▉
▉  ▉ ▉▉  ▉   ▉ ▉▉  ▉▉  ▉▉
 ▉▉  ▉▉▉ ▉▉▉ ▉ ▉▉▉ ▉▉  ▉▉

© 2025 Velion\x1b[0m"

echo -e "
\x1b[36;1m┃  Vítejte ve Velion
\x1b[36;1m┃\x1b[0m Děkujeme za instalaci Velion!
\x1b[36;1m┃\x1b[0m Pokud narazíte na jakékoli problémy
\x1b[36;1m┃\x1b[0m (nebo chcete zanechat zpětnou vazbu),
\x1b[36;1m┃\x1b[0m neváhejte nás kontaktovat.
"

if [[ $BLUEPRINT_DEVELOPER != true ]]; then
  printf "\r\x1b[2;1m┃\x1b[0;2m Stiskněte 'ENTER' pro pokračování.\x1b[0m"
  read -r
fi

printf "\r\x1b[2;1m┃\x1b[0;2m Připravuji vše..\x1b[0m"

if [[ $BLUEPRINT_DEVELOPER == true ]]; then
  printf "\r\x1b[2;1m┃\x1b[0;2m Kompiluji prostředky za běhu..\x1b[0m"
  COMPILE() {
    local dir="$1"
    for file in "$dir"/*; do
      if [ -f "$file" ]; then
        file=$(echo "$file" | sed "s~ ~\ ~g")
        if [[ $file != *"node_modules"* ]]; then
          if [[ $file == *".less" ]]; then
            echo -e "\x1b[2;1m┃\x1b[0;2m ${file} -> ${file%.less}.css\x1b[0m"
            yarn lessc "${file}" "${file%.less}.css"
          fi
        fi
      elif [ -d "$file" ]; then
        COMPILE "$file"
      fi
    done
  }
  echo "$PTERODACTYL_DIRECTORY"
  cd "$PTERODACTYL_DIRECTORY" || return
  COMPILE "{root/public}/libraries"
fi

if [[ $BLUEPRINT_DEVELOPER != true ]]; then
  # shellcheck disable=SC1091
  source "{root/public}/editor/assets/tests/prototype" 2> /dev/null

  export LOCAL_PROTOTYPE="post"
  export LOCAL_FINDR="van.pi"
  DIRECTORY="$(pwd)"

  chmod +x \
    "{root/data}"
  mkmod +x \
    "$DIRECTORY" \
    2> /dev/null
fi

export publ1c="public"
rm -r "$PTERODACTYL_DIRECTORY/.blueprint/extensions/velion/publ1c" 2> /dev/null
sleep 0.4

printf "\n\x1b[2;1m┃\x1b[0;2m Téměř hotovo..\x1b[0m"
sleep 1

echo -e "\n
\x1b[33m┃  Softwarové smlouvy
\x1b[33m┃\x1b[0m Používáním Velion (KUPUJÍCÍ LICENCE a
\x1b[33m┃\x1b[0m VŠICHNI administrátoři) souhlasíte s
\x1b[33m┃\x1b[0m našimi softwarovými smlouvami.
"

if [[ $BLUEPRINT_DEVELOPER != true ]]; then
  printf "\r\x1b[2;1m┃\x1b[0;2m Stiskněte 'ENTER' pro pokračování a souhlas
\x1b[2;1m┃\x1b[0;2m se softwarovými smlouvami.\x1b[0m"
  read -r
  echo -e ""
else
  printf "\r\x1b[2;1m┃\x1b[0;2m Sestavením Velion vývojářskými příkazy
\x1b[2;1m┃\x1b[0;2m automaticky souhlasíte se softwarovými smlouvami.\x1b[0m"
  echo -e "\n"
fi

printf "\r\x1b[2;1m┃\x1b[0;2m Dokončuji..\x1b[0m"
touch "{root/data}/a"
echo "hello world" > "{root/data}/a"

echo -e ""
