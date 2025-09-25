<?php

use Carbon\Carbon;

if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'D MMMM YYYY')
    {
        return Carbon::parse($date)->locale('id')->isoFormat($format);
    }
}

if (!function_exists('formatRupiah')) {
    function formatRupiah($number, $withSymbol = true, $withBetween = false)
    {
        $formatted = number_format($number, 0, ',', '.');
        $value = $withSymbol ? 'Rp. ' . $formatted : $formatted;

        if ($withBetween) {
            return "<span style='display: flex; justify-content: space-between; width: 100%;'>
                        <span>Rp </span>
                        <span>{$formatted}</span>
                    </span>";
        }

        return $value;
    }
}
if (!function_exists('formatRupiahPdf')) {
    if (!function_exists('formatRupiahPdf')) {
        function formatRupiahPdf($number, $withSymbol = true, $withBetween = false, $isNegative = false)
        {
            $absoluteNumber = abs($number);

            $formatted = number_format($absoluteNumber, 0, ',', '.');

            if ($withBetween) {
                $prefix = '';
                if ($isNegative) {
                    $prefix = '-Rp';
                } else {
                    $prefix = 'Rp';
                }

                return "<table style='width: 100%; border: none; margin: 0; padding: 0;'>
                        <tr>
                            <td style='text-align: left; border: none; padding: 0; margin: 0;'>{$prefix}</td>
                            <td style='text-align: right; border: none; padding: 0; margin: 0;'>{$formatted}</td>
                        </tr>
                    </table>";
            }
            if ($withSymbol) {
                if ($isNegative) {
                    return '-Rp ' . $formatted;
                } else {
                    return 'Rp ' . $formatted;
                }
            }

            return $isNegative ? '-' . $formatted : $formatted;
        }
    }
}
if (!function_exists('formatTimeAgo')) {
    function formatTimeAgo($date)
    {
        Carbon::setLocale('id');
        return Carbon::parse($date)->diffForHumans();
    }
}
if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber($number)
    {
        return preg_replace('/^(\+62|62|0)/', '+62', $number);
    }
}
if (!function_exists('currencyToInteger')) {
    function currencyToInteger($value)
    {
        if (!$value) {
            return null;
        }
        $value = preg_replace('/[^\d,.]/u', '', $value);

        $hasCommaDecimal = preg_match('/,\d{1,2}$/', $value);

        if ($hasCommaDecimal) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        } else {
            $value = str_replace([',', '.'], '', $value);
        }

        return (int) $value;
    }
}

