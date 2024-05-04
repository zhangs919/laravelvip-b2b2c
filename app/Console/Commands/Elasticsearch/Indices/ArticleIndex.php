<?php

namespace App\Console\Commands\Elasticsearch\Indices;

use Illuminate\Support\Facades\Artisan;

class ArticleIndex
{
    public static function getAliasName()
    {
        return 'article';
    }

    public static function getProperties()
    {
        return [
            'cat_id'    => ['type' => 'long'],
            'title'     => ['type' => 'text', 'analyzer' => 'default', 'search_analyzer' => 'ik_smart_synonym'],
            'summary'   => ['type' => 'text', 'analyzer' => 'default'],
            'content'   => ['type' => 'text', 'analyzer' => 'default']
        ];
    }

    public static function getSettings()
    {
        return [
            'analysis' => [
                'analyzer' => [
                    'ik_smart_synonym' => [
                        'type'      => 'custom',
                        'tokenizer' => 'ik_smart',
                        'filter'    => ['synonym_filter'],
                    ],
                ],
                'filter'   => [
                    'synonym_filter' => [
                        'type'          => 'synonym',
                        'synonyms_path' => 'analysis/synonyms.txt',
                    ],
                ],
            ],
        ];
    }

    public static function rebuild($indexName)
    {
        Artisan::call('es:sync-articles', ['--index' => $indexName]);
    }
}