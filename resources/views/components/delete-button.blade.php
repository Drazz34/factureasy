<form action="{{ route('clients.destroy', $client_id) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-red">
        Supprimer
    </button>
</form>