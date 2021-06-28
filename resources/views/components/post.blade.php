<div>
    <div class="post">
        <div class="clearfix">
            <div class="pull-left">
                <h2 class="mb-5 text-green"><b>{{ $bulletin->title }}</b></h2>
            </div>
            <div class="pull-right text-right">
                <p class="text-lgray">{{ $bulletin->created_at }}</p>
            </div>
        </div>
        <p>
            {{ $bulletin->body }}
        </p>
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
