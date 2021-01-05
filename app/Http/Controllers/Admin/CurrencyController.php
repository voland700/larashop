<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class  CurrencyController extends Controller
{
    public function index()
    {
        $h1 = 'Курсы валют';
        $currency = Currency::all();

        $current = Carbon::now();
        $temp = $currency->where('currency', '=','EUR')->first()->updated_at;
        $necessary = ($current->isSameDay($temp));
        $data = Carbon::parse($temp)->translatedFormat('j F Y');
        $ago = Carbon::parse($temp)->diffForHumans();
        return view('admin.currency_index', compact('h1', 'currency', 'data', 'ago', 'necessary'));
    }

    public  function get()
    {
        $data = json_decode(file_get_content_curl('https://www.cbr-xml-daily.ru/daily_json.js'));
        $value = (array)$data->Valute;
        $currency = Currency::all();
        foreach ($currency as $Valute){
            $Valute->CharCode = $value[$Valute->currency]->CharCode;
            $Valute->Name = $value[$Valute->currency]->Name;
            $Valute->Nominal = $value[$Valute->currency]->Nominal;
            $Valute->value = $value[$Valute->currency]->Value;
            $Valute->Name = $value[$Valute->currency]->Name;
            $Valute->updated_at = Carbon::now();
            $Valute->save();
        }
        return redirect()->route('currency.index')->with('success', 'Данные курсов валют обновлены');
    }

    public  function updatePrices()
    {
        $countUpdate = 0;
        $currency = Currency::select('currency', 'Nominal', 'value')->get()->keyBy('currency')->toArray();
        $countUpdate += DB::update("UPDATE `product` SET `price` = (`base_price` * ?)  WHERE `currency`='EUR'", [ $currency['EUR']['value'] ]);
        $countUpdate += DB::update("UPDATE `product` SET `price` = (`base_price` * ?)  WHERE `currency`='USD'", [ $currency['USD']['value'] ]);
        $countUpdate += DB::update("UPDATE `product` SET `price` = (`base_price` * ?)  WHERE `currency`='BYN'", [ $currency['BYN']['value'] ]);
        $countUpdate += DB::update("UPDATE `product` SET `price` = (`base_price` * ?)  WHERE `currency`='UAH'", [ $currency['UAH']['value'] * $currency['UAH']['Nominal']]);
        return redirect()->route('currency.index')->with('success', 'Цены в валюте пересчитаны согласно согласно курсу валют (всего: '.$countUpdate.' товаров)');
    }

}
