#!/bin/bash
git submodule update --init
mkdir log
mkdir cache
php symfony project:permissions
php symfony cc
