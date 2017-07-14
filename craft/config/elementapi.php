<?php
namespace Craft;

return [
    'endpoints' => [
        'api/blog.json' => [
            'elementType' => ElementType::Entry,
            'criteria' => ['section' => 'blog'],
            'transformer' => function(EntryModel $entry) {
                return [
                    'title' => $entry->title,
                    'url' => $entry->url,
                    'jsonUrl' => UrlHelper::getUrl("blog/{$entry->id}.json"),
                    'summary' => $entry->summary,
                ];
            },
        ],
        'api/header.json' => [
          'elementType' => ElementType::Entry,
          'criteria' => [
            'section' => 'navigation',
            'title' => 'header'
          ],
          'transformer' => function(EntryModel $entry) {
            $links = [];
            foreach ($entry->linkList as $linkList) {
              $linksEntry = [];
              $linksCategory = [];
              foreach ($linkList->linkEntry as $linkEntry) {
                $linksEntry[] = [
                  'title' => $linkEntry->title,
                  'url' => $linkEntry->url,
                ];
              }
              foreach ($linkList->linkCategory as $linkCategory) {
                $linksCategory[] = [
                  'title' => $linkCategory->title,
                  'url' => $linkCategory->url,
                ];
              }
              $links[] = [
                'linkText' => $linkList->linkText,
                'linkUrl' => $linkList->linkUrl,
                'linkCategory' => $linkList->linkCategory->slug,

                'linkEntry' => $linksEntry,
                'linkCategory' => $linksCategory,
              ];
            }
            return [
              'headerLinks' => $links
            ];
          },
          'jsonOptions' => JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
        ],
        '<entryId:\d+>.json' => function($entryId) {
            return [
                'elementType' => ElementType::Entry,
                'criteria' => ['id' => $entryId],
                'first' => true,
                'transformer' => function(EntryModel $entry) {
                    return [
                        'title' => $entry->title,
                        'url' => $entry->url,
                        'body' => $entry->post,
                    ];
                },
            ];
        },
    ]
];
