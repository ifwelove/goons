<?php

use Illuminate\Database\Seeder;

class BibleNewAllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->parse();
    }

    protected function parse()
    {
        $file = storage_path('app/public/new.csv');
        $header = null;
        $data   = array();
        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (! $header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        $categories = [];
        foreach ($data as &$row) {
            $row['url']      = 'http://media.feearadio.net/downloads/' . $row['url'];
            $title           = str_replace('和合本聖經', '', $row['title']);
            $aa              = explode('第', $title);
            $row['title']    = $aa[0] . ' 第' . $aa[1];
            $row['category'] = $aa[0];
            if (! in_array($aa[0], $categories)) {
                $categories[] = $aa[0];
            }
        }
        $newCategories = [];
        foreach ($categories as $category) {
            $model                    = \App\Models\BibleNewCategory::create([
                'status'      => 1,
                'sort'      => 1,
                'title'     => $category,
                'sub_title' => $category,
                'image'     => '',
                'anchor'    => '閻大衛'
            ]);
            $newCategories[$category] = $model->id;
        }
        foreach ($data as $item) {
            \App\Models\BibleNewProgram::create([
                'categories' => $newCategories[$item['category']],
                'title'      => $item['title'],
                'sub_title'  => $item['title'],
                'url'        => $item['url'],
                'end_date'   => '2099-12-31',
                'start_date' => '2010-01-01',
                'duration'   => '',
                'anchor'     => '閻大衛',
            ]);
        }
    }
}
