<form action="{{ route($route_name, $item_id) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-red">
        Supprimer
    </button>
</form>