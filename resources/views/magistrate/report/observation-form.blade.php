<form action="{{ route('report.observation.store') }}" method="post" id="{{ $formId }}">
    @csrf
    <input type="hidden" name="report" value="{{ $report->id }}">
    <div class="card card-accent-success">
        <div class="card-header">
            <h4>{{ __('tables.observation') }}</h4>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">{{ __('forms.report.title') }}</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="impact">{{ __('tables.financial_impact'). ' (TND)' }}</label>
                            <input type="number" name="impact" id="impact" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="content">{{ __('tables.observation') }}</label>
                        <textarea name="content" id="content" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="financial_impact">{{ __('tables.financial_impact') }}</label>
                        <textarea name="financial_impact" id="financial_impact" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
