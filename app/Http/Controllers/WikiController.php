<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
class WikiController extends Controller
{
    public function index()
    {
        return \View::make('wiki.index')->with('hoge', 'test2');
    }


    /*
        mapページ表示
    */
    public function map() {
        if(!Input::get('target')) return Redirect::to('/wikiru');
        // $data['target'] = urlencode(Input::get('target'));
        // $search = urlencode($data['target']);
        $data['target'] = Input::get('target');
        $search = Input::get('target');
        $url = "https://ja.wikipedia.org/w/api.php?format=json&action=query&list=backlinks&bltitle={$search}&blnamespace=0";
        $item = json_decode(mb_convert_encoding(file_get_contents($url), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true);
        if (isset($item['error'])) {
            return  View::make('map')->with('error', $item['error']['code']);
        }
        $data['response'] = $item['query']['backlinks'];
        return \View::make('wiki.map')->with($data);
    }

    /*
        ajaxで探すやつ
    */
    public function search(){
        $search = urlencode(Input::get('search'));
        /*
        https://qiita.com/yubessy/items/16d2a074be84ee67c01f
        */
        $url = "https://ja.wikipedia.org/w/api.php?format=json&action=query&list=backlinks&bltitle={$search}&blnamespace=0";
        $item = json_decode(mb_convert_encoding(file_get_contents($url), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true);
        $items = $item = $item['query']['backlinks'];
        /*
        // 3つランダム
        if (count($item) > 3) {
            $keys = array_rand($item, 3);
            $items = [];
            foreach ($keys as $key) {
                $items[] = $item[$key];
            }
        }
        */
        return \Response::json(['item' => $items]);
    }

}