#!/bin/bash
echo "Running tests on database.."
counter=1
errorExitCode=1
unit_tests_directory=unit_tests

for tests in `ls "${unit_tests_directory}"`; do
	errorCode=0
	echo "Test $counter: $tests"
	chmod +x "${unit_tests_directory}"/"${tests}"
	"${unit_tests_directory}"/"${tests}" | errorCode=$?
	if [ $errorCode -eq $errorExitCode ]; then
		echo "Error at test: "${tests}""
	fi
	counter=$(( counter + 1 ))
done

echo "All tests sucessful"
	
