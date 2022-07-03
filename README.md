# Hola Luz Test

Backend test Hola Luz

At Holaluz we are worried about fraud in electricity readings and we have decided to implement a suspicious reading detector.

Some clients have phoned us suspecting some squatters have been tapping into their electricity lines and this is why you may find some extremely high readings compared to their regular usage.
At the same time, we suspect some clients are tapping their building electricity lines and you may also find extremely low readings.

As we all know, many systems in Spain are a bit old fashioned and get some readings in XML and some others in CSV, so we need to be able to implement adaptors for both inputs.

For this first iteration, we will try to identify readings that are either higher or lower than the annual median ± 50%.

Please write a command line application that takes a file name as an argument (such as 2016-readings.xml or 2016-readings.csv) and outputs a table with the suspicious readings:

```
| Client              | Month              | Suspicious         | Median
-------------------------------------------------------------------------------
| <clientid>          | <month>            | <reading>          | <median>
```

You can assume there are no tricks in the XML and CSV files. Each client will have 12 readings and you get all 12 consecutively. Please don't spend time trying to validate all this although it happens in real life sometimes!

In this exercise, we are looking for things like:

- Hexagonal architecture to handle different inputs (CSV and XML in this case, but it could be a database or even a txt file in a remote FTP! True story...)

Bonus points if you use:
- Idiomatic features of the language
- Automated tests
- Git
- Docker or similar

The solution can be written in any of our stack languages: PHP, Python or Java.

You can use any external library or language version :)

---

##Install

Launch setup

```
make setup
```

Launch app

```
make install
```

##Execute test

Launch test

```
make test
```

##Run app

Run app

```
make run
```

##Explain

For the test I have used a skeleton that I normally use in the applications

I have made 2 use cases:

The first would be the import of the file, in its different formats.
For this case I have used a Factory, to be able to implement different formats and conversions. I have only implemented the csv

The second use case corresponds to searching for users with suspicious readings

I have done some basic tests, but it would be necessary to complete with more tests to cover all the use cases