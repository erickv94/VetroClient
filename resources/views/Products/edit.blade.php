@extends('Layout.layout')

@section('titulo')
Edit Product
@endsection
@section('custom_css')
<link rel="stylesheet" href="/css/custom.css">
@endsection
@section('title_content')
<h1><i class="fa fa-dashboard"></i>Edit Product</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
<li class="breadcrumb-item"><a href="{{url()->current()}}">edit</a></li>
@endsection

@section('content')
    <div class="tile">
            <div class="tile-body">
                <h3 class="tile-title"><i class="fa fa-paw" aria-hidden="true"></i> {{ $product->Name }} </h3>
                <div class="form-group">
                    <label for="editor">Edit description</label>
                    <textarea class='form-control' id="editor" name='editor'> {!! $product->Description !!} </textarea>
                    <button  id="clipboard" class="btn btn-outline-primary my-3 ml-2"> <i class="fa fa-clipboard" aria-hidden="true"></i> Copy to clipboard </button>
                    <a class="btn btn-outline-primary my-3 ml-2" target="_blank" href="https://vetro.myvtex.com/admin/Site/ProdutoForm.aspx?id={{$product->Id}}" ><i class="fa fa-globe" aria-hidden="true"></i> Go to Edit Product</a>
                </div>
                <pre></pre>
                <div class="form-group" id="imagechange">
                    <label for="edit">Edit Image</label>
                   <div class="row">
                       <div class="col-8">
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                            <label class="custom-file-label" for="validatedCustomFile">Choose img...</label>
                        </div>
                       </div>
                       <div class="col-4">
                           <button class="btn btn-primary btn-block" type="submit">Update Image</button>
                       </div>
                   </div>
                </div>
                 <pre></pre>
                 <div class="form-group">
                    <label for="edit">Edit PageTitle</label>
                    <div class="row">
                       <div class="col-8">
                             <input type="text" name="pagetitle" class="form-control" value="{{ $product->Title}}">
                       </div>
                       <div class="col-4">
                           <button class="btn btn-primary btn-block" type="submit">Update Title</button>
                       </div>
                   </div>
                   
                </div>
                <pre></pre>
                 <div class="form-group">
                    <label for="edit">Edit MetaDescription</label>
                    <div class="row">
                       <div class="col-8">
                              <textarea class="form-control" id="metaDescription"  name="metaDescription" rows="4">{{$product->MetaTagDescription}}</textarea>
                       </div>
                       <div class="col-4">
                           <button class="btn btn-primary btn-block" type="submit">Update MetaDescription</button>
                       </div>
                   </div>
                </div>
                 <pre></pre>
                 <div class="form-group">
                    <label for="edit">Edit Keywords</label>
                    <div class="row">
                       <div class="col-8">
                              <textarea class="form-control" id="keywords"  name="keywords" rows="4">{{$product->KeyWords}}</textarea>
                       </div>
                       <div class="col-4">
                           <button class="btn btn-primary btn-block" type="submit">Update Keywords</button>
                       </div>
                   </div>
                </div>
               
            </div>
    </div>
</div>

@section('custom_javas')
<script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>

<script>


    ck_editor_obj=CKEDITOR.replace( 'editor' ,{
        skin: 'kama',
        extraPlugins: 'colorbutton,colordialog,font',
        removeButtons: 'PasteFromWord'
    });

    document.getElementById('clipboard').addEventListener('click',function(e){
        var textarea= document.createElement('textarea');
        textarea.value=ck_editor_obj.getData();
        textarea.style.top='0';
        textarea.style.left='0';
        textarea.style.position='fixed';
        document.body.appendChild(textarea);
        textarea.focus();
        textarea.select();
        var successful = document.execCommand('copy');
        console.log(successful);
        textarea.remove();
        toastr["success"]("HTML added to clipboard")
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
    })



</script>


@endsection

@endsection
