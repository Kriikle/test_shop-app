@extends('layouts.app')

@section('content')

    @if(Auth::user()->admin() != NUll)
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-md-8" style="width: 100%;margin-top: 50px;padding-bottom: 100px">


                <div class="card" style="margin-top: 50px">
                    <div class="card-header">{{ __('Products list') }}
                    </div>
                    <button class="accordion" style="text-align: right">Open section</button>
                    <div class="panel" style="display:none">
                        <div class="card-body">

                            <table style="width: 100%;min-width: 300px">
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ url('admin/createProduct') }}" enctype="multipart/form-data" >
                                            @csrf <!-- {{ csrf_field() }} -->
                                            Name product:
                                            <label>
                                                <input value="" name="name" >
                                            </label>
                                            prize(cent):
                                            <label>
                                                <input value="" name="prize" >
                                            </label>
                                            Category:
                                            <label>
                                                <input list="categories" name="category_id">
                                            </label>
                                            Description:
                                            <label>
                                                <input type="text" value="" name="description" >
                                            </label>
                                            Preview image:
                                            <input type="file" name="img"><br>
                                            <input type="submit" value="Add product" >
                                        </form>
                                    </td>
                                </tr>
                                <tr><td><br></td>
                                </tr>
                                @foreach($products as $product)
                                    <tr>
                                        <td>id: {{ $product->id }}
                                        </td>
                                        <td>
                                            <form method="post" action="{{ url('admin/updateProduct') }}" enctype="multipart/form-data" >
                                                @csrf <!-- {{ csrf_field() }} -->
                                                Name product:
                                                <label>
                                                    <input value="{{ $product->name }}" name="name">
                                                </label>
                                                prize(cent):
                                                <label>
                                                    <input value="{{ $product->prize }}" name="prize">
                                                </label>
                                                Descrition:
                                                <label>
                                                    <input type="text" value="{{ $product->description }}" name="description">
                                                </label>
                                                NEW_ING:<input type="file" name="img"><br>
                                                <input type="submit" value="Update product {{ $product->id }}" >
                                                <label>
                                                    <input type="text" value="{{ $product->id }}" name="id_product" hidden="true">
                                                </label>

                                                <br>
                                            </form>
                                        </td>
                                    <tr>
                                        <td colspan="5">
                                            <form action="{{ url('admin/deleteProduct') }}"  method="post"  style="padding-top: 20px;text-align: right">
                                                @csrf <!-- {{ csrf_field() }} -->
                                                <input type="submit" value="Delete product {{ $product->id }}">
                                                <label>
                                                    <input type="text" value="{{ $product->id }}" name="id_product" hidden="true">
                                                </label><br>
                                            </form>
                                            <hr>
                                        </td>
                                    </tr>

                                @endforeach
                            </table>

                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 50px">
                    <div class="card-header">{{ __('Category list') }}
                    </div>
                    <button class="accordion" style="text-align: right">Open section</button>
                    <div class="panel" style="display: none">
                        <div class="card-body">
                            <table style="width: 100%;min-width: 300px">
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ url('admin/createCategory') }}" >
                                            @csrf <!-- {{ csrf_field() }} -->
                                            Name product:
                                            <input value="" name="name" >
                                            Descrition:
                                            <input type="text" value="" name="description" >
                                            <input type="submit" value="Add Category" >
                                        </form>
                                    </td>
                                </tr>
                                <tr><td><br></td>
                                </tr>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>id: {{ $category->id }}
                                        </td>
                                        <td>
                                            <form method="post" action="{{ url('admin/updateCategory') }}" >
                                                @csrf <!-- {{ csrf_field() }} -->
                                                Name category:
                                                <input value="{{ $category->name }}" name="name">
                                                Category description:
                                                <input type="text" value="{{ $category->description }}" name="description">

                                                <input type="submit" value="Update category {{ $category->id }}" >
                                                <input type="text" value="{{ $category->id }}" name="id_category" hidden="true"><br>
                                            </form>
                                        </td>
                                    <tr>
                                        <td colspan="2">
                                            <form action="{{ url('/admin/deleteCategory') }}"  method="post"  style="padding-top: 20px;text-align: left">
                                                @csrf <!-- {{ csrf_field() }} -->
                                                <input type="submit" value="Delete category {{ $category->id }}">
                                                <input type="text" value="{{ $category->id }}" name="id_category" hidden="true"><br>
                                            </form>
                                            <hr>
                                        </td>
                                    </tr>

                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
        </div>
    @endif
@endsection

