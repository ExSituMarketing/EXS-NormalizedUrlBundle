# EXS-NormalizedUrlBundle
Bundle for looking up and storing normalized urls in 3 parts


## Installing the EXS-NormalizedUrlBundle in a new Symfony2 project

Edit composer.json file with EXS-NormalizedUrlBundle dependency:
``` js
//composer.json
//...
"require": {
    //other bundles
    "exs/normalized-url-bundle": "dev-master"
},
```
Save the file and have composer update the project via the command line:
``` shell
composer update exs/normalized-url-bundle
```

Update the app/AppKernel.php
``` php
//app/AppKernel.php
//...
public function registerBundles()
{
    $bundles = array(
    //Other bundles
    new EXS\NormalizedUrlBundle\EXSNormalizedUrlBundle()
);
```


#### Contributing ####
Anyone and everyone is welcome to contribute.

If you have any questions or suggestions please [let us know][1].


[1]: http://www.ex-situ.com/
