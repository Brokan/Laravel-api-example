#!/bin/bash

PROJECT_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" &>/dev/null && pwd)"

if [[ $EUID -eq 0 ]]; then
  echo "This script must NOT be run with sudo/root. Please re-run without sudo." 1>&2
  exit 1
fi

echo "-------------- Go in docker"
cd "$PROJECT_ROOT/docker" || exit

echo "-------------- docker down --------------"
docker compose down || echo "no docker"

if ! docker ps > /dev/null 2>&1 ; then
  echo "------------- Waiting for docker to down..."
fi


while ! docker ps > /dev/null 2>&1 ; do sleep 2; done
sleep 2;

echo "-------------- docker compose"
docker compose up -d --build 