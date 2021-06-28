<div class="d-flex justify-content-center">
    <a class="d-block btn btn-lg text-center" href="{{ url('bulletin?page=' . Session::get('currentPage')) }}">
        Back previous page
    </a>
</div>

{{-- if code like this, this code only can use to back to previous page in pagination --}}

{{-- option to make it reusable, convert it into component and receive url as props --}}
