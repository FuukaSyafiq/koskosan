#!/bin/sh

pm2 start php --name="kos-be" -- artisan serve --host=192.168.18.86
pm2 start npm --name="kos-fe" -- run dev

