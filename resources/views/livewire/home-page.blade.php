@assets
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endassets
<div class="flex flex-col gap-4">
    @php
        $headers = [
                ['key' => 'productCode', 'label' => 'Mã sản phẩm', 'class' => 'bg-blue-100'],
                ['key' => 'productName', 'label' => 'Tên sản phẩm'],
                ['key' => 'quantityInStock', 'label' => 'Số lượng'],
                ['key' => 'MSRP', 'label' => 'Gía bán']
            ];
    @endphp
    <p class="text-3xl font-semibold">Bảng thông tin sản phẩm</p>
    <x-table :headers="$headers" :rows="$products" with-pagination></x-table>
    <p class="text-3xl font-semibold">Biểu đồ thống kê loại sản phẩm và số lượng</p>
    <div class="grid grid-cols-3">
        <div class="col-span-2">
            @php
                $headers = [
                ['key' => 'productLine', 'label' => 'Mã', 'class' => 'bg-orange-100'],
                ['key' => 'textDescription', 'label' => 'Mô tả', 'class' => 'text-justify'],
            ];
            @endphp
            <x-table :headers="$headers" :rows="$productLines"/>
        </div>
        <div class="col-span-1">
            @php
                $types = [ ['id' => 'pie','name' => 'Tròn'], ['id' => 'line','name' => 'Đường'], ['id' => 'bar','name' => 'Cột'] ]
            @endphp
            <x-select label="Loại biểu đồ" wire:model.live="chartType" :options="$types" />
            <x-chart wire:model="myChart"/>
        </div>
    </div>
</div>
