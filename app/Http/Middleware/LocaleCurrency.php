<?php

namespace App\Http\Middleware;

use Closure;

class LocaleCurrency
{
    public static $mainCurrency = 'kzt'; //основная валюта, которая не должна отображаться в URl


    public function handle($request, Closure $next)
    {
        $localeCurrency = session('currency');

        if($localeCurrency) App::setLocale($localeCurrency);
        //если метки нет - устанавливаем основную валюту $mainCurrency
        else App::setLocale(self::$mainCurrency);

        return $next($request); //пропускаем дальше - передаем в следующий посредник
    }

}
