<?php

namespace Darake\SculpinNewPostsListBundle;

use Sculpin\Core\Sculpin;
use Sculpin\Core\Event\SourceSetEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Dflydev\DotAccessConfiguration\ConfigurationInterface;

class NewPostsListGenerator implements EventSubscriberInterface
{
    protected $siteConfigration;
    protected $maxPerPage;
    protected $relativePath = "_posts";

    protected $defaultMaxPerPage = 5;

    public function __construct(ConfigurationInterface $siteConfigration, string $relativePath, int $maxPerPage)
    {
        $this->siteConfigration = $siteConfigration;
        $this->relativePath = $relativePath;
        $this->maxPerPage = $maxPerPage;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            Sculpin::EVENT_BEFORE_RUN => array('beforeRun', 100),
        ];
    }

    public function beforeRun(SourceSetEvent $sourceSetEvent): void
    {
        $sourceSet = $sourceSetEvent->sourceSet();
        $allSources = $sourceSet->allSources();

        $maxPerPage = $this->maxPerPage ?: $this->defaultMaxPerPage;

        $new_posts = [];
        foreach ($allSources as $source) {
            if (count($new_posts) === $maxPerPage) {
                break;
            }

            if (!$source->data()->get('draft') && $source->file()->getRelativePath() === $this->relativePath) {
                $new_posts[] = [
                    "title" => $source->data()->get("title"),
                    "source" => $source,
                    "data" => $source->data(),
                ];
            }
        }

        $this->siteConfigration->set("new_posts", $new_posts);
    }
}
