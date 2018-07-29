<div class="control has-addons item-actions">
    <a href="/entitytypes/{{ $entitytype->id }}/edit" class="button">
        <i class="licon-edit"></i>
    </a>
    <lari-delete-item url="{{ route('entitytypes.destroy', $entitytype->id) }}"></lari-delete-item>
</div>
