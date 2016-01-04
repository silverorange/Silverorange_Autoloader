Silverorange_Autoloader
=======================
Autoloader for the silverorange package format. Silverorange packages use a
different file layout than either PSR-0 or PSR-4. This autoloader lets files be
added dynamically during development while using custom file layout.

Usage
-----
Packages should depend on this package in their `composer.json` file:

```json
"require": {
  "silverorange/silverorange_autoloader": "*"
}
```

Pacakges should create an `autoload.php` that adds rules for the package. For
example:

```php
<?php

Silverorange_Autoloader::addRule(
  new Silverorange_Autoloader_Rule(
    'pages',
    'Site',
    array('Page', 'Server', 'PageDecorator')
  )
);

Silverorange_Autoloader::addRule(
  new Silverorange_Autoloader_Rule(
    'gadgets',
    'Site',
    'Gadget'
  )
);

Silverorange_Autoloader::addRule(
  new Silverorange_Autoloader_Rule(
    'layouts',
    'Site',
    'Layout'
  )
);

Silverorange_Autoloader::addRule(
  new Silverorange_Autoloader_Rule(
    'views',
    'Site',
    'View'
  )
);

Silverorange_Autoloader::addRule(
  new Silverorange_Autoloader_Rule(
    'exceptions',
    'Site',
    'Exception'
  )
);

Silverorange_Autoloader::addRule(
  new Silverorange_Autoloader_Rule(
    'dataobjects',
    'Site',
    array(
      'Binding',
      'Wrapper',
      'AccountLoginHistory',
      'AccountLoginSession',
      ...
      'VideoMediaSet',
      'VideoScrubberImage',
    )
  )
);

Silverorange_Autoloader::addRule(
  new Silverorange_Autoloader_Rule(
    '',
    'Site'
  )
);

?>
```

Packages should add a `files` autoloader rule to their `composer.json`. If the
package has a lof of test cases, a separate `autoload-dev.php` file should be used.

```json
"autoload": {
  "files": [ "autoload.php" ]
}
```
