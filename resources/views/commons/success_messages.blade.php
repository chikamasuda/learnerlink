@if (session('message'))
    <div class="alert alert-success flash_message" id="alertfadeout">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="閉じる">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif