<div class="control has-addons item-actions">

    <a :href="'/entities/' + props.item.id + '/edit'" class="button">
        <i class="licon-edit"></i>
    </a>
    <lari-delete-item :url="'/entities/' + props.item.id" ></lari-delete-item>
</div>
