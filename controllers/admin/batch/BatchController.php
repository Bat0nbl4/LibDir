<?php

namespace controllers\admin\batch;

use core\data_base\DB;
use core\rendering\View;

class BatchController extends \controllers\Controller
{
    public function list(int $page = 1)
    {
        $elem_on_page = 20;

        $count = DB::query()
            ->from("batch")
            ->select(["COUNT(id)"])
            ->get()[0]["COUNT(id)"];
        $page_count = ceil($count / $elem_on_page);

        $batchs = DB::query()
            ->from("batch")
            ->orderBy("id", "DESC")
            ->offset(($page - 1) * $elem_on_page)
            ->limit($elem_on_page)
            ->get();

        View::template("admin_panel");
        View::render("admin/batch/list", [
            "batchs" => $batchs,
            "page_count" => $page_count,
            "current_page" => $page,
        ]);
    }

    public function edit(int $id) {
        $batch = DB::query()
            ->from("batch")
            ->where("id", "=", $id)
            ->first();

        if (!$batch) {
            View::render("catch/404");
        }

        View::template("admin_panel");
        View::render("admin/batch/edit", ["batch" => $batch]);
    }

    public function create() {
        View::template("admin_panel");
        View::render("admin/batch/create");
    }
}