<?php

if (!function_exists('getOrPaginate')) {
    /**
     * @param $model
     * @return mixed
     */
    function getOrPaginate($model)
    {
        $perPage = request('per_page');
        if (is_null($perPage)) {
            return $model->get();
        }
        return $model->paginate($perPage);
    }
}

if (!function_exists('convertEnglishNumsToPersian')) {
    /**
     * @param $string
     * @return string
     */
    function convertEnglishNumsToPersian($string): string
    {
        $englishNumbers = range(0, 9);
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        return str_replace($englishNumbers, $persianNumbers, $string);
    }
}

if (!function_exists('escapeLike')) {

    /**
     * Escape special characters for a LIKE query.
     * @param string|null $value
     * @param string $char
     * @return string
     */
    function escapeLike(string|null $value, string $char = '\\'): string
    {
        return str_replace(
            [$char, '%', '_'],
            [$char . $char, $char . '%', $char . '_'],
            $value
        );
    }
}
