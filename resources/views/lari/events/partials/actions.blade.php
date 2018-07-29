<div class="control has-addons item-actions">
    <a href="/events/{{ $event->id }}/edit" class="button">
        <i class="licon-edit"></i>
    </a>
    <lari-delete-item url="{{ route('events.destroy', $event->id) }}"></lari-delete-item>
</div>
