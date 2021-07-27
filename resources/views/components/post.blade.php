<div>
    <div class="post border-bottom">
        <div class="clearfix">
            <div class="pull-left">
                <h2 class="mb-5 text-green"><b>{{ $bulletin->title }}</b></h2>
            </div>
        </div>
        <p>
            {{ $bulletin->body }}
        </p>
        <div class="img-box my-10">
            <img class="img-responsive img-post float-right" style="height: 6em" class=""
                src="{{ asset('storage/images/' . $bulletin->id . '-' . $bulletin->title . '.jpg') }}" alt="image">
        </div>
        @if (file_exists('storage/images/' . $bulletin->id . '-' . $bulletin->title . '.jpg'))
        @endif
        <div class="row d-flex align-items-center mt-30">
            <div class="col-md-8">
                {{ $slot }}
            </div>
            <div class="col-md-4">
                <span class="text-lgray align-self-center">{{ $bulletin->created_at }}</span>
            </div>
        </div>
    </div>
</div>
