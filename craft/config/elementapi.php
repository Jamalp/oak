<?php
namespace Craft;

return [
    'endpoints' => [
        'api/home.json' => [
          'elementType' => ElementType::Entry,
          'criteria' => ['section' => 'homepage'],
          'transformer' => function(entryModel $entry) {
            $featured_posts = [];
            $menu_items = [];
            foreach($entry->featuredPosts as $post) {
              $featured_posts[] = [
                'title' => $post->title,
                'image' => $post->heroImage[0]->getUrl('tileThumb'),
                'slug' => $post->slug,
                'date' => $post->postDate,
              ];
            }
            foreach($entry->menu as $menu) {
              $menu_items[] = [
                'title' => $menu->title,
                'image' => $menu->heroImage[0]->getUrl('tileThumb'),
                'slug' => $menu->slug
              ];
            }
            return [
              'featured_posts' => $featured_posts,
              'menu_items' => $menu_items,
              'about_section_copy' => $entry->aboutSectionCopy->getParsedContent(),
              'about_section_image' => $entry->aboutSectionImage[0]->getUrl('tileThumb')
            ];
          },
          'jsonOptions' => JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
        ], // end home
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
                    'date' => $entry->postDate
                ];
            },
            // 'cache' => 'PT10M',
            'jsonOptions' => JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
        ], // end blog page
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
        ], // end header
        'api/blog/<slug:{slug}>.json' => function($slug) {
            return [
                'elementType' => ElementType::Entry,
                'criteria' => [
                  'slug' => $slug
                ],
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
        }, // end blog post
    ]
];
