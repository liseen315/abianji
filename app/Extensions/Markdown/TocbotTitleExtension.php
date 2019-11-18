<?php

namespace App\Extensions\Markdown;

use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Block\Element as BlockElement;

final class TocbotTitleExtension implements ExtensionInterface
{
    public function register(ConfigurableEnvironmentInterface $environment)
    {
        $environment->addBlockRenderer(BlockElement\Heading::class, new TocbotRenderer(), 1);
    }
}
