<?php
                               
return [
    \Gnugat\MicroFrameworkBundle\GnugatMicroFrameworkBundle::class => ['all' => true],

    // CustomBundle, similar to your own bundles
    \tests\Gnugat\MicroFrameworkBundle\CustomBundle\src\GnugatCustomBundle::class => ['all' => true],

    // Officially supported third party bundles
    \Symfony\Bundle\MonologBundle\MonologBundle::class => ['all' => true],
];
