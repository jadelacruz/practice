@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>
            Post Page
        </h1>
    </div>

    <div class="col-sm-12">
        <form class="form-horizontal" role="form">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="title"> Title </label>

                <div class="col-sm-9">
                    <input type="text" id="title" placeholder="Title" class="col-xs-10 col-sm-5" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="description"> Description </label>

                <div class="col-sm-9">
                    <input type="text" id="description" placeholder="Description" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-top" for="duallist"> Select recipients: </label>

                <div class="col-sm-9">
                    <select multiple="multiple" size="10" name="duallistbox_demo1[]" id="duallist">
                        @foreach ($aRecipient as $oRecipient)
                            <option value="{{ $oRecipient->id }}">{{ $oRecipient->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="hr hr-16 hr-dotted"></div>

            <div id="fuelux-wizard-container">
                <div>
                    <ul class="steps">

                    </ul>
                </div>
            </div>

            <div class="clearfix form-actions">
                <div class="col-md-offset-5 col-md-7">
                    <button class="btn btn-info" type="button">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>

                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('page-level-script')
    <script src="{{ asset('assets/js/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.raty.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-multiselect.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-typeahead.js') }}"></script>
    <script>
        $(document).ready(function () {
            var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({infoTextFiltered: '<span class="label label-purple label-lg">Filtered</span>'});
            var container1 = demo1.bootstrapDualListbox('getContainer');
            container1.find('.btn').addClass('btn-white btn-info btn-bold');
            $('#duallist').change(function () {
                var iRecipients = 0;
                var sStepLi = '';
                var oStep = $('.steps');

                $('select[name="duallistbox_demo1[]_helper2"]').children('option')
                    .each(function (index, object) {
                        var iCounter = index + 1;
                        var sName = object.text;
                        sStepLi += '<li data-step="' + iCounter + '">' +
                                        '<span class="step">' + iCounter + '</span>' +
                                        '<span class="title">' + sName + '</span>' +
                                    '</li>';
                        iRecipients++;
                });

                if (iRecipients > 1) {
                    oStep.empty();
                    oStep.append(sStepLi);
                } else {
                    oStep.empty();
                }
            });
        });
    </script>
@endsection

@section('page-level-style')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-duallistbox.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-multiselect.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}"/>
@endsection
