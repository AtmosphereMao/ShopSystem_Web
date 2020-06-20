<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 23:38
 */

namespace core;

class View
{
    private static $viewPath = '../resources/views/';
    /**
     * 不同类型节点操作
     * @param $dom
     * @param $data
     */
    public static function traversingtDomNode($dom, array $data) {
        foreach ($dom->childNodes as $item) {

            if ($item->nodeType == XML_ELEMENT_NODE
                && $if_value = $item->getAttribute("p-if")) {
                $if_result = isset($data[$if_value]) ? $data[$if_value] : false;

                if ($if_result) {
                    $item->removeAttribute("p-if");
                } else {
                    array_push($elementsToRemove, $item);
                }
            }

            if ($item->nodeType == XML_ELEMENT_NODE && $item->hasAttribute("p-else")) {
                $if_result = array_pop($if_stack);

                if (!$if_result) {
                    $item->removeAttribute("p-else");
                } else {
                    array_push($elementsToRemove, $item);
                }
            }

            if ($item->nodeType == XML_ELEMENT_NODE
                && $for_value = $item->getAttribute("p-for")) {
                preg_match("/\((.*?), (.*?)\) in (.*)/", $for_value, $matches);
                $value = $matches[1];
                $index = $matches[2];
                $items = $matches[3];
                foreach ($data[$items] as $k => $v) {
                    $for_runtime_params = $data;
                    $for_runtime_params[$value] = $v;
                    $for_runtime_params[$index] = $k;
                    foreach ($item->childNodes as $el) {
                        $e = $el->cloneNode(true);
                        if ($e->hasChildNodes()) {
                            static::traversingtDomNode($e, $for_runtime_params);
                        }
                    }
                }
            }


            if ($item->nodeType == XML_TEXT_NODE) {
                $str = preg_replace_callback('/\{\{(.*?)\}\}/', function ($matches) use ($data) {
                    return $data[trim($matches[1])] ?? null;
                }, $item->nodeValue);
                $item->nodeValue = $str;
            }
            if ($item->hasChildNodes()) {
                static::traversingtDomNode($item, $data);
            }

        }

    }

    /**
     * 渲染模板
     * @param $view
     * @return string
     */
    public static function display($view, $data = []) {
        extract($data);
        ob_start();
        include (static::$viewPath . $view . '.php');
        $res = ob_get_contents();

        ob_end_clean();
        return $res;
    }
}