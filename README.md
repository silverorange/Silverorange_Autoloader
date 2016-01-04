Silverorange_Autoloader
=======================
Autoloader for the silverorange package format. Silverorange packages use a
different filename scheme than PSR-0 or PSR-4. This autoloader lets files be
added dynamically during development while using our specific directory layout.

Usage
-----
Packages should depend on this package in their `composer.json` file:

```json
"requires": {
  "silverorange/silverorange_autoloader": "*"
}
```

Pacakges should create an `autoloader.php` that adds rules for the package. For
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
      'Account',
      'Ad',
      'AdReferrer',
      'ApiCredential',
      'Article',
      'AttachmentCdnTask',
      'Attachment',
      'AttachmentSet',
      'AudioMedia',
      'BotrMediaEncoding',
      'BotrMedia',
      'BotrMediaPlayer',
      'BotrMediaSet',
      'CdnTask',
      'Comment',
      'ContactMessage',
      'GadgetCache',
      'GadgetInstance',
      'GadgetInstanceSettingValue',
      'ImageCdnTask',
      'ImageDimension',
      'Image',
      'ImageSet',
      'ImageType',
      'InstanceConfigSetting',
      'Instance',
      'MediaCdnTask',
      'MediaEncoding',
      'Media',
      'MediaSet',
      'MediaType',
      'SignOnToken',
      'VideoImage',
      'VideoMediaEncoding',
      'VideoMedia',
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
