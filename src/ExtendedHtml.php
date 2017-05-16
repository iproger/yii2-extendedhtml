<?php

namespace iproger\yii2\extendedhtml;

use yii\helpers\Html;

/**
 * Class ExtendedHtml
 *
 * @package iproger\yii2\extendedhtml
 */
class ExtendedHtml extends Html
{
    /**
     * @param $name
     * @param array $items
     * @param array $options
     * @return mixed
     */
    public static function dataList($name, $items = [], $options = [])
    {
        static::addVoidElement('option');

        if (!empty($options['multiple'])) {
            return static::listBox($name, null, $items, $options);
        }
        $options['name'] = $name;
        unset($options['unselect']);
        $selectOptions = static::renderSelectOptions(null, $items, $options);
        $result = static::tag('datalist', "\n" . $selectOptions . "\n", $options);

        static::removeVoidElement('option');

        return $result;
    }

    /**
     * @param $name
     */
    public static function addVoidElement($name)
    {
        static::$voidElements[$name] = 1;
    }

    /**
     * @param $name
     */
    public static function removeVoidElement($name)
    {
        if (in_array($name, static::$voidElements)) {
            unset(static::$voidElements[$name]);
        }
    }
}
