<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 2020-03-18
 * Time: 19:47
 */

namespace App\Services\Tool;

use Elasticsearch\ClientBuilder;

class SearchService
{
    /**@var SearchService */
    protected $selfObj;

    /**@var \Elasticsearch\Client */
    protected $searchClient;

    protected $data = [];

    // 索引名称
    const MY_INDEX_1 = 'user_index';
    const MY_TYPE_1 = 'user_type';

    public function __construct()
    {
        // 实例化 search client
        $this->searchClient = ClientBuilder::create()->build();
    }

    // 数据列表
    public function getList($params = [])
    {
        $options = [
            'keyword' => 'common',
        ];
        $options = array_merge($options, $params);
        $queryParam = [
            'index' => self::MY_INDEX_1,
            'type'  => self::MY_TYPE_1,
            'body'  => [
                'query' => [
                    'bool' => [
                        'should'               => [
                            [
                                'match' => [
                                    'title' => $options['keyword'],
                                ],
                            ],
                            [
                                'match' => [
                                    'content' => $options['keyword'],
                                ],
                            ],
                        ],
                        "minimum_should_match" => 1,
                    ],
                ]
            ],
        ];
        $client = $this->searchClient;
        $hits = $client->search($queryParam);
        $hits = $hits['hits']['hits'] ?? [];
        if (empty($hits)) {
            return ['err_no'=>0, 'err_msg'=>'', 'results'=>[]];
        }
        $list = [];
        foreach ($hits as $item) {
            $list[] = $item['_source'] ?? [];
        }

        return ['err_no'=>0, 'err_msg'=>'', 'results'=>$list];
    }

    /**
     * @desc 新增文档
     */
    public function add($params = [])
    {
        $options = [
            'title'   => '',
            'tag'     => '',
            'content' => '',
        ];
        $options = array_merge($options, $params);
        if (empty($options['content'])) throw new \Exception("内容为空", -1);
        $params = [
            'index' => self::MY_INDEX_1,
            'type'  => self::MY_TYPE_1,
            'body'  => [
                'title'   => $options['title'],
                'tag'     => $options['tag'],
                'content' => $options['content'],
            ]
        ];
        $client = $this->searchClient;
        $result = $client->index($params);

        return ['err_no'=>0, 'err_msg'=>'success', 'results'=>$result,];
    }
}
