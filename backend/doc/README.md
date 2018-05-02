# API

Take a look at the [solution explained](solution.md) to have a technical review.

## Usage

```
{host}/
{host}/usage
```
Show hint.

## Stage 1
Read info for each unique survey.
```
{host}/survey/list
```
Output looks like :
```
[
    {"name":"Chartres","code":"XX2"},
    {"name":"Paris","code":"XX1"},
    {"name":"Melun","code":"XX3"}
]
```
Where each row represents a unique survey name+code.

## Stage 2
Read aggregation of answers for selected survey. {code} is the survey's code.
```
{host}/survey/{code}
```
Output looks like :
```
{
    "code":"XX2",
    "name":"Chartres",
    "survey_taken":6,
    "average_number_of_products":4733,
    "first_survey_date":"2016-08-28T12:04:50+00:00",
    "last_survey_date":"2017-10-25T12:04:50+00:00",
    "best_sellers":
        {
            "Product 1":4,
            "Product 2":4,
            "Product 3":6,
            "Product 4":3,
            "Product 5":6,
            "Product 6":3
        }
}
```
Where :
- **code** (string) is the survey code.
- **name** (string) is the survey name.
- **survey_taken** (int) is the number of surveys identified by this code.
- **average_number_of_products** (int) is the average of products. It is an int for logic purpose.
- **first_survey_date** (string) is the date the first survey was taken.
- **last_survey_date** (string) is the date the last survey was taken.
- **best_sellers** (array) is an array of each best seller products name and their respective availability.

If the code passed in the URL does not exist, an exception is thrown.

## Exceptions
Exceptions are often thrown when something bad happens. There are caught and sent to the caller like this :
```
{
    "code":500,
    "message":"Unrecognized question type.",
    "usage":"Usage: Try calling host\/survey\/list or host\/survey\/XX2. See host\/usage"
}
```
Where :
- **code** (int) is the HTTP status code.
- **message** (string) is the exception message.
- **usage** (string) is a hint on how to use this API.

## Configuration
The file `/config/config.php` contain several configuration variable.
- `debug` (boolean) should be used only in dev stage.
- `data_location` (string) is the path where the json files will be fetch.
- `date_format` (string) is the format used to output date when needed. Each date use the PHP \DateTime object. See [format doc](http://php.net/manual/en/function.date.php#refsect1-function.date-parameters) for further info.
- `usage` (string) is the string to be displayed when an exception is sent to the caller.
