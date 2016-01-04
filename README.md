Silverorange_Autoloader
=======================
Autoloader for the silverorange package format. Silverorange packages use a
different file layout than either PSR-0 or PSR-4. This autoloader lets files be
added dynamically during development while using custom file layout.

Usage
-----
Packages should depend on this package in their `composer.json` file and add a
`files` autoloader. If the package has a lot of tests, a separate `autoload-dev`
should be used:

```json
"require": {
  "silverorange/silverorange_autoloader": "*"
},
"autoload": {
  "files": [ "autoload.php" ]
}
```

The `autoload.php` file should contain rules for the package. For example:

```php
<?php

use Silverorange\Autoloader;

Autoloader::addRule(
  new Rule(
    'pages',
    'Site',
    array('Page', 'Server', 'PageDecorator')
  )
);

Autoloader::addRule(
  new Rule(
    'gadgets',
    'Site',
    'Gadget'
  )
);

Autoloader::addRule(
  new Rule(
    'layouts',
    'Site',
    'Layout'
  )
);

Autoloader::addRule(
  new Rule(
    'views',
    'Site',
    'View'
  )
);

Autoloader::addRule(
  new Rule(
    'exceptions',
    'Site',
    'Exception'
  )
);

Autoloader::addRule(
  new Rule(
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

Autoloader::addRule(
  new Rule(
    '',
    'Site'
  )
);

?>
```
