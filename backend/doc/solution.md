# SourceCode

## Base

Each output response is processed through `IWD\JOBINTERVIEW\Service\CoreServices::boot()` in order to be escaped and parsed into a JSON response.

## Structure

I tried to isolate each functionality as much as i could.

First, A distinction is made between **application logic** (see CoreRoutes, CoreServices) and **API/Business logic** (see LogicRoutes, LogicServices).

Then, for clarity purpose, each business route call a dedicated method inside `IWD\JOBINTERVIEW\Survey\SurveyAPI`. This allow simplification of understandment.

`IWD\JOBINTERVIEW\Survey\SurveyDao` is the data access layer. It is responsible for accessing data through any persistence mechanism. For now it reads JSON file but if we were to switch for another data schema, we would only have to work on this class.
The only 'gate' to this class is the method `SurveyDao::getSurveys()` which returns all surveys object. How it is done does not matter for the API.

This DAO uses `IWD\JOBINTERVIEW\Survey\Model\SurveyMaker` to build survey object from raw data. If data structure would happen to change, this is where we should apply changes to take the new data structure into account. This way, internal survey object doesn't need to know how external data is structured.

`IWD\JOBINTERVIEW\Survey\SurveyManager` is the orchestra director which job is to gather and order information before sending it back to the caller in a nice output.

## Improvements

- I'm not happy with the way questions are built in `IWD\JOBINTERVIEW\Survey\Model\SurveyMaker` (same as in `IWD\JOBINTERVIEW\Survey\Model\Survey`). If a new question type would appear, we would have to add another case in the switch. I'm sure there is a better way to deal with this.
- When route `{host}/survey/{code}` is called, we want to aggregate data in a certain way (i.e. avg for numeric, sum for QCM, etc.). As of now, this is done in `IWD\JOBINTERVIEW\Survey\Model\SurveyManager::getAggregatedAnswers`. Unfortunately, each of those aggregation method are tightly bound together in the same method. If the way to aggregate answers would happen to change, it would be necessary to rewrite this whole method, which would induce complexity.
- At the moment, there might be a problem with route. If a survey's code happens to be "list", this present routing would fail.
- Currently, this API only handle JSON type data. It could be an idea to go further into abstraction and be able to easily switch to XML if needed.
- Currently, class `IWD\JOBINTERVIEW\Survey\SurveyDao` read JSON file. But it is not robust. A fake file name "data.json" would be read anyway. It should test MIME type instead of file extension.
