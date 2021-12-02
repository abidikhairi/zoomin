@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center  ">
            <div class="col-md-10">
                <form id="report-form" action="{{ route('report.store.step1') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">{{ __('sidebar.magistrate.add_report') }}</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="title">{{ __('forms.report.title') }}</label>
                                        <input type="text" id="title" name="title" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="year">{{ __('forms.report.year') }}</label>
                                        <input type="number" id="year" name="year" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="link">{{ __('forms.report.link') }}</label>
                                        <input type="text" name="link" id="link" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="type">{{ __('forms.report.type') }}</label>
                                        <select name="type" id="type" class="form-control select2">
                                            <option value="">{{ __('forms.fields.select.choose') }}</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3" id="sector-section">
                                        <label for="sector">{{ __('fields.sector.name') }}</label>
                                        <select name="sector" id="sector" class="form-control select2">
                                            <option value="">{{ __('forms.fields.select.choose') }}</option>
                                            @foreach($sectors as $sector)

                                                <option value="{{ $sector->id }}"> {{ $sector->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3" id="establishment-section">
                                        <label for="establishment">{{ __('fields.establishment.name') }}</label>
                                            <select name="establishment" id="establishment" class="form-control">
                                        </select>
                                    </div>
                                    <div class="form-group mb-3" id="observations-section">
                                        <label for="observations">{{ __('forms.report.observations') }}</label>
                                        <input type="number" name="observations" id="observations" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="pdf_file">{{ __('forms.report.report_file') }}</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="pdf_file" id="pdf_file">
                                            <label class="custom-file-label" for="pdf_file">{{ __('forms.fields.choose_file') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success" type="submit">
                                {{ __('forms.fields.accept') }}
                            </button>
                            <button type="reset" class="btn btn-danger">
                                {{ __('forms.fields.reset') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('additional_js')
    <script>
        $('#sector-section').hide()
        $('#establishment-section').hide()
        $('#observations-section').hide()
        $('#type').change(function () {
            let report_id = $(this).val();
            axios.get('/api/report-type/' + report_id).then(response => {
                let reportType = response.data
                if(reportType.has_establishment) {
                    $('#establishment-section').show()
                }
                if(!reportType.has_establishment) {
                    $('#establishment-section').hide()
                }

                if(reportType.has_observations) {
                    $('#observations-section').show()
                }
                if(!reportType.has_observations) {
                    $('#observations-section').hide()
                }

                if(reportType.has_sector) {
                    $('#sector-section').show()
                }
                if(!reportType.has_sector) {
                    $('#sector-section').hide()
                }

            }).catch(err => {
                alert(err)
            })
        })
    </script>
@endsection
