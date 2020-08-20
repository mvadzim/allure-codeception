# Allure Codeception Adapter Fork

This is **fork** of [official Codeception adapter for Allure Framework](https://github.com/allure-framework/allure-codeception).


## Installation and Usage
In order to use this adapter you need to add a new dependency to your **composer.json** file:
```
{
  "require": {
    "mvadzim/allure-codeception": "dev-master"
  }
}
```

or

```
composer require mvadzim/allure-codeception:dev-master
```

To enable this adapter in Codeception tests simply put it in "enabled" extensions section of **codeception.yml**:
```yaml
extensions:
    enabled:
        - Yandex\Allure\Codeception\AllureCodeception
    config:
        Yandex\Allure\Codeception\AllureCodeception:
            deletePreviousResults: true
            outputDirectory: allure-results
            ignoredAnnotations:
                - env
                - dataprovider
            enabledAttach:
                - PhpBrowserLog
                - stepScreenshot
                - stepBrowserLog # Not work in firefox, phpbrowser
                - failedStepPageSource
                - visualceptionScreenshot # Attach actual.png, expected.png, diff.png for screen-diff-plugin
            stepScreenshotIgnored:
                - 'grab*'
                - '*cookie'
                - '*api*'
```

 
## Note

Форк делался для себя и под свои запросы, из-за этого не нужно надеятся на его стабильность и безбажность даже для базовых вариантов использования.

##### Изменения:
* Исправление вывода тестов сделанных через датапровайдер
* Своя логика именования тестов, шагов. Для датапровайдера название берется с  $example['wantTo']
* Подключение [screen-diff-plugin](https://github.com/allure-framework/allure2/tree/master/plugins/screen-diff-plugin) для [VisualCeption](https://github.com/mvadzim/VisualCeption)
* Автоматическое прикрепление скриншотов для каждого шага теста.
* Автоматическое прикрепление скриншота и исходного кода текущей страницы при падении теста
* Автоматическое прикрепление запроса и ответа при использовании PhpBrowser
* Вывод подшагов для step object
* Пометка упавшего шага красным значком
 
               
 ![sample report screenshot](allure-report-sample.png)
