@extends('admin.product.details_sidebar')

@section('product-information')
    <div class="nimmu-default-card">
        {{ Form::open(['route' => 'admin.updateProductAttributes', 'action' => 'post' ,'files' => 'true']) }}
        <div class="input-area nimmu-input-default">
            <input id="product_id" type="hidden" name="product_id" value="{{isset($product->id) ? $product->id : null}}">
            <div class="row">
                {{-- color --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('Color')}}</label>
                        <select id="colorField" name="colors[]" class="form-control" multiple>
                            @foreach(colors() as $key => $value)
                                <option @foreach ($productColors as $color)
                                        @if($color->color == $value) selected @endif
                                        @endforeach value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- size --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('Size')}}</label>
                        <select id="sizeField" name="sizes[]" class="form-control" multiple>
                            @foreach(sizes() as $key => $value)
                                <option @foreach ($productSizes as $size)
                                        @if($size->size == $value) selected @endif
                                        @endforeach value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <button id="saveProductButton" class="btn btn-primary btn-block add-product-btn">{{__('Save')}}</button>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    <!-- End content area  -->
@endsection

@section('script')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <script>
        $(function () {
            $('#colorField').multipleSelect()
            $('#sizeField').multipleSelect()
        })
    </script>

@endsection
