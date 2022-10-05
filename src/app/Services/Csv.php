<?php

namespace App\Services;

use Goodby\CSV\Export\Standard\Exporter;
use Goodby\CSV\Export\Standard\ExporterConfig;

final class Csv
{

    public function download($title, $values, $body)
    {
        header('content-type: text/csv; charset=utf-8');
        header('Cache-Control: public');
        header('Pragma: public');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $title . '.csv"');

        $_exports = [];
        $exports = [];
        $fields = [];
        foreach ($body as $b_k => $b_v) {
            foreach ($values as $h_k => $h_v) {
                $_exports[$b_k][$h_k] = (isset($b_v[$h_v]) && $b_v[$h_v]) ? $b_v[$h_v] : '';
            }
        }

        foreach ($_exports as $k => $v) {
            if ($k == 0) {
                foreach ($v as $l => $w) {
                    array_push($fields, $l);
                }
                $exports[0] = $fields;
            }
            if ($fields) {
                foreach ($fields as $l => $w) {
                    $exports[$k + 1][$l] = isset($v[$w]) ? $v[$w] : '';
                }
            }
        }
        //出力できるものがないときはフィールド名のみ出力
        if ($exports == []) {
            foreach ($values as $k => $v) {
                $exports[1][] = $k;
            }
        }

        $config = new ExporterConfig();
        $config->setToCharset('SJIS-win')->setFromCharset('UTF-8');
        $exporter = new Exporter($config);
        $exporter->export('php://output', $exports);
        exit;
    }
}
