<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('vendor')
    ->exclude('src/Repository')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true
    ])
    ->setFinder($finder)
;
