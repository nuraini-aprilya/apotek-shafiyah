<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Kode Obat</label>
            <input type="text" class="form-control" name="code"
                value="{{ isset($product->code) ? $product->code : old('code') }}">
            <span class="text-danger" id="code_error"></span>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label>Nama Obat</label>
            <input type="text" class="form-control" name="name"
                value="{{ isset($product->name) ? $product->name : old('name') }}">
            <span class="text-danger" id="name_error"></span>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label>Merk</label>
            <select class="form-control select2" style="width: 100%;" name="brand_id"
                data-placeholder="-- Pilih Merk --">
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}"
                        {{ isset($brand_id) && $brand_id == $brand->id ? 'selected' : (old('brand_id') == $brand->id ? 'selected' : '') }}>
                        {{ $brand->name }}</option>
                @endforeach
            </select>
            <span class="text-danger" id="brand_id_error"></span>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" class="form-control" name="price"
                value="{{ isset($product->price) ? $product->price : old('price') }}">
            <span class="text-danger" id="price_error"></span>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-6">

        <div class="form-group">
            <label>Kategori Obat</label>
            <select class="form-control select2" style="width: 100%;" name="category_id"
                data-placeholder="-- Pilih Kategori --">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ isset($category_id) && $category_id == $category->id ? 'selected' : (old('category_id') == $category->id ? 'selected' : '') }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
            <span class="text-danger" id="category_id_error"></span>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label>Jenis Obat</label>
            <select class="form-control select2" style="width: 100%;" name="type_id"
                data-placeholder="-- Pilih Jenis --">
                @foreach ($types as $type)
                    <option value=" {{ $type->id }}"
                        {{ isset($type_id) && $type_id == $type->id ? 'selected' : (old('type_id') == $type->id ? 'selected' : '') }}>
                        {{ $type->name }}</option>
                @endforeach
            </select>
            <span class="text-danger" id="type_id_error"></span>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label>No. Batch</label>
            <input type="text" class="form-control" name="batch_number"
                value="{{ isset($product->batch_number) ? $product->batch_number : old('batch_number') }}">
            <span class="text-danger" id="batch_number_error"></span>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label>Satuan</label>
            <select class="form-control select2" style="width: 100%;" name="unit_id"
                data-placeholder="-- Pilih Satuan --">
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}"
                        {{ isset($unit_id) && $unit_id == $unit->id ? 'selected' : (old('unit_id') == $unit->id ? 'selected' : '') }}>
                        {{ $unit->name }}</option>
                @endforeach
            </select>
            <span class="text-danger" id="unit_id_error"></span>
        </div>
    </div>
    <!-- /.col -->
    @isset($image)
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputFile">Gambar
                    Obat</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Pilih
                            Gambar</label>
                    </div>
                </div>
                <span class="text-danger" id="image_error"></span>
            </div>
        </div>
        <div class="col-md-6 p-2">
            <img src="{{ asset('storage/upload/produk/' . $product->image) }}" class="p-2"
                style="max-width:150px;border:2px solid darkgreen;">
        </div>
    @else
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputFile">Gambar
                    Obat</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Pilih
                            Gambar</label>
                    </div>
                </div>
                <span class="text-danger" id="image_error"></span>
            </div>
        </div>
    @endisset
    <div class="col-md-12">
        <div class="form-group">
            <label>Keterangan</label>
            <textarea id="information" class="form-control" name="information">{{ isset($product->information) ? $product->information : old('information') }}</textarea>
            <span class="text-danger" id="information_error"></span>
        </div>
    </div>

</div>
