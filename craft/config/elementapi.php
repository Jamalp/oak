<?php
namespace Craft;

return [
    'endpoints' => [
        'blog.json' => [
            'elementType' => ElementType::Entry,
            'criteria' => ['section' => 'post'],
            'transformer' => function(EntryModel $entry) {
                return [
                    'title' => $entry->title,
                    'url' => $entry->url,
                    'jsonUrl' => UrlHelper::getUrl("blog/{$entry->id}.json"),
                    'summary' => $entry->summary,
                ];
            },
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
