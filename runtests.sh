#!/bin/bash
# Created by: Jasper Davey
# This script executes all tests in the unit_tests directory

echo "Running tests.."
counter=1
errorExitCode=1
errorCounter=0
unit_tests_directory=unit_tests

if [ ! -f logs.txt ]; then
	touch logs.txt
fi

for tests in `ls "${unit_tests_directory}"`; do
	errorCode=0
	echo "Test $counter: $tests"
	chmod +x "${unit_tests_directory}"/"${tests}"
	"${unit_tests_directory}"/"${tests}" | errorCode=$?
	if [ $errorCode -eq $errorExitCode ]; then
		errorCounter=$(( errorCounter + 1 ))
		error="Error at test: "${tests}""
		currentDate=`date`
		echo "${error} ${currentDate}" >> logs.txt
	fi
	counter=$(( counter + 1 ))
done

if [ $errorCounter > 0 ]; then
	currentDate=`date`
	results="All tests finished with $errorCounter errors at $currentDate"
	echo "${results}" >> logs.txt
	printf "\n" >> logs.txt
else
	currentDate=`date`
	results="All tests finished succesfully at $currentDate"
	echo "${results}" >> logs.txt
	printf "\n" >> logs.txt
fi

