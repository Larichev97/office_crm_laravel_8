<div class="modal fade" id="deleteClientModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalClient"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalClient">Вы действительно хотите удалить клиента?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Выберете "Удалить", чтобы удалить клиента.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Отмена</button>
                <a class="btn btn-danger" href="{{ route('clients.index') }}"
                    onclick="event.preventDefault(); document.getElementById('client-delete-form').submit();">
                    Удалить
                </a>
                <form id="client-delete-form" method="POST" action="{{ route('clients.destroy', ['client' => $client->id]) }}">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>
