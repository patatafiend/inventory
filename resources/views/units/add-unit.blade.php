<tr id="unit-{{ $unit->id }}">
    <td>{{ $unit->name }}</td>
    <td>
        <button class="btn btn-warning edit-unit" data-id="{{ $unit->id }}">Edit</button>
        <button class="btn btn-danger delete-unit" data-id="{{ $unit->id }}">Delete</button>
    </td>
</tr>