<div class="container">
    <div class="row mb-n3">
        <div class="col-md-6 text">
            {!! (new Parsedown)->text(translatedData($brick, 'data.text_left')) !!}
        </div>
        <div class="col-md-6 text">
            {!! (new Parsedown)->text(translatedData($brick, 'data.text_right')) !!}
        </div>
    </div>
</div>
