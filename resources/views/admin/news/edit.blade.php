@extends('layouts.admin')
@section('title')
    Редактировать новость
@endsection
@section('header')
    <h2 class="h2">Редактировать новость </h2>
@endsection
@section('content')
    <div>

    @include('inc.message')

    <form method="POST" action="{{route("admin.news.update", ['news' => $news]) }}" enctype="multipart/form-data">
        {{--<input type="hidden" name="_token" value="{{csrf_token()}}"/>--}}
        @csrf
        @method('put')

        <div class="form-group">
            <label for="title">Заголовок новости</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
            @error('title') <strong style="color: red;">{{$message}}</strong>@enderror
        </div>

        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" class="form-control" id="author" name="author" value="{{$news->author}}" }>
            @error('author') <strong style="color: red;">{{$message}}</strong>@enderror
        </div>

        <div class="form-group">
            <label for="image">Изображение</label>&nbsp; <a href="javascript:;" class="delete" rel="{{$news->id}}">[X]</a>

            <img src="{{ Storage::disk('public')->url($news->image) }}" alt="" width="250">
            <input type="file" class="form-control" id="image" name="image">
            @error('author') <strong style="color: red;">{{$message}}</strong>@enderror
        </div>

        <div class="form-group">
            <label for="status">Статус новости</label>
            <select class="form-control text-uppercase" name="status" id="status">
                <option value="draft" @if($news->status === 'draft') selected @endif>draft</option>
                <option value="active" @if($news->status === 'active') selected @endif>active</option>
                <option value="blocked" @if($news->status ==='blocked') selected @endif>blocked</option>
            </select>

        </div>

        <div class="form-group">
            <label for="description">Описание новости</label>
            <textarea class="form-control" name="description" id="editor" cols="30"
                      rows="3">{!! $news->description !!}</textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Категория новости</label>
            <select class="form-control" name="category_id" id="category_id">
                @foreach ($categories as $category)

                    <option value="{{$category->id}}" @if($news->category_id == $category->id) selected @endif>{{$category->title}}</option>

                @endforeach
            </select>
            @error('category_id') <strong style="color:red;">{{$message}}</strong>@enderror
        </div>



        <input type="submit" class="btn btn-success float-end mt-2" value="Сохранить">
    </form>
    </div>
@endsection

@push('js')

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function (){
            const el = document.querySelector(".delete");

            el.addEventListener('click', function (){
                const id = el.getAttribute("rel");
                if(confirm("Подтверждаете удаление изображения с #ID=" + id + "?")){
                    send('/admin/news/' + id + '/deleteimg').then(()=>{
                        location.reload();
                    });
                }
            });

        });

        async function send(url) {
            let response = await fetch(url,  {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            });
            let result = await response.json();
            return result.ok;

        }
    </script>

    <script>
        class MyUploadAdapter {
            constructor( loader ) {
                // The file loader instance to use during the upload.
                this.loader = loader;
            }

            // Starts the upload process.
            upload() {
                return this.loader.file
                    .then( file => new Promise( ( resolve, reject ) => {
                        this._initRequest();
                        this._initListeners( resolve, reject, file );
                        this._sendRequest( file );
                    } ) );
            }

            // Aborts the upload process.
            abort() {
                if ( this.xhr ) {
                    this.xhr.abort();
                }
            }

            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();

                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                xhr.open( 'POST', "{{route('upload',['_token'=>csrf_token()])}}", true );
                xhr.responseType = 'json';
            }

            // Initializes XMLHttpRequest listeners.
            _initListeners( resolve, reject, file ) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener( 'error', () => reject( genericErrorText ) );
                xhr.addEventListener( 'abort', () => reject() );
                xhr.addEventListener( 'load', () => {
                    const response = xhr.response;


                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if ( !response || response.error ) {
                        return reject( response && response.error ? response.error.message : genericErrorText );
                    }

                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
                    resolve( {
                        default: response.url
                    } );
                } );

                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if ( xhr.upload ) {
                    xhr.upload.addEventListener( 'progress', evt => {
                        if ( evt.lengthComputable ) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    } );
                }
            }

            // Prepares the data and sends the request.
            _sendRequest( file ) {
                // Prepare the form data.
                const data = new FormData();

                data.append( 'upload', file );

                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.

                // Send the request.
                this.xhr.send( data );
            }
        }

        // ...

        function MyCustomUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter( loader );
            };
        }

        // ...

        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                extraPlugins: [ MyCustomUploadAdapterPlugin ],

                // ...
            } )
            .catch( error => {
                console.log( error );
            } );

    </script>




@endpush
