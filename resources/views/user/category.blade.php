@extends('layouts.user.index')

@section('title', 'Kategori')

@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0  text-success"> Kategori <small class="text-muted">({{ $category->name }})</small></h5>
                </div><!-- /.col -->
            </div><!-- /.container-fluid -->
            <hr class="custom-hr">
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content blink-animation">
            <div class="content">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-md-2 col-sm-6 mb-1">
                                        <div class="card h-80">
                                            <!-- kalau ada diskon pake ini  -->
                                            {{-- <div class="ribbon-wrapper ribbon-lg">
                                                <div class="ribbon bg-success">
                                                    <b>Disc 50%</b>
                                                </div>
                                            </div> --}}
                                            <!-- batas diskon -->
                                            <div class="card-body text-center">
                                                <img src="{{ asset('storage/upload/produk/' . $product->image) }}"
                                                    class="card-img-top" alt="Produk 1">
                                                <p class="limited-text"><b>{{ $product->name }},
                                                    </b>{{ $product->information }}</p>
                                            </div>
                                            <div class="card-footer text-center">
                                                {{-- <i class="text-muted" style="text-decoration: line-through;">Rp.
                                                    {{ $product->price }}</i> --}}
                                                <h6 class="text-success">Rp.{{ $product->price }} /
                                                    {{ $product->unit->name }}</h6>
                                                <a href="{{ route('detail.product', $product->id) }}"
                                                    class="btn btn-info btn-block btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                                <a href="#" class="btn btn-success btn-block btn-sm">
                                                    <i class="fas fa-shopping-cart"></i> Tambah
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- Produk  -->

                            </div>



                            <!-- Pagination -->
                            {{ $products->links('vendor.pagination.bootstrap-4') }}
                            <!-- /.pagination -->

                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>

            <!-- /.content -->
        </div>
    </div>
@endsection
