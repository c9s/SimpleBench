#!/bin/bash
for file in benchmarks/*.php  ; do 
    php $file
done
