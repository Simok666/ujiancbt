<?php

namespace App\Controllers;

class Download extends BaseController
{
    public function file($nama)
    {
        return $this->response->download('assets/app-assets/file/' . $nama, NULL);
    }

    public function excel_pg()
    {
        return $this->response->download('assets/app-assets/file-excel/template.xlsx', NULL);
    }
}
