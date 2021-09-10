<div class="mr-1 ml-1">
    @include('sgdcg.add_thanh_vien_to_sgdcg')
    <button class="btn btn-outline-danger"
            data-toggle="modal"
            data-target="#thanhVienModal"
       >Lập bí tích hôn phối
    </button>
</div>


@section('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
    </script>
@endsection
