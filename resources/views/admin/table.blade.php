@extends('layouts.admin')
@php(array_unshift($columns, 'id'))
@php(array_push($columns, 'created_at'))

@section('styles')
<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/forms/theme-checkbox-radio.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">

<link href="{{ asset('css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/editors/quill/quill.snow.css') }}">
<link href="{{ asset('plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<!-- END PAGE LEVEL CUSTOM STYLES -->
<style>
    .select2-close-mask {
        z-index: 2099;
    }

    .select2-dropdown {
        z-index: 3051;
    }

</style>
@endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="table-responsive pmd-table-card">
                <table id="example1" class="table records pmd-table">
                    @include('admin.partials.table.header')
                    @include('admin.partials.table.body')
                </table>

                @include('admin.partials.table.footer')
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" method="POST" action="{{ url("admin/$table") }}" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">New {{ str_singular(__($table)) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @include('admin.partials.form.fields')
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn bg-dark">Save {{ str_singular(__($table)) }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./ Content -->
@endsection

@section('scripts')
<!-- Daterangepicker -->
<script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('js/scrollspyNav.js') }}"></script>
<script src="{{ asset('plugins/editors/quill/quill.js') }}"></script>
{{-- <script src="{{ asset('plugins/editors/quill/custom-quill.js') }}"></script> --}}
<script src="{{ asset('plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
{{-- <script src="{{ asset('plugins/select2/custom-select2.js') }}"></script> --}}

<script>
    $('.custom-file-container').each(function() {
        var id = $(this).data('upload-id');
        var placeholder = $(this).data('image');
        var $id = new FileUploadWithPreview(id, {
            images: {
                baseImage: placeholder
            }
        });
    });

    // var e;
    c1 = $('table').DataTable({
        headerCallback: function(e, a, t, n, s) {
            e.getElementsByTagName("th")[0].innerHTML = '<label class="new-control new-checkbox checkbox-outline-info m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
        }
        , columnDefs: [{
            targets: 0
            , width: "30px"
            , className: ""
            , orderable: !1
            , render: function(e, a, t, n) {
                return '<label class="new-control new-checkbox checkbox-outline-info  m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
            }
        }]
        , "bInfo": false
        , "paging": false
        , "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>'
                , "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            }
            , "sInfo": "Showing page _PAGE_ of _PAGES_"
            , "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>'
            , "sSearchPlaceholder": "Search..."
            , "sLengthMenu": "Results :  _MENU_"
        , }
    });

    multiCheck(c1);

    var ss = $(".basic").select2({
        tags: true
    });

</script>
@endsection

{{-- var quill = new Quill('.textarea', {
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, false]
                        }]
                        , ['bold', 'italic', 'underline']
                        , ['image', 'code-block']
                    ]
                }
                , placeholder: 'Compose an epic...'
                , theme: 'bubble'
            }); --}}
