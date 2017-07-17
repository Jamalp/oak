<?php
namespace Craft;

return [
    'endpoints' => [
        'api/blog.json' => [
            'elementType' => ElementType::Entry,
            'criteria' => ['section' => 'blog'],
            'transformer' => function(EntryModel $entry) {
                $images = [];
                foreach ($entry->heroImage as $image) {
                  $images[] = $image->getUrl('tileThumb');
                }
                return [
                    'title' => $entry->title,
                    'id' => $entry->id,
                    'jsonUrl' => UrlHelper::getUrl("api/blog/{$entry->id}.json"),
                    'image' => $images,
                    'slug' => $entry->slug,
                ];
            },
            // 'cache' => 'PT10M',
            'jsonOptions' => JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
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
                  'slug' => $linkEntry->slug,
                ];
              }
              foreach ($linkList->linkCategory as $linkCategory) {
                $linksCategory[] = [
                  'title' => $linkCategory->title,
                  'slug' => $linkCategory->slug,
                ];
              }
              $links[] = [
                'linkText' => $linkList->linkText,
                'linkUrl' => $linkList->linkUrl,
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
        'api/blog/<entryId:\d+>.json' => function($entryId) {
            return [
                'elementType' => ElementType::Entry,
                'criteria' => ['id' => $entryId],
                'first' => true,
                'transformer' => function(EntryModel $entry) {
                    $postBlocks = [];
                    foreach ( $entry->post as $post ) {
                      switch ( $post->type->handle ) {
                        case 'image' :
                          if ($post->fullBleedImage->first()) {
                            $image = $post->fullBleedImage->first();
                            $postBlocks[] = [
                              'fullBleedImage' => $image->getUrl()
                            ];
                          } else if ($post->singleImage->first()) {
                            $postBlocks[] = [
                              'singleImage' => $post->singleImage->first()->getUrl()
                            ];
                          } else if ( $post->imageRow->first() ) {
                            $imageRowArray = [];

                            foreach ( $post->imageRow as $image ) {
                              $imageRowArray[] = [
                                $image->getUrl()
                              ];
                            }
                            $postBlocks[] = [
                              'imageRow' => $imageRowArray
                            ];
                          }
                          break;
                        case 'paragraph' :
                          $postBlocks[] = [
                            'paragraph' => $post->paragraph->getParsedContent()
                          ];
                          break;
                        case 'paragraph_image' :
                          $postBlocks[] = [
                            'paragraph' => $post->paragraph->getParsedContent()
                          ];
                          break;
                        case 'recipe' :
                            $recipe = [
                              'instructions' => $post->recipeSummary->getParsedContent(),
                              'ingredients' => $post->ingredients->getParsedContent(),
                              'image' => $post->recipeImage->first()->getUrl()
                            ];
                            $postBlocks[] = [
                              'recipe' => $recipe
                            ];
                          break;
                      }
                    }
                    return [
                        'title' => $entry->title,
                        'id' => $entry->id,
                        'heroImage' => $entry->heroImage->first()->getUrl(),
                        'subtitle' => $entry->subtitle,
                        'contentTitle' => $entry->contentTitle,
                        'body' => $postBlocks
                    ];
                },
                // 'cache' => 'PT7D',
                'jsonOptions' => JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
            ];
        },
    ]
];
