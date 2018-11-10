# Allure Codeception Adapter Fork

This is fork of official Codeception adapter for Allure Framework.


## Installation and Usage
In order to use this adapter you need to add a new dependency to your **composer.json** file:
```
{
  "require": {
    "mvadzim/allure-codeception": "dev-master"
  },
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/mvadzim/allure-codeception"
    }
  ]
}
```
To enable this adapter in Codeception tests simply put it in "enabled" extensions section of **codeception.yml**:
```yaml
extensions:
    enabled:
        - Yandex\Allure\Adapter\AllureAdapter
    config:
        Yandex\Allure\Adapter\AllureAdapter:
            deletePreviousResults: true
            outputDirectory: allure-results
            ignoredAnnotations:
                - env
                - dataprovider
            enabledAttach:
                - stepScreenshot
                - stepBrowserLog # Not work in firefox, phpbrowser
                - failedStepPageSource
                - visualceptionScreenshot # Attach actual.png, expected.png, diff.png* 
            stepScreenshotIgnored:
                - 'grab*'
                - '*cookie'
            visualceptionTestGroups: # Enable screen-diff-plugin* for groups 
                - visual
```

* [screen-diff-plugin](https://github.com/allure-framework/allure2/tree/master/plugins/screen-diff-plugin)