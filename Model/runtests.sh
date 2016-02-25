#!/bin/bash
echo "Running tests on database.."
counter=1
errorExitCode=1
errorCounter=0
unit_tests_directory=unit_tests

if [ ! -f databaselogs.txt ]; then
	touch databaselogs.txt
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
		echo "${error} ${currentDate}" >> databaselogs.txt
	fi
	counter=$(( counter + 1 ))
done

if [ $errorCounter > 0 ]; then
	currentDate=`date`
	results="All tests finished with $errorCounter errors at $currentDate"
	echo "${results}" >> databaselogs.txt
	printf "\n" >> databaselogs.txt
else
	currentDate=`date`
	results="All tests finished succesfully at $currentDate"
	echo "${results}" >> databaselogs.txt
	printf "\n" >> databaselogs.txt
fi

if [ -f 0 ]; then
	rm 0
fi
