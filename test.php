<?php
require_once 'testCases/SampleTestCase.php';
require_once 'testEngine/TestLauncher.php';

$sampleTestCase = new SampleTestCase();
$testLauncher = new TestLauncher($sampleTestCase);
$testLauncher->doTest();
?>