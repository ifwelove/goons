<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible bg-white text-danger fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {!! implode('<br>', $errors->all()) !!}
        </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible bg-white text-danger fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ __(session('error')) }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-white text-success fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ __(session('success')) }}
            </div>
        @endif
        </div>
    </div>
</div>
