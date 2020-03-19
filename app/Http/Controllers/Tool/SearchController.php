<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 2020-03-18
 * Time: 19:45
 */

namespace App\Http\Controllers\Tool;

use App\Http\Controllers\BaseController;
use App\Services\Tool\SearchService;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    /**@var SearchService */
    protected $searchService;

    /**
     * @desc
     */
    public function __construct(SearchService $service)
    {
        $this->searchService = $service;
    }

    /**
     * @desc 列表
     */
    public function getList(Request $request)
    {
        $input = $request->input();
        $result = $this->searchService->getList($input);

        return $this->success($result['results']);
    }

    /**
     * @desc 增加记录
     */
    public function addData(Request $request)
    {
        $result = $this->searchService->add($request->input());
        dd($request);
    }

    /**
     * @desc 获取 token
     */
    public function getToken()
    {
        $token = csrf_token();
        return $this->success($token);
    }
}
