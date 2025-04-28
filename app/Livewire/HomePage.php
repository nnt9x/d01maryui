<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;

    public $myChart;
    public $chartType = 'pie';

    public function render()
    {
        $products = DB::table('products')->paginate(10);

        $productLines = DB::table('productlines')->get();

        # Thống kê sản phẩm theo loại
        $data = [];
        foreach ($productLines as $productLine) {
            $count = DB::table('products')->where('productLine', $productLine->productLine)
                ->count();
            $data[] = $count;
        }

        # Dữ liệu biểu đồ
        $this->myChart = [
            'type' => $this->chartType,
            'data' => [
                'labels' => $productLines->pluck('productLine'),
                'datasets' => [
                    [
                        'label' => 'Số lượng theo loại sản phẩm',
                        'data' => $data,
                    ]
                ]
            ]
        ];

        return view('livewire.home-page', [
            'products' => $products,
            'productLines' => $productLines
        ]);
    }
}
