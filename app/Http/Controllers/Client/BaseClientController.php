<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\MenuService;
use App\Services\SettingService;
use Illuminate\Support\Facades\View;

class BaseClientController extends Controller
{
    protected $lang;
    private $_menuService;
    private $_settingService;

    public function __construct()
    {
        $this->_menuService = app()->make(MenuService::class);
        $this->_settingService = app()->make(SettingService::class);

        $this->middleware(function ($request, $next) {

            $locale = app()->getLocale();
            View::share('locale', $locale == 'vi' ? '' : $locale);
            $this->lang = getLanguageCode($locale);

            $default_setting = $this->_settingService->getDefault($locale);

            View::share('setting', $default_setting);

            if (auth()->check())
                View::share('current_user', auth()->user());
            return $next($request);
        });
    }
}
