<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Services\RedisServices;
use Illuminate\Http\Request;

/**
 * 网站配置控制器,这个控制器内暂时后端没做任何验证
 * Class ConfigController
 * @package App\Http\Controllers\Admin
 */
class ConfigController extends Controller
{
    /**
     * 编辑配置
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $configs = Config::orderBy('type', 'asc')->get();
        return view('admin.config.edit', compact('configs'));
    }

    /**
     * 更新配置
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $requestData = $request->except('_token');
        foreach ($requestData as $key => $value) {
            Config::where('title', $key)->update(['value' => $value]);
        }

        // 用框架的反射生成实例后更新缓存
        app(RedisServices::class)->updateConfig();

        return redirect()->back()->with('success', '更新成功');
    }

    /**
     * 创建配置
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.config.create');
    }

    /**
     * 存储创建的配置
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $configData = $request->except('_token');
        Config::create($configData);

        return redirect()->route('config.edit')->with('success', '创建配置成功');
    }
}
