<?php

//определение браузера, операционной системы, устройства

require 'vendor/autoload.php';

//-------------------------------------------------

use Sinergi\BrowserDetector\Browser;

$browser = new Browser();
var_dump('Browser: ' . $browser->getName());

//-------------------------------------------------

use Sinergi\BrowserDetector\Os;

$os = new Os();
var_dump('Os: ' . $os->getName());

//-------------------------------------------------

use Sinergi\BrowserDetector\Device;

$device = new Device();
var_dump('Device: ' . $device->getName());